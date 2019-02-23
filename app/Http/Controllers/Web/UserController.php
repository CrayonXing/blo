<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
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


    public function editPassword(){
    	$oldpwd     = $request->input('oldpwd','');
        $newpwd    = $request->input('newpwd','');
        $newpwd2   = $request->input('newpwd2','');
        

    	list($isOk,$msg,$code) = User::chnagePwd(20,$oldpwd,$newpwd);

    	return response()->json(['code'=>$code,'msg'=>$msg,'data'=>[]]);
    }
}
