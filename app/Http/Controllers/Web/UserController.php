<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends BaseController
{


    public function index(){
    	return view('web.user.main');
    }

    public function article(){
    	return view('web.user.article');
    }

    public function password(){
    	return view('web.user.chenge-pwd');
    }


    public function editPassword(Request $request){
    	$oldpwd     = $request->input('oldpwd','');
        $newpwd    = $request->input('newpwd','');
        $newpwd2   = $request->input('newpwd2','');

        if(empty($oldpwd) || empty($newpwd) || empty($newpwd2)){
			return $this->returnAjax([],'参数不符合规范',301);
        }else if(!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',$newpwd)){
        	return $this->returnAjax([],'新密码格式错误',301);
        }else if($newpwd !== $newpwd2){
			return $this->returnAjax([],'确认密码填写错误',301);
        }

    	list($isOk,$msg,$code) = User::chnagePwd($this->uInfo('id'),$oldpwd,$newpwd);

    	return $this->returnAjax([],$msg,$code);
    }
}