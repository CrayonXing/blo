<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'comment';

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
    protected $fillable = ['pid','path','uid','content','oid','created_time'];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 获取PC端文章详情页面的评论列表
     *
     * @param $oid
     * @param $page
     * @param $page_size
     * @return mixed
     */
    public function getCommentList($oid,$page,$page_size){
        $rows = self::select(['users.nickname','users.head','comment.content','comment.created_time as date','comment.pid','comment.id','comment.uid'])
            ->leftJoin('users', 'users.id', '=', 'comment.uid')
            ->where('comment.oid',$oid)
            ->orderBy('comment.created_time','desc')
            ->get();

        if(!$rows){
            return packData([],0,$page,$page_size,['people_num'=>0,'comment_num'=>0]);
        }

        $rows = $rows->toArray();

        $people = [];
        foreach($rows as $k=>$row){
            $rows[$k]['like'] = 0;
            $rows[$k]['answer_num'] = 0;
            array_push($people,$row['uid']);
        }

        return packData($this->getTree($rows),count($rows),$page,$page_size,['people_num'=>count(array_unique($people)),'comment_num'=>count($rows)]);
    }

    public function getTree($data, $pid=0){
        $tree = [];
        foreach($data as $k => $v)
        {
            if($v['pid'] == $pid){
                $v['children'] = $this->getTree($data, $v['id']);
                $tree[] = $v;
            }
        }

        return $tree;
    }

    /**
     * 添加评论方法
     *
     * @param int $uid 用户ID
     * @param array $data 评论数据
     * @return bool
     */
    public function addComment(int $uid,array $data){
        $isTrue = self::create(['uid' => $uid,'oid'=>$data['aid'],'pid'=>$data['pid'],'content'=>$data['content'],'created_time'=>date('Y-m-d H:i:s')]);
        return $isTrue ? true:false;
    }
}
