<?php
namespace App\Model\Rbac;

use Illuminate\Database\Eloquent\Model;
class Permissions extends Model
{
    protected $table = 'permissions';

    public function rolePermissions()
    {
        return $this->hasMany('App\Model\Rbac\RolePermissions','permissions_id');
    }
}