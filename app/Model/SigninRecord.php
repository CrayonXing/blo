<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class SigninRecord extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'sginin_record';

    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 判断当日是否已签到
     * [isSignin description]
     * @return boolean [description]
     */
    public function isSamedaySignin($uid){
    	return self::where('uid',$uid)->whereDate('signin_time', date('Y-m-d'))->exists();
    }

    /**
     * 获取用户签到记录
     * @param $uid          用户ID
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSigninRecord($uid){
        $data = self::where('uid',$uid)->orderBy('signin_time', 'desc')->get()->toArray();

        $data = array_column($data,'signin_time');
        return array_map(function($val){
            return substr($val, 0,10);
        },$data);
    }


    /**
     * 获取用户当前连续签到7天数
     * @param array $data           时间数组
     * @param int $cycle            周期数
     * @return int
     */
    public function getSeriesDay(array $data,$cycle = 7){
        if(count($data) == 0){
            return 0;
        }

        rsort($data);

        $day      = 0;                                                         #连续天数
        $count    = count($data);                                              #数组总数
        $lastday  = date('Y-m-d',strtotime("last days"));        #昨日日期
        $today    = date('Y-m-d');                                     #今天日期

        for($i=0;$i< $count;$i++){
            if($day == $cycle){
                $day = 0;
            }

            if($i == 0){
                if(!in_array($data[0],[$today,$lastday])){
                    return 0;
                }
            }else {
                if($data[$i-1] != date('Y-m-d',strtotime("{$data[$i]} +1 days"))){
                    return $day;
                }
            }

            ++$day;
        }

        return $day;
    }


    /**
     * 获取签到页面数据统计
     * @param int $uid
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSigninData(int $uid){
        $data = [];
        $day = date('Y-m-d');

        $record = array_map(function($arr){
            $arr['signin_time']  = substr($arr['signin_time'], 0,10);
            return $arr;
        },self::where('uid',$uid)->select('signin_time','integral')->get()->toArray());

        $data['integral_total'] = intval(array_sum(array_column($record,'integral')));
        $data['signin_record']  = array_column($record,'signin_time');
        $data['signin_num']     = count($record);
        $tmpArr  =  array_flip($data['signin_record']);
        $data['isSamedaySignin']= isset($tmpArr[$day])?true:false;
        $data['today_integral'] = isset($tmpArr[$day])? $record[$tmpArr[$day]]['integral'] :0;
        $data['series_num']     = $this->getSeriesDay($data['signin_record']);

        return $data;
    }


    /**
     * 用户签到操作
     */
    public function userSignIn(int $uid){
        if($this->isSamedaySignin($uid)){
            return [false,'不能重复签到',1,[]];
        }

        $data = ['uid'=>$uid,'integral'=>mt_rand(2,5),'signin_time'=>date('Y-m-d H:i:s')];

        $remarks = '会员签到';
        if($this->getSeriesDay($this->getSigninRecord($uid)) == 6){
            $give_integral  = 30;
            $data['integral'] = $data['integral'] + $give_integral;
            $remarks.=" + 连续签到7天奖励{$give_integral}积分";
        }

        Db::beginTransaction();
        try {
            if(!$insertGetId = Db::table('sginin_record')->insertGetId($data)){
                throw new \Exception('添加签到记录失败', 2);
            }

            $scoreRecord = Db::table('score_record')->insertGetId([
                'uid'=>$uid,
                'score'=>$data['integral'],
                'type'=>1,
                'status'=>1,
                'flag'=>1,
                'remarks'=>$remarks,
                'source_id'=>$insertGetId,
                'created_time'=>$data['signin_time']
            ]);

            if(!$scoreRecord){
                throw new \Exception('添加积分记录失败', 3);
            }

            if(!Db::table('users')->where('id',$uid)->update(['score'=>DB::raw("score + {$data['integral']}"),'usable_score'=>DB::raw("usable_score + {$data['integral']}"),])){
                throw new \Exception('更新用户积分失败', 4);
            }

            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            return [false,$e->getMessage(),$e->getCode(),[]];
        }

        return [true,'签到成功',0,['integral'=>$data['integral'],'signin_time'=>date('Y-m-d')]];
    }
}
