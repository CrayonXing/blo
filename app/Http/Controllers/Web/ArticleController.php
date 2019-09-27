<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\Article;
use App\Model\Category;
use App\Model\Comment;
use Illuminate\Support\Facades\DB;
use Validator;

class ArticleController extends CController
{
    public function category($cid,Category $category){

        $category_name = '';

        if($info = Category::where('id',$cid)->select('name')->first()){
            $category_name = $info->name;
        }

        return view('web.article.list',['cid'=>$cid,'category'=>$category_name]);
    }

    public function details(int $aid,Request $request,Comment $comment){

        DB::table('article')->where('id',$aid)->increment('visits');

        $info = Article::where('id',$aid)->first();

        $piece = [
            'previous'=>[],
            'next'    =>[]
        ];

        $relevant = [];

        if($info){
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

            $obj = DB::table('article')->where('id', '<>', $aid);
            foreach ($info['tag'] as $tag){
                $obj->where('tag', 'like', "%{$tag}%");
            }

            $relevant = $obj->select('id','title')->limit(5)->get();
            if($relevant){
                $relevant = $relevant->toArray();
            }
        }

        return view('web.article.detail',['info'=>$info,'piece'=>$piece,'relevant'=>$relevant]);
    }

    /**
     * 获取列表数据
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArticleList(Request $request,Article $article){
        $page       = (int)$request->get('page', 1);
        $page_size  = (int)$request->get('page_size', 15);
        $cid  = (int)$request->get('cid', 0);
        return $this->ajaxSuccess('success',$article->getArticle($page,$page_size,['cid'=>$cid]));
    }

    public function create(Request $request,Article $article){

        $id 	    = $request->input('id', 0);
        $category 	= $request->input('cid', 0);
    	$title 		= $request->input('title', '');
    	$describe 	= $request->input('describe', '');
    	$tag 		= $request->input('tags', '');
    	$img 		= $request->input('img', '');
    	$markdownContent= $request->input('markdownContent', '');
    	$htmlContent 	= $request->input('htmlContent', '');
        $url 	    = $request->input('link', '');
        $saveMode 	    = $request->input('saveMode', '');


        [$isTrue,$aid] = $article->saveArticle($id,[
            'category_id'=>$category,
            'uid'=>$this->uid(),
            'title'=>$title,
            'tag'=>$tag,
            'describe'=>$describe,
            'img'=>$img,
            'content'=>htmlspecialchars($htmlContent),
            'markdown_content'=>htmlspecialchars($markdownContent),
            'reprint_url'=>$url
        ],$saveMode);

        return $isTrue ? $this->ajaxSuccess('success',['id'=>$aid]) : $this->ajaxError('fail');
    }

    /**
     * 文章图片上传接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request){
        if ($request->isMethod('post')) {
            $file = $request->file();
            if($file){
                $file =  array_shift($file);
            }

            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = '001/'.date('Ymd').'/'. md5(date('His').uniqid()) . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                if($bool){
                    return response()->json(array('errno' => 0, 'data' => [url("/uploads/{$filename}")]));
                }else{
                    return response()->json(array('errno' => 1, 'message' => '上传失败'));
                }
            }
        }
    }

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

    public function getCommentList(Request $request,Comment $comment){
        $aid = $request->get('aid',0);

        if(empty($aid)){
            return $this->ajaxParamError();
        }

        return $this->ajaxSuccess('success',$comment->getCommentList($aid,1,100000));
    }

    public function editorMd(Request $request){
        $aid = $request->input('aid',0);

        $info = Article::where('id',$aid)->where('uid',$this->uid())->first();

        $rows = Category::select('id','name')->get()->toArray();

        return view('web.article.editor-article',[
            'categoryInfos'=>$rows,
            'info'=>$info
        ]);
    }
}
