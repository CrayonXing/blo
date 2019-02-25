<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\Article;
use App\Model\Category;
class ArticleController extends BaseController
{
    public function category($cid,Category $category){

        $category_name = '';

        if($info = Category::where('id',$cid)->select('name')->first()){
            $category_name = $info->name;
        }

        return view('web.article.list',['cid'=>$cid,'category'=>$category_name]);
    }

    public function details(int $aid,Request $request){
        $info = Article::where('id',$aid)->first();
        if($info){
            $info = $info->toArray();
            $info['tag'] = explode(',',$info['tag']);
        }

        return view('web.article.detail',['info'=>$info]);
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
        return $this->returnAjax($article->getArticle($page,$page_size,['cid'=>$cid]));
    }

    public function create(Request $request){
    	$title 		= $request->input('title', '');
    	$describe 	= $request->input('describe', '');
    	$category 	= $request->input('category', '');
    	$tag 		= $request->input('tag', '');
    	$imgs 		= $request->input('imgs', []);
    	$content 	= $request->input('content', '');
        $url 	    = $request->input('url', '');

        $isOriginal = $request->input('isOriginal');
        $isOvert 	 = $request->input('isOvert');
        $isDraft    =$request->input('isDraft');

        if(empty($title) || empty($category) || empty($content)){
            return $this->returnAjax([],'参数不符合规范',301);
        }else if($isOriginal == 'false' && empty($url)){
            return $this->returnAjax([],'文章转载原文链接不能为空',302);
        }

        list($isTrue,$msg,$data) = (new Article())->saveArticle([
            'category_id'       =>$category,
            'uid'               =>$this->uInfo('id'),
            'title'             =>htmlspecialchars($title),
            'tag'               =>htmlspecialchars($tag),
            'describe'          =>htmlspecialchars($describe),
            'imgs'              =>array_slice(array_unique(array_merge($imgs,app('help')->getTtmlImgs($content))),0,3),
            'content'           =>htmlspecialchars($content),
            'is_overt'          =>($isOvert == 'true') ? 1 : 2,
            'reprint_url'       =>($isOriginal == 'true') ? '':$url,
        ],$isDraft == 'false'? false : true,(int)$request->input('id', 0));

        if($isTrue){
            return $this->returnAjax([],$msg,200);
        }else{
            return $this->returnAjax([],$msg,305);
        }
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
}
