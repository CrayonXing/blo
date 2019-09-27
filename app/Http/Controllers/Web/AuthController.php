<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\CController;
use App\User;

class AuthController extends CController
{
    
	public function login(Request $request){
		$isTrue = Auth::guard('web')->attempt(['mobile'=>$request->input('mobile',''),'password'=>$request->input('pwd','')],true);
        if($isTrue){
            return $this->ajaxSuccess('登录成功...');
        }

        return $this->ajaxReturn(402,'账号密码错误...');
	}

    public function register(Request $request){
        $mobile     = $request->input('mobile','');
        $smscode    = $request->input('smscode','');
        $password   = $request->input('pwd','');

        if(empty($mobile) || empty($smscode) || empty($password) || !preg_match('/^[1][3,4,5,7,8][0-9]{9}$/',$mobile) || !preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',$password)){
            return $this->ajaxParamError();
        }else if($smscode != '090827'){
            return $this->ajaxReturn(302,'验证码错误...');
        }

        try {
            $isTrue = User::create(['mobile' => $mobile,'password' => bcrypt($password),'created_at'=>date('Y-m-d H:i:s')]);
            if($isTrue){
                return $this->ajaxSuccess('账号注册成功...');
            }else{
                return $this->ajaxError('手机号已被他人使用...');
            }
        } catch (\Exception $e) {
            return $this->ajaxError('手机号已被他人使用...');
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();
        return redirect('/');
    }
}
