<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatController extends Controller
{
    

	public function menu(){
		return view('admin.wechat.menu');
	}

}
