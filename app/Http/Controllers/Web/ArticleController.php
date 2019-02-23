<?php

namespace App\Http\Controllers\Web;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Model\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * 获取分页总数
     * @param $total
     * @param $page_size
     * @return int
     */
    function getPageTotal(int $total,int $page_size){
        if($total === 0){
            return 0;
        }

        return (int)ceil((int)$total/(int)$page_size);
    }


    /**
     * 包装分页数据
     * @param array $rows        列表数据
     * @param int $total         数据总记录数
     * @param int $page          当前分页
     * @param int $page_size     分页大小
     * @param array $params      额外参数
     * @return array
     */
    public function packData(array $rows,int $total,int $page,int $page_size,array $params=[])
    {
        return array_merge([
            'rows'          =>$rows,
            'page'          =>$page,
            'page_total'    =>($page_size == 0?1:$this->getPageTotal($total,$page_size)),
            'total'         =>$total,
        ],$params);
    }


    public function category($type){
        return view('web.article.list',['type'=>$type]);
    }


    public function details(int $aid,Request $request){
        $info = Article::where('id',$aid)->first();
        if($info){
            $info = $info->toArray();
            $info['tag'] = explode(',',$info['tag']);
        }

        return view('web.article.detail',['info'=>$info]);
    }


    public function getArticleList(Request $request){
        $page       = (int)$request->get('page', 1);
        $page_size  = (int)$request->get('page_size', 15);

        $list = Article::select('id','title','tag','describe','imgs','visits','created_time')->orderBy('created_time','desc')->offset((($page-1)*$page_size) )->limit($page_size)->get()->toArray();
        if($list){
            foreach($list as $k=>$row){
                $list[$k]['imgs'] = json_decode($row['imgs']);
                $list[$k]['tag']  = explode(',',$row['tag']);
            }
        }

        return response()->json(['code'=>200,'msg'=>'','data'=>$this->packData($list,7,$page,$page_size)]);
    }

    public function create(Request $request){
    	$title 		= $request->input('title', '');
    	$describe 	= $request->input('describe', '');
    	$category 	= $request->input('category', '');
    	$tag 		= $request->input('tag', '');
    	$imgs 		= $request->input('imgs', []);
    	$content 	= $request->input('content', []);

        $model = new Article();
        list($isTrue,$msg,$data) = $model->saveArticle([
            'category_id'       =>$category,
            'uid'               =>0,
            'title'             =>htmlspecialchars($title),
            'tag'               =>htmlspecialchars($tag),
            'describe'          =>htmlspecialchars($describe),
            'imgs'              =>$imgs,
            'content'           =>htmlspecialchars($content),
        ],(boolean)$request->input('isDraft', 'false'),(int)$request->input('id', 0));


        if($isTrue){
            return response()->json(['code'=>200,'msg'=>$msg,'data'=>[]]);
        }else{
            return response()->json(['code'=>305,'msg'=>$msg,'data'=>[]]);
        }
    }

    public function edit(Request $request){
        return view('web.article.edit-blog');
    }

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
