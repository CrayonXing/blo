<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Model\Rbac\RbacAuth;
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
        $page        = $request->get('page',1);
        $page_size   = $request->get('limit',20);
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

    /**
     * 修改管理员状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chageAdminStatus(Request $request){
        $adminid = $request->post('id',0);
        $status = $request->post('status',null);

        if($adminid == 0 || !in_array($status,[0,10])){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }

        $res = Admin::where('id',$adminid)->update(['status' => $status]);
        if($res){
            return response()->json(['code' => 200,'msg' =>'修改成功']);
        }
        return response()->json(['code' => 305,'msg' =>'修改失败']);
    }

    /**
     * 修改管理员密码
     */
    public function resetAdminPassword(Request $request){
        $adminid  = $request->post('id',0);
        $password = $request->post('password','');
        $secretkey = $request->post('secretkey','');

        if($adminid == 0 || empty($password)){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }

        if($secretkey != 'admin888'){
            return response()->json(['code' => 302,'msg' =>'操作令牌验证错误']);
        }

        $res = Admin::where('id',$adminid)->update(['password' => bcrypt($password)]);
        if($res){
            return response()->json(['code' => 200,'msg' =>'修改成功']);
        }
        return response()->json(['code' => 305,'msg' =>'修改失败']);
    }


    public function test(){
        $auth = new RbacAuth();

        $auth->test();
    }
}