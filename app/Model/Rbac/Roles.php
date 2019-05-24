<?php
namespace App\Model\Rbac;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\DTrait;
class Roles extends Model
{
    use DTrait;

    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status','created_at'
    ];


    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    public function adminRoles()
    {
        return $this->hasMany('App\Model\Rbac\AdminRole','role_id');
    }

    public function permissions()
    {
        return $this->hasMany('App\Model\Rbac\RolePermissions','role_id');
    }

    /**
     * 获取角色数据
     */
    public function getRoleList($page,$page_size,$params=[]){
        $countObj = DB::table('roles');
        $rowsObj = DB::table('roles');


        $latestPosts = DB::table('admin_role')->select(DB::raw('count(*) as user_count, role_id'))->groupBy('role_id');
        $rowsObj->select('roles.id','roles.name','roles.description','roles.status','roles.created_at',DB::raw('ifnull(latest_posts.user_count,0) as user_count'));
        $rowsObj->leftJoinSub($latestPosts, 'latest_posts', function($join) {
            $join->on('roles.id', '=',DB::raw('latest_posts.role_id'));
        });

        $rows = $rowsObj->forPage($page,$page_size)->get()->toArray();
        return $this->packData($rows,$countObj->count('*'),$page,$page_size);
    }
}