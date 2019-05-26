<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use App\Model\Rbac\Roles;
use App\Model\Rbac\Permissions;

use App\Model\Rbac\RolePermissions;
use App\Helpers\Tree;

use App\Model\Rbac\RbacAuth;
use Illuminate\Support\Facades\DB;

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

    /**
     * 管理员分配角色页面
     */
    public function giveRolePage(Request $request){
        $id = $request->get('id');
        $sqlObj = DB::table('roles')
            ->select('roles.id','roles.name','roles.description','admin_role.admin_id')
            ->leftJoin('admin_role', function ($join) use ($id) {
                $join->on('admin_role.role_id','=','roles.id')->where('admin_role.admin_id', '=', $id);
            })->get();

        $data = [];
        if($sqlObj){
            $data = $sqlObj->toArray();
        }

        return view('admin.rbac.give-role-page',['roles'=>$data,'adminID'=>$id]);
    }

    /**
     * 管理员分配角色接口
     * @param Request $request
     * @param RbacAuth $rbacAuth
     * @return \Illuminate\Http\JsonResponse
     */
    public function giveRoleApi(Request $request,RbacAuth $rbacAuth){
        $ids    = $request->post('ids','');
        $adminID = (int)$request->post('adminID',0);

        $ids = trim($ids,',');
        if($adminID == 0 || empty($ids)){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }

        $arr = explode(',',$ids);
        if($rbacAuth->adminGiveRole($adminID,$arr)){
            return response()->json(['code' => 200,'msg' =>'授权成功']);
        }

        return response()->json(['code' => 305,'msg' =>'授权失败']);
    }

    /**
     * 角色管理页面
     */
    public function roleMangePage(){
        return view('admin.rbac.role-mange-page');
    }

    /**
     * 获取角色数据接口
     */
    public function getRoleApi(Request $request,Roles $roles){
        $page        = $request->get('page',1);
        $page_size   = $request->get('limit',20);
        $params      = [];

        $data = $roles->getRoleList($page,$page_size,$params);
        return response()->json(['code' =>200,'msg' =>'','data'=>$data]);
    }

    /**
     * 修改角色状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chageRoleStatus(Request $request){
        $adminid = $request->post('id',0);
        $status = $request->post('status',null);

        if($adminid == 0 || !in_array($status,[0,10])){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }

        $res = Roles::where('id',$adminid)->update(['status' => $status]);
        if($res){
            return response()->json(['code' => 200,'msg' =>'修改成功']);
        }
        return response()->json(['code' => 305,'msg' =>'修改失败']);
    }

    /**
     * 权限管理页面
     */
    public function permissionsMangePage(){
        $rows = [];
        if($data = Permissions::all()){
            $rows = $data->toArray();
        }

        $tree = Tree::instance();
        $tree->init($rows, 'pid');
        $treeList = $tree->getTreeList($tree->getTreeArray(0), 'description');

        $rows2 = [];
        if($rows){
            foreach($rows as $v){
                if($v['type'] != 2){
                    $rows2[] = $v;
                }
            }
        }

        $tree2 = Tree::instance();
        $tree2->init($rows2, 'pid');
        $tree2List = $tree2->getTreeList($tree2->getTreeArray(0), 'description');

        return view('admin.rbac.permissions-mange-page',['treeList'=>$treeList,'select'=>$tree2List]);
    }

    /**
     * 分配权限页面
     */
    public function givePermissionsPage(Request $request){
        $roleID = (int)$request->get('id',0);

        $rows = [];
        if($data = Permissions::select('id','pid','description as title')->get()){
            $rows = $data->toArray();
        }


        $rolePermissions = RolePermissions::select('permissions_id')->where('role_id',$roleID)->get();
        if($rolePermissions){
            $rolePermissions = $rolePermissions->toArray();
        }

        $rolePermissions = array_column($rolePermissions,'permissions_id');

        foreach ($rows as $k=>$row){
            $rows[$k]['checked']= in_array($row['id'],$rolePermissions)?true:false;
            $rows[$k]['open']=true;
        }

        $roleInfo = Roles::where('id',$roleID)->first();
        return view('admin.rbac.give-permissions-page',['data'=>json_encode($rows),'roleInfo'=>$roleInfo]);
    }

    /**
     * 分配权限接口
     */
    public function givePermissionsApi(Request $request,RbacAuth $rbacAuth){
        $permission_ids  = $request->post('ids','');
        $roleID          = (int)$request->post('roleID',0);

        $permission_ids = trim($permission_ids,',');

        if($roleID == 0 || empty($permission_ids)){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }

        $arr = explode(',',$permission_ids);
        if($rbacAuth->roleGivePermissionTo($roleID,$arr)){
            return response()->json(['code' => 200,'msg' =>'授权成功']);
        }
        return response()->json(['code' => 305,'msg' =>'授权失败']);
    }

    /**
     * 添加或编辑角色
     */
    public function createRoleApi(Request $request,RbacAuth $rbacAuth){
        $id     = (int)$request->post('id',0);
        $name   = $request->post('name','');
        $desc   = $request->post('desc','');
        $status = $request->post('status',null);

        if(empty($name) || empty($desc) || !in_array($status,[0,10])){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }

        if($id == 0){
            if($rbacAuth->roleCreate($name,$desc,$status)){
                return response()->json(['code' => 200,'msg' =>'角色添加成功']);
            }
            return response()->json(['code' => 302,'msg' =>'角色名已存在']);
        }

        if($rbacAuth->roleUpdate($id,$name,$desc,$status)){
            return response()->json(['code' => 200,'msg' =>'角色添加成功']);
        }

        return response()->json(['code' => 302,'msg' =>'角色名已被他人使用']);
    }

    public function editPermissionsApi(Request $request,RbacAuth $rbacAuth){
        $id    = (int)$request->post('id',0);
        $pid   = (int)$request->post('pid',0);
        $name  = $request->post('name','');
        $route = $request->post('route','');
        $type  = $request->post('type',null);

        if(empty($name) || empty($route) || !in_array($type,[0,1,2])){
            return response()->json(['code' => 301,'msg' =>'请求参数错误']);
        }
        $type = intval($type);


        if($id == 0){
            $isTrue = $rbacAuth->permissionCreate($pid,$route,$name,$type);
        }else{
            $isTrue = $rbacAuth->permissionEdit($id,$pid,$route,$name,$type);
        }

        if($isTrue){
            return response()->json(['code' => 200,'msg' =>'编辑成功']);
        }
        return response()->json(['code' => 305,'msg' =>'编辑失败']);
    }
}