<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use EasyWeChat\Factory;

class WechatController extends Controller
{
    /**
     * 微信菜单编辑页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu(){
        $config = DB::table('config')->where('config_name','wechat_conf')->first();
        $data = [];
        if($config){
            $data = json_decode($config->config_params,true);
        }

        $config = [
            'app_id' => $data['wxPublicAppID'],
            'secret' => $data['wxPublicAppSecret'],
            'response_type' => 'array',
        ];

        $app = Factory::officialAccount($config);
        $menuJson = [];
        try{
            $current = $app->menu->current();
            if($current && isset($current['selfmenu_info'])){
                $menuJson = $current['selfmenu_info'];
            }
        }catch (\Exception $e){
            $menuJson = [];
        }


<<<<<<< HEAD
        

        return view('admin.wechat.menu-page',['menuJson'=>json_encode($menuJson)]);
    }
=======

		return view('admin.wechat.menu-page',['menuJson'=>json_encode($menuJson)]);
	}
>>>>>>> 1e296baf3dae1fa12d8aa24202091ce9c3764e9b

    /**
     * 微信菜单发布接口
     */
<<<<<<< HEAD
    public function publishMenuApi(Request $request){

        $menu = $request->post('menuJson','');
=======
	public function publishMenuApi(Request $request){
	    $menu = $request->post('menuJson','');
>>>>>>> 1e296baf3dae1fa12d8aa24202091ce9c3764e9b
        $config = DB::table('config')->where('config_name','wechat_conf')->first();
        $data = [];
        if($config){
            $data = json_decode($config->config_params,true);
        }

        $config = [
            'app_id' => $data['wxPublicAppID'],
            'secret' => $data['wxPublicAppSecret'],
            'response_type' => 'array',
        ];

        $app = Factory::officialAccount($config);
        $data = json_decode($menu,true);

        try{
            $result = $app->menu->create($data['button']);
            if($result['errcode'] == 0){
                return response()->json(['code' => 200,'msg' =>'菜单发布成功']);
            }
        }catch (\Exception $e){
            return response()->json(['code' => 305,'msg' =>"发布失败: 错误描述 [{$e->getMessage()}]"]);
        }

        return response()->json(['code' => 305,'msg' =>"发布失败: 错误码[{$result['errcode']}]-错误描述[{$result['errmsg']}]"]);
    }

    /**
     * 微信配置设置页面
     */
    public function wxConfPage(){
        $config = DB::table('config')->where('config_name','wechat_conf')->first();
        $data = [];
        if($config){
            $data = json_decode($config->config_params,true);
        }

        return view('admin.wechat.wx-config-page',['config'=>$data]);
    }

    /**
     * 微信配置设置接口
     */
    public function wxConfApi(Request $request){
        $data = $request->only(['wxPublicAppID', 'wxPublicAppSecret','wxPublicToken','wxMinProgramAppID','wxMinProgramAppSecret','wxMinProgramToken','wxMchID','wxMchKey','wxMchCertPath','wxMchKeyPath']);
        if($data && count($data) == 10){
            $data = array_map(function($val){
                return !is_null($val)?$val:'';
            },$data);
            $json = json_encode($data);
            if(DB::table('config')->where('config_name','wechat_conf')->exists()){
                $isTrue = DB::table('config')->where('config_name','wechat_conf')->update(['config_params'=>$json]);
            }else{
                $isTrue = DB::table('config')->insert(['config_name'=>'wechat_conf','config_params'=>$json]);
            }

            if($isTrue){
                return response()->json(['code' => 200,'msg' =>'编辑成功']);
            }
        }
        return response()->json(['code' => 305,'msg' =>'编辑失败']);
    }
}