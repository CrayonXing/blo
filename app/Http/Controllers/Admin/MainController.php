<?php
namespace App\Http\Controllers\Admin;

use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


use App\Model\Admin;
class MainController extends Controller
{

    /**
     * 后台主体布局页面
     * @return string
     */
    public function index(Request $request){
        return view('admin.layout.layout');
    }

    public function index2(){
        dd(Auth::guard('admin')->user());
    }
}
