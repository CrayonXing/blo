<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\BaseController;
use App\User;

class AuthController extends BaseController
{
    
	public function login(Request $request){
		$isTrue = Auth::guard('web')->attempt(['mobile'=>$request->input('mobile',''),'password'=>$request->input('pwd','')],true);

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

    public function register(Request $request){
        $mobile     = $request->input('mobile','');
        $smscode    = $request->input('smscode','');
        $password   = $request->input('pwd','');

        if(empty($mobile) || empty($smscode) || empty($password) || !preg_match('/^[1][3,4,5,7,8][0-9]{9}$/',$mobile)){
            return response()->json([
                'code' => 301,
                'msg' => '参数不符合规范...',
                'data' => []
            ]);
        }else if($smscode != '090827'){
            return response()->json([
                'code' => 302,
                'msg' => '验证码错误',
                'data' => []
            ]);
        }

        

        try {
            $isTrue = User::create([
                'mobile' => $mobile,
                'password' => bcrypt($password),
                'created_at'=>date('Y-m-d H:i:s')
            ]);

            if($isTrue){
                return response()->json([
                    'code' => 200,
                    'msg' => '账号注册成功',
                    'data' => []
                ]);
            }else{
                return response()->json([
                    'code' => 305,
                    'msg' => '手机号已被他人使用',
                    'data' => []
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 305,
                'msg' => '手机号已被他人使用',
                'data' => []
            ]);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }
}
