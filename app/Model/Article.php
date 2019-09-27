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
    protected $fillable = ['category_id','uid','title','tag','describe','img','content','markdown_content','status','created_time','updated_time','reprint_url'];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    public function saveArticle($id,$data,$saveMode){
        if($saveMode == 'articleSave'){
            unset($data['content']);
        }

        $data['updated_time'] = date('Y-m-d H:i:s');
        if(empty($id)){
            $data['created_time'] = date('Y-m-d H:i:s');
            $data['status']       = ($saveMode == 'articleSave') ? 0 : 1;
            if($res = self::create($data)){
                return [true,$res->id];
            }else{
                return [false,null];
            }
        }

        $info = self::where('id',$id)->first();
        if(!$info){
            return [false,null];
        }

        if($info->status == 0){
            $data['status'] = ($saveMode == 'articleSave') ? 0 : 1;
        }

        if(!self::where('id',$id)->update($data)){
            return [false,null];
        }

        return [true,$id];
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
        $rows = $obj2->select(['id','title','tag','describe','img','visits','created_time','status'])
            ->orderBy('status', 'asc')->orderBy('created_time', 'desc')
            ->offset((($page-1)*$page_size))->limit($page_size)->get();

        if($rows){
            $rows = $rows->toArray();
            foreach($rows as $k=>$row){
                $rows[$k]['tag']     = explode(',',$row['tag']);
                $rows[$k]['status']  = ($row['status'] == 0) ? '草稿文' :'已发布';
            }
        }

        return Help::packData($rows,$total,$page,$page_size,$searchParams);
    }

    /**
     * 获取站内文章列表
     */
    public function getArticle($page,$page_size,$searchParams=[]){
        $obj  = self::where('status',1);
        $obj2 = self::where('status',1);

        if(count($searchParams) > 0){
            if(isset($searchParams['cid']) && !empty($searchParams['cid'])){
                $obj->where('category_id',$searchParams['cid']);
                $obj2->where('category_id',$searchParams['cid']);
            }
        }

        $total = $obj->count('id');
        $rows = $obj2->select(['id','title','tag','describe','img','visits','created_time'])
            ->orderBy('created_time','desc')
            ->offset((($page-1)*$page_size))->limit($page_size)
            ->get();

        if($rows){
            $rows = $rows->toArray();
            foreach($rows as $k=>$row){
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
        $rows = self::where('status',1)->select('tag')->get()->toArray();
        if(!$rows){
            return [];
        }

        foreach ($rows as $row){
            foreach (explode(',',$row['tag']) as $tag){
                array_push($tmp,$tag);
            }
        }

        $tmp = array_filter($tmp);

        if(count($tmp) == 0){return [];}

        $tmp = array_count_values($tmp);
        arsort($tmp);

        return array_slice($tmp,0,10);
    }

    /**
     * 获取点击排行榜列表
     */
    public function getRankingList(){
        return self::where('status',1)->orderBy('visits','desc')->limit(6)->select('id','title')->get()->toArray();
    }
}
