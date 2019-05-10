<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 后台主页面
     * @return string
     */
    public function index(Request $request){
        return view('admin.index.index');
    }
}
