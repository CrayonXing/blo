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
        // if(Auth::guard('admin')->attempt(['email' => '837215079@qq.com', 'password' =>'aa123456'],true)){
        //     echo '登陆成功...';
        // }

        return view('admin.main.main');
    }

    public function index2(){
        dd(Auth::guard('admin')->user());
    }
}
