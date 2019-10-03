<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

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
    protected $fillable = ['category_id','uid','title','tag','describe','img','content','markdown_content','status','created_time','updated_time','reprint_url','short_code'];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 编辑文章方法
     *
     * @param int $id
     * @param array $data
     * @param string $saveMode
     * @return array
     */
    public function saveArticle(int $id,array $data,string $saveMode){
        if($saveMode == 'articleSave'){
            unset($data['content']);
        }

        $data['updated_time'] = date('Y-m-d H:i:s');
        if(empty($id)){

            $data['created_time'] = date('Y-m-d H:i:s');
            $data['status']       = ($saveMode == 'articleSave') ? 0 : 1;
            if($res = self::create($data)){
                $res->short_code = Str::lower(inviteCode($res->id).Str::random(6));
                $res->save();
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
     *
     * @param int $uid 用户ID
     * @param int $page 分页数
     * @param int $page_size 分页大小
     * @param array $searchParams 额外查询参数
     * @return mixed
     */
    public function getUserArticle(int $uid,int $page,int $page_size,$searchParams=[]){
        $countSqlObj = Article::where('uid',$uid);
        $rowsSqlObj  = Article::where('uid',$uid);

        if(count($searchParams) > 0){
            if(isset($searchParams['category']) && !empty($searchParams['category']) && $searchParams['category'] != 'all'){
                $countSqlObj->where('category_id',$searchParams['category']);
                $rowsSqlObj->where('category_id',$searchParams['category']);
            }
        }

        $total = $countSqlObj->count('id');
        $rows = $rowsSqlObj->select(['id','short_code','title','tag','describe','img','visits','created_time','status'])->orderBy('status', 'asc')->orderBy('created_time', 'desc')->forPage($page,$page_size)->get();
        if($rows){
            $rows = $rows->toArray();
            foreach($rows as $k=>$row){
                $rows[$k]['tag']     = explode(',',$row['tag']);
                $rows[$k]['status']  = ($row['status'] == 0) ? '草稿文' :'已发布';
            }
        }

        return packData($rows,$total,$page,$page_size,$searchParams);
    }

    /**
     * 获取站内文章列表
     *
     * @param $page
     * @param $page_size
     * @param array $searchParams
     * @return mixed
     */
    public function getArticle($page,$page_size,$searchParams=[]){
        $countSqlObj  = self::where('status',1);
        $rowsSqlObj = self::where('status',1);

        if(count($searchParams) > 0){
            if(isset($searchParams['cid']) && !empty($searchParams['cid'])){
                $countSqlObj->where('category_id',$searchParams['cid']);
                $rowsSqlObj->where('category_id',$searchParams['cid']);
            }
        }

        $total = $countSqlObj->count('id');
        $rows = $rowsSqlObj->select(['short_code','title','tag','describe','img','visits','created_time'])->orderBy('created_time','desc')->forPage($page,$page_size)->get();
        if($rows){
            $rows = $rows->toArray();
            foreach($rows as $k=>$row){
                $rows[$k]['tag']  = explode(',',$row['tag']);
            }
        }

        return packData($rows,$total,$page,$page_size);
    }

    /**
     * 获取标签云列表
     *
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
     *
     * @return mixed
     */
    public function getRankingList(){
        return self::where('status',1)->orderBy('visits','desc')->limit(6)->select('short_code','title')->get()->toArray();
    }
}
