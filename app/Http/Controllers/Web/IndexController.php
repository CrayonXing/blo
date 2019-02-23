<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;

class IndexController extends BaseController
{

	public function index(){
		return view('web.index.index');
	}
}
