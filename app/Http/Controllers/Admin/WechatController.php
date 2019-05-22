<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    /**
     * 微信菜单编辑页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function menu(){
		return view('admin.wechat.menu');
	}

    /**
     * 微信菜单发布接口
     */
	public function menuPublish(Request $request){

    }
}
