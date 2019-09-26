<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile', 'password','created_at'
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
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 修改用密码
     */
    public static function chnagePwd($uid,$old_pwd,$new_pwd){
        $info = self::find($uid);
        if(!$info){
            return [false,'用户不存在',302];
        }

        if (!\Hash::check($old_pwd, $info->password)) {
            return [false,'原始密码输入错误',303];
        }

        $res = self::where('id', $uid)->update(['password'=>bcrypt($new_pwd)]);

        if($res){
            return [true,'密码修改成功',200];
        }

        return [false,'密码修改失败...',305];
    }
}


