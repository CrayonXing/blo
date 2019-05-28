<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * 后台主页面
     * @return string
     */
    public function index(Request $request){
    	$mysql_version = (array)DB::select('select version() as mysql_version');
    	$mysql_version = (array)$mysql_version[0];

    	$upload_max_filesize =  get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件";

    	$newArticle = DB::table('article')
            ->select('article.id','article.title','users.nickname','article.created_time','category.name as category_name')
            ->leftJoin('users', 'article.uid', '=', 'users.id')
            ->leftJoin('category', 'article.category_id', '=', 'category.id')
            ->orderBy('article.created_time','desc')->limit(7)
            ->get()->toArray();

        return view('admin.index.index',[
    		'PHP_OS'=>PHP_OS,
    		'PHP_VERSION'=>PHP_VERSION,//PHP版本
    		'zend_version'=>zend_version(), //ZEND版本
    		'mysql_version'=>$mysql_version['mysql_version'],
    		'upload_max_filesize'=>$upload_max_filesize,
    		'server_software'=>$_SERVER['SERVER_SOFTWARE'],
    		'timezone'=>config('app.timezone'),
            'newArticle'=>$newArticle,
    	]);
    }

    /**
     * 首页分类统计
     */
    public function articlecCensus(){
        $rows = DB::table('category')->select('id','name')->get()->toArray();

        $series = [];
        $start_time = date('Y-m-d 00:00:00',strtotime('-6 days'));
        $end_time = date('Y-m-d 23:59:59');

        $arr = (array)DB::select("select DATE_FORMAT(created_time,'%Y%m%d') as days,category_id,count(*) count from lar_article where created_time between '{$start_time}' and '{$end_time}'  group by days,category_id");
        $arr = $this->arrGroup($arr,'category_id');

        $dateArr = [];
        $xAxis = [];
        $legend = [];
        for ($i=0;$i<7;$i++){
            $dateArr[date('Ymd',strtotime("-$i days"))] = 0;
            $xAxis[] = date('m/d',strtotime("-$i days"));
        }

        foreach ($rows as $row){
            $tmp_date_arr = $dateArr;
            $cid = $row->id;
            if(isset($arr[$cid])){

                foreach ($arr[$row->id] as $v){
                    $tmp_date_arr[$v->days] = $tmp_date_arr[$v->days]+$v->count;
                }

                ksort($tmp_date_arr);
            }


            $series[] = [
                'id'=>$row->id,
                'name'=>$row->name,
                'type'=>'bar',
                'tooltip'=>['trigger'=>'item'],
                'stack'=>$row->name,
                'data'=>array_values($tmp_date_arr),
            ];


            $legend[] = $row->name;
        }

        sort($xAxis);

        return response()->json(['code' => 200,'msg' => '','data'=>['series'=>$series,'legend'=>$legend,'xAxis'=>$xAxis]]);
    }

    /**
     * 二维数组通过指定的key 进行分组
     * @param array $array
     * @param $key
     * @return array
     */
    public function arrGroup(array $array,$index){
        $result = [];
        foreach($array as $value){
            if(is_array($value)){
                $result[$value[$index]][] = $value;
            }else{
                $result[$value->$index][] = $value;
            }
        }

        return $result;
    }
}
