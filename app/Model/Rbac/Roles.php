<?php
namespace App\Model\Rbac;

use Illuminate\Database\Eloquent\Model;
class Roles extends Model
{
    protected $table = 'roles';


    public function adminRoles()
    {
        return $this->hasMany('App\Model\Rbac\AdminRole','role_id');
    }



    public function permissions()
    {
        return $this->hasMany('App\Model\Rbac\RolePermissions','role_id');
    }

}