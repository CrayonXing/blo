<?php
namespace App\Model\Rbac;

use Illuminate\Support\Facades\DB;


/**
 * Rbac 权限控制类
 * Class RbacAuth
 * @package App\Model
 */
class RbacAuth
{

    /**
     * 检测用户是否有权限
     * @param $adminID        管理员ID
     * @param $routeAlias     请求地址路由别名
     * @return bool
     */
    public static function can($adminID,$routeAlias){
        $isTrue = DB::table('admin_role')
            ->leftJoin('role_permissions','admin_role.role_id','=','role_permissions.role_id')
            ->leftJoin('roles','roles.id','=','admin_role.role_id')
            ->leftJoin('permissions','role_permissions.permissions_id','=','permissions.id')
            ->where('admin_role.admin_id',$adminID)
            ->where('roles.status',10)
            ->where('permissions.route',$routeAlias)
            ->exists();
        return $isTrue?true:false;
    }

    /**
     * 管理员赋予角色
     * @param int $adminID       管理员ID
     * @param array $roleArr     角色ID
     * @return bool
     */
    public function adminGiveRole(int $adminID,array $roleArr){
        $arr = [];
        foreach ($roleArr as $id){
            $arr[] = ['admin_id'=>$adminID,'role_id'=>$id];
        }

        DB::beginTransaction();
        try{
            DB::table('admin_role')->where('admin_id',$adminID)->delete();
            DB::table('admin_role')->insert($arr);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }

        return true;
    }

    /**
     * 创建角色
     * @param $name          角色名称
     * @param $description   角色描述
     * @return bool
     */
    public function roleCreate($name,$description,$status=10){
        try{
            $res = Roles::create([
                'name'         =>$name,
                'description'   =>$description,
                'status'        =>$status,
                'created_at'    =>date('Y-m-d H:i:s')
            ]);
        }catch (\Exception $e){
            return false;
        }

        return $res?true:false;
    }

    /**
     * 更新角色
     * @param $name          角色名称
     * @param $description   角色描述
     * @return bool
     */
    public function roleUpdate($role_id,$name,$description,$status=10){
        try{
            $res = Roles::where('id',$role_id)->update([
                'name'          =>$name,
                'description'   =>$description,
                'status'        =>$status
            ]);
        }catch (\Exception $e){
            return false;
        }

        return $res?true:false;
    }

    /**
     * 删除角色
     * @param $role_id
     * @return bool
     */
    public function removeRole($role_id){
        $info = Roles::where('id',$role_id)->first();
        if(!$info){
            return false;
        }

        DB::beginTransaction();
        try{
            if($info){
                $info->permissions()->delete();
                $info->adminRoles()->delete();
                $info->delete();
            }

            DB::commit();
        }catch (\Exception $exception){
            Db::rollBack();
            return false;
        }

        return true;
    }

    /**
     * 角色赋予权限
     * @param int $roleId           角色ID
     * @param array $permissionArr  权限
     * @return bool
     */
    public function roleGivePermissionTo(int $roleId,array $permissionArr){
        $arr = [];
        foreach ($permissionArr as $permissions_id){
            $arr[] = ['role_id'=>$roleId,'permissions_id'=>$permissions_id];
        }

        DB::beginTransaction();
        try{
            DB::table('role_permissions')->where('role_id',$roleId)->delete();
            DB::table('role_permissions')->insert($arr);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }

        return true;
    }

    /**
     * 添加权限
     * @param string $route           权限路由
     * @param string $description     权限描述
     * @param int $pid                权限父ID
     * @return bool
     */
    public function permissionCreate(string $route,string $description,$pid=0){
        $res = Permissions::create([
            'pid'=>$pid,
            'route'=>$route,
            'description'=>$description
        ]);

        return $res?true:false;
    }

    /**
     * 移除权限
     * @param int $permissions_id
     * @return bool
     */
    public function removePermission(int $permissions_id){
        $info = Permissions::where('id',$permissions_id)->first();
        if(!$info){
            return false;
        }
        DB::beginTransaction();
        try{
            $info->rolePermissions()->delete();
            $info->delete();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return false;
        }

        return false;
    }
}