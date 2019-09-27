<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class IndexController extends CController
{

	public function index(){
		return view('web.index.index');
	}
}
