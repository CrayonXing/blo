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

        return view('admin.index.index',[
    		'PHP_OS'=>PHP_OS,
    		'PHP_VERSION'=>PHP_VERSION,//PHP版本
    		'zend_version'=>zend_version(), //ZEND版本
    		'mysql_version'=>$mysql_version['mysql_version'],
    		'upload_max_filesize'=>$upload_max_filesize,
    		'server_software'=>$_SERVER['SERVER_SOFTWARE'],
    		'timezone'=>config('app.timezone'),
    	]);
    }
}
