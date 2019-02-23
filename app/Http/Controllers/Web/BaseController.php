<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{

    protected function uCheck(){
        return Auth::guard('web')->check();
    }

    protected function uInfo($keyname = ''){
    	if(!$this->uCheck()){
    		return false;
    	}

    	$info = Auth::guard('web')->user()->toArray();

    	if(!empty($keyname)){
    		return isset($info[$keyname]) ? $info[$keyname] : '';
    	}

    	return $info;
    }

    /**
     *  格式化返回数据
     */
    public function returnAjax($data,$msg='',$code=200,$httpstatus=200){
        return response()->json([
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ], $httpstatus);
    }
}
