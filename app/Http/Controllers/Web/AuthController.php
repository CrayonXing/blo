<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Model\User;

class AuthController extends CController
{

    /**
     * 账号登陆接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function login(Request $request){
        if(!$request->filled(['mobile','pwd'])){
            return $this->ajaxParamError();
        }

	    if($this->checkLogin()){
            return $this->ajaxReturn(301,'不能重复登录...');
        }

        if($this->guard()->attempt(['mobile'=>$request->post('mobile'),'password'=>$request->post('pwd')],true)){
            return $this->ajaxSuccess('登录成功...');
        }

        return $this->ajaxReturn(402,'账号密码错误...');
	}

    /**
     * 账号注册接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $data = $request->only(['mobile','smscode','pwd']);
        if(!$request->filled(['mobile','smscode','pwd'])){
            return $this->ajaxParamError();
        }

        if(!preg_match('/^[1][3,4,5,7,8][0-9]{9}$/',$data['mobile']) || !preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',$data['pwd'])){
            return $this->ajaxParamError();
        }else if($data['smscode'] != '090827'){
            return $this->ajaxReturn(302,'验证码错误...');
        }

        if($this->checkLogin()){
            return $this->ajaxReturn(303,'请退出后在进行注册...');
        }

        try {
            $isTrue = User::create(['mobile' => $data['mobile'],'password' => bcrypt($data['pwd']),'created_at'=>date('Y-m-d H:i:s')]);
        } catch (\Exception $e) {
            $isTrue = false;
        }

        return $isTrue ? $this->ajaxSuccess('账号注册成功...') : $this->ajaxError('手机号已被他人使用...');
    }

    /**
     * 退出登录接口
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();
        return redirect('/');
    }
}
