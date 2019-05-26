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



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pid','route','description','type'
    ];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

}