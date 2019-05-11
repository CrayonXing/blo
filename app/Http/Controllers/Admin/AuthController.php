<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;

class AuthController extends Controller
{

    public function login(){
        if(Auth::guard('admin')->user()){
            return redirect('/admin');
        }
        return view('admin.auth.login2');
    }

    /**
     * 登录验证
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toLogin(Request $request){
        if(!Captcha::check($request->post('code',''))){
            return response()->json([
                'code' => 401,
                'msg' => '验证码错误',
                'data' => []
            ]);
        }


        $isTrue = Auth::guard('admin')->attempt(['name'=>$request->post('username',''),'password'=>$request->post('password','')],true);

        if($isTrue){
            return response()->json([
                'code' => 200,
                'msg' => '登录成功...',
                'data' => []
            ]);
        }

        return response()->json([
            'code' => 402,
            'msg' => '账号密码错误',
            'data' => []
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }
}
