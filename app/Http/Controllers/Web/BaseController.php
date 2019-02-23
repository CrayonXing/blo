<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{

	public function __construct()
    {
        
    }

    public function uCheck(){
        return Auth::guard('web')->check();
    }

    public function uInfo(){
    	return Auth::guard('web')->user();
    }
}
