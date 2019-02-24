<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class IndexController extends BaseController
{

	public function index(){
//	    dd(app('help')->getRankingList());
		return view('web.index.index');
	}
}
