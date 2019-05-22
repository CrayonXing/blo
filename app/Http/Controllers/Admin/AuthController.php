<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;

class AuthController extends Controller
{

    /**
     * 后台登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(){
        if(Auth::guard('admin')->user()){
            return redirect('/admin');
        }
        return view('admin.auth.login2');
    }

    /**
     * 登录验证接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toLogin(Request $request){
        if(!Captcha::check($request->post('code',''))){
            return response()->json(['code' => 401,'msg' => '验证码错误']);
        }

        if(Auth::guard('admin')->attempt(['name'=>$request->post('username',''),'password'=>$request->post('password','')],true)){
            return response()->json(['code' => 200,'msg' => '登录成功...']);
        }

        return response()->json(['code' => 402,'msg' => '账号密码错误']);
    }

    /**
     * Log the user out (Invalidate the token).
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    /**
     * 修改密码接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePwd(Request $request){
        $oldPassword = $request->post('oldpwd','');
        $newPassword = $request->post('newpwd','');

        if(empty($oldPassword) || empty($newPassword)){
            return response()->json(['code' => 301,'msg' => '请求参数错误错误']);
        }

        if (!\Hash::check($oldPassword,Auth::guard('admin')->user()->password)) {
            return response()->json(['code' => 302,'msg' => '旧密码填写错误']);
        }

        $admin = Auth::guard('admin')->user();
        $admin->password = bcrypt($newPassword);
        $isTrue = $admin->save();
        if($isTrue){
            return response()->json(['code' => 200,'msg' => '密码修改成功']);
        }

        return response()->json(['code' => 305,'msg' => '密码修改失败']);
    }
}
