<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class IndexController extends BaseController
{

	public function index(){
		return view('web.index.index');
	}


	public function  swooleTest(){
		$server = $_SERVER['swoole_socket'];
		foreach ($server->connections as $fd) {
		    $s = $server->connection_info($fd);
            if($s['websocket_status'] == 3){
               $server->push($fd, json_encode(['text'=>'这个是测试内容']));
            }
        }
	}
}
