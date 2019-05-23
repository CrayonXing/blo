<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\DTrait;
class Admin extends \Illuminate\Foundation\Auth\User
{
    use DTrait;

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 添加管理员方法
     */
    public function createAdmin(array $data){
        try {
            $isTrue  = self::create([
                'name' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'remember_token' => str_random(10),
                'status'=>10,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]);

            if($isTrue){
                return [true,'管理员添加成功...'];
            }

            return [false,'登录名已存在...'];
        } catch (\Exception $e) {
            return [false,'登录名已存在...'];
        }
    }

    /**
     * 获取管理员数据
     */
    public function getAdminList($page,$page_size,$params=[]){
        $countObj = DB::table('admin');
        $rowsObj = DB::table('admin');

        $rowsObj->select('admin.id','admin.name','admin.email','admin.status','admin.created_at');


        $rows = $rowsObj->forPage($page,$page_size)->get()->toArray();
        return $this->packData($rows,$countObj->count('*'),$page,$page_size);
    }
}
