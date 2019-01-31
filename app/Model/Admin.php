<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends \Illuminate\Foundation\Auth\User
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 添加管理员方法
     */
    public function createAdmin(array $data){
        try {
            $isTrue  = self::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'remember_token' => str_random(10),
                'expiry_time'=>$this->_getExpiryTime()
            ]);

            if($isTrue){
                return [true,'管理员添加成功...'];
            }

            return [false,'登录名已存在...'];
        } catch (\Exception $e) {
            return [false,'登录名已存在...'];
        }
    }

    /**
     * 获取管理员登录的过期时间
     */
    private function _getExpiryTime(){
        return date('Y-m-d H:i:s',strtotime('+30 day'));
    }
}
