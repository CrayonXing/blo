<?php
namespace App\Model\Rbac;

use App\Model\Rbac\AdminRole;
use App\Model\Rbac\Permissions;
use App\Model\Rbac\RolePermissions;
use App\Model\Rbac\Roles;


/**
 * Rbac 权限控制类
 * Class RbacAuth
 * @package App\Model
 */
class RbacAuth
{

    /**
     * 检测用户是否有权限
     * @param $routeAlias 请求地址路由别名
     */
    public function can($routeAlias){

    }

    /**
     * 管理员赋予角色
     * @param int $adminID       管理员ID
     * @param array $roleArr     角色ID
     */
    public function adminGiveRole(int $adminID,array $roleArr){

    }

    /**
     * 创建角色
     * @param array $data 角色信息
     */
    public function roleCreate(array $data){

    }

    /**
     * 删除角色
     * @param $data
     */
    public function removeRole(array $data){

    }

    /**
     * 角色赋予权限
     * @param int $roleId           角色ID
     * @param array $permissionArr  权限
     */
    public function roleGivePermissionTo(int $roleId,array $permissionArr){

    }

    /**
     * 添加权限
     * @param array $data 权限信息
     */
    public function permissionCreate(array $data){

    }

    /**
     * 移除权限
     * @param array $data   权限数组
     */
    public function removePermission(array $data){

    }



    public function test(){

    }
}