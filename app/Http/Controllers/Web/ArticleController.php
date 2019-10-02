<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Model\Article;
use App\Model\Category;
use App\Model\Comment;

class ArticleController extends CController
{

    /**
     * 文章分类列表页面
     *
     * @param $cid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($cid){
        $category_name = Category::where('id',$cid)->value('name');
        return view('web.article.list',['cid'=>$cid,'category'=>$category_name]);
    }

    /**
     * 文章详情页
     *
     * @param int $aid            文章ID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details(int $aid){
        $piece = ['previous'=>[],'next'=>[]];
        $relevant = [];

        if($info = Article::where('id',$aid)->first()){
            $info = $info->toArray();
            $info['tag'] = explode(',',$info['tag']);
            $previous  = Article::where('id','<',$aid)->orderBy('id','desc')->select('id','title')->first();
            $next      = Article::where('id','>',$aid)->select('id','title')->first();

            if($previous){
                $piece['previous']  = $previous->toArray();
            }

            if($next){
                $piece['next']      = $next->toArray();
            }

            $obj = Article::where('id', '<>', $aid);
            foreach ($info['tag'] as $tag){
                $tag = addslashes($tag);
                $obj->where('tag', 'like', "%{$tag}%");
            }

            $relevant = $obj->select('id','title')->limit(5)->get();
            if($relevant){
                $relevant = $relevant->toArray();
            }

            Article::where('id',$aid)->increment('visits');
        }

        return view('web.article.detail',['info'=>$info,'piece'=>$piece,'relevant'=>$relevant]);
    }

    /**
     * 获取列表数据
     *
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArticleList(Request $request,Article $article){
        $page = (int)$request->get('page', 1);
        $cid  = (int)$request->get('cid', 0);
        return $this->ajaxSuccess('success',$article->getArticle($page,15,['cid'=>$cid]));
    }

    /**
     * 添加或编辑文章接口
     *
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request,Article $article){
        $params = ['id','cid','title','describe','tags','img','link','markdownContent','htmlContent','saveMode'];
        $data = $request->only($params);
        if(!$request->has($params) || !in_array($data['saveMode'],['articleRelease','articleSave'])){
            return $this->ajaxParamError();
        }

        if($data['cid'] <= 0){
            return $this->ajaxParamError('请选择文章分类...');
        }

        if(!empty($data['tags']) && $tags = array_filter(explode(',',$data['tags']))){
            if($tags > 3){
                return $this->ajaxParamError('文章标签数量不能超载过3个...');
            }
            $data['tags'] = implode(',',$tags);
        }

        if(empty($data['img']) && $img = app('service.help')->getTtmlImgs()){
            $data['img'] = $img[0];
        }

        [$isTrue,$aid] = $article->saveArticle($data['id'],[
            'category_id'=>$data['cid'],
            'uid'=>$this->uid(),
            'title'=>$data['title'],
            'tag'=>$data['tags'],
            'describe'=>$data['describe'],
            'img'=>$data['img'],
            'content'=>htmlspecialchars($data['htmlContent']),
            'markdown_content'=>htmlspecialchars($data['markdownContent']),
            'reprint_url'=>$data['link']
        ],$data['saveMode']);

        return $isTrue ? $this->ajaxSuccess('success',['id'=>$aid]) : $this->ajaxError('fail');
    }

    /**
     * 文章评论接口
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(Request $request,Comment $comment){
        $aid = $request->input('aid',0);
        $cid = $request->input('cid',0);
        $content = $request->input('content','');

        if(empty($aid) || empty($content)){
            return $this->ajaxParamError();
        }

        $isTrue = $comment->addComment($this->uid(),['aid'=>$aid,'pid'=>$cid,'content'=>$content]);
        return $isTrue ? $this->ajaxSuccess('评论成功') : $this->ajaxError('评论失败');
    }

    /**
     * 获取评论列表接口
     *
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentList(Request $request,Comment $comment){
        $aid = $request->get('aid',0);

        if(empty($aid)){
            return $this->ajaxParamError();
        }

        return $this->ajaxSuccess('success',$comment->getCommentList($aid,1,100000));
    }

    /**
     * 文章编辑页面
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function markdownEditorPage(Request $request){
        $aid = $request->input('aid',0);
        $info = Article::where('id',$aid)->where('uid',$this->uid())->first();
        $rows = Category::select('id','name')->get()->toArray();

        return view('web.article.editor-article',[
            'categoryInfos'=>$rows,
            'info'=>$info
        ]);
    }
}
