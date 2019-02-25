<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Facades\Help;

class Category extends Model
{

    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'category';

    /**
     * 不能被批量赋值的属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = [''];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 获取首页导航信息
     * @return array
     */
    public function getNav(){
        $rows = self::where('reveal',1)->select(['id','pid','name','sort'])->get()->toArray();
        if($rows){
            return $this->getTree($rows);
        }
        return [];
    }

    public function getTree($data, $pid = 0){
        $tree = [];
        foreach($data as $k => $v)
        {
            if($v['pid'] == $pid){
                $v['childnode'] = $this->getTree($data, $v['id']);
                $tree[] = $v;
            }
        }
        $tree = array_values(array_sort($tree, function ($value) {
            return $value['sort'];
        }));

        return $tree;
    }
}
