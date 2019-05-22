<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Admin;
class RbacController extends Controller
{
    /**
     * 管理员管理页面
     */
    public function adminMangePage(Request $request){
        return view('admin.rbac.admin-mange-page');
    }

    /**
     * 获取管理员数据接口
     */
    public function getAdminApi(Request $request,Admin $admin){
        $page        = $request->post('page',1);
        $page_size   = $request->post('limit',20);
        $params      = [];

        $data = $admin->getAdminList($page,$page_size,$params);
        return response()->json(['code' =>200,'msg' =>'','data'=>$data]);
    }

    /**
     * 管理员信息编辑接口
     */
    public function adminEditApi(Request $request,Admin $admin){

    }

    /**
     * 添加管理员接口
     */
    public function adminAddApi(Request $request,Admin $admin){
        $name       = $request->post('username','');
        $password   = $request->post('password','');
        $email      = $request->post('email','');

        if(empty($name) || empty($password)){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }

        list($isTrue,$msg) = $admin->createAdmin(['username'=>$name,'password'=>$password,'email'=>$email]);
        return response()->json(['code' => $isTrue?200:305,'msg' =>$msg]);
    }
}