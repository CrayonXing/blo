<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Help;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class Article extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'article';

    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['category_id','uid','title','tag','describe','imgs','content','status','created_time','updated_time','is_overt','reprint_url'];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 编辑文章
     * @param array $params   文章参数
     * @param bool $isDraft   是否保存草稿标识
     * @param int $id         文章id 默认为0
     * @return array
     */
    public function saveArticle($params=[],$isDraft = false,$id = 0){
		$data = [
    		'category_id'		=>$params['category_id'],
    		'uid'				=>$params['uid'],
    		'title'				=>$params['title'],
    		'tag'				=>$params['tag'],
    		'describe'			=>$params['describe'],
    		'imgs'				=>json_encode($params['imgs']),
    		'content'			=>$params['content'],
            'is_overt'         =>$params['is_overt'],
            'reprint_url'      =>$params['reprint_url']
    	];

        $data['status'] = ($isDraft === true) ? 0 : 1;

    	if($id == 0){
    		$data['created_time'] = date('Y-m-d H:i:s');
    		$data['updated_time'] = date('Y-m-d H:i:s');
			$isTrue  = self::create($data);
			if($isTrue){
	    		return [true,'文章添加完成',null];
	    	}else{
				return [false,'文章添加失败'];
	    	}
    	}else{
    		$data['updated_time'] = date('Y-m-d H:i:s');
    		$isTrue  = self::where('id', $id)->where('uid',$params['uid'])->update($data);

    		if($isTrue !== false){
	    		return [true,'文章编辑完成',null];
	    	}else{
				return [false,'文章编辑失败',null];
	    	}
    	}
    }

    /**
     * 获取用户发布文章列表
     * @param $uid
     * @param $page
     * @param $page_size
     * @param array $searchParams
     * @return mixed
     */
    public function getUserArticle($uid,$page,$page_size,$searchParams=[]){

        $obj = Article::where('uid',$uid);
        $obj2 = Article::where('uid',$uid);

        if(count($searchParams) > 0){
            if(isset($searchParams['category']) && !empty($searchParams['category']) && $searchParams['category'] != 'all'){
                $obj->where('category_id',$searchParams['category']);
                $obj2->where('category_id',$searchParams['category']);
            }
        }

        $total = $obj->count('id');
        $rows = $obj2->select(['id','title','tag','describe','imgs','visits','created_time','status'])
            ->orderBy('status', 'asc')->orderBy('created_time', 'desc')
            ->offset((($page-1)*$page_size))->limit($page_size)->get()->toArray();

        if($rows){
            foreach($rows as $k=>$row){
                $rows[$k]['imgs']    = json_decode($row['imgs']);
                $rows[$k]['tag']     = explode(',',$row['tag']);
                $rows[$k]['status']  = ($row['status'] == 0) ? '草稿文' : ($row['status'] ==1?'审核中':'已发布') ;
            }
        }

        return Help::packData($rows,$total,$page,$page_size,$searchParams);
    }

    /**
     * 获取站内文章列表
     */
    public function getArticle($page,$page_size,$searchParams=[]){
        $total = Article::where('status',2)->count('id');
        $rows = Article::where('status',2)->select(['id','title','tag','describe','imgs','visits','created_time'])
            ->orderBy('created_time','desc')
            ->offset((($page-1)*$page_size))->limit($page_size)
            ->get()->toArray();

        if($rows){
            foreach($rows as $k=>$row){
                $rows[$k]['imgs'] = json_decode($row['imgs']);
                $rows[$k]['tag']  = explode(',',$row['tag']);
            }
        }

        return Help::packData($rows,$total,$page,$page_size);
    }

    public function getEditArticle($aid,$uid){

        $info = self::where('id',$aid)->where('uid',$uid)->first();

        return $info ?$info->toArray():null;
    }

    /**
     * 获取标签云列表
     * @return array
     */
    public function getTags(){
        $tmp = [];
        $rows = self::where('status',2)->select('tag')->get()->toArray();
        if(!$rows){
            return [];
        }

        foreach ($rows as $row){
            foreach (explode(',',$row['tag']) as $tag){
                array_push($tmp,$tag);
            }
        }

        if(count($tmp) == 0){return [];}

        $tmp = array_count_values($tmp);
        arsort($tmp);

        return array_slice($tmp,0,10);
    }

    /**
     * 获取点击排行榜列表
     */
    public function getRankingList(){
        return self::where('status',2)->orderBy('visits','desc')->limit(6)->select('id','title')->get()->toArray();
    }
}
