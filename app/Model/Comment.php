<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Help;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\See;

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
     */
    public function getCommentList($oid){
        $rows = DB::table('comment')->leftJoin('users', 'users.id', '=', 'comment.uid')
            ->select(['users.nickname','users.head','comment.content','comment.created_time as date','comment.pid','comment.id'])->where('comment.oid',$oid)
            ->get();
        if(!$rows){
            return [];
        }

        $rows = $rows->toArray();
        foreach($rows as $k=>$row){
            $rows[$k] = (array)$row;
            $rows[$k]['like'] = 0;
            $rows[$k]['answer_num'] = 0;
        }

        return $this->getTree($rows);
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


    public function addComment($uid,$data){
        $isTrue = self::create(['uid' => $uid,'oid'=>$data['aid'],'pid'=>$data['pid'],'content'=>$data['content'],'created_time'=>date('Y-m-d H:i:s')]);
        return $isTrue ? true:false;
    }
}
