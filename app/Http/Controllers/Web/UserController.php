<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\User;
use App\Model\Article;
use App\Model\Category;

use App\Helpers\Tree;

use App\Helpers\SigninCalendar;

use App\Model\SigninRecord;


class UserController extends CController
{

    public function index(){
    	return view('web.user.main');
    }

    public function article(Category $category){
        $data = [];

        if($categoryList = $category->select(['id','pid','sort','name'])->orderBy('pid','asc')->orderBy('sort','asc')->get()){
            $data = $categoryList->toArray();
        }

    	return view('web.user.article',['list'=>$data]);
    }

    public function password(){
    	return view('web.user.chenge-pwd');
    }

    /**
     * 用户资料页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function datum(){
        $resource = opendir($path = public_path('static/sys-head'));

        $imgs = [];
        while ($file = readdir($resource)){
            if($file == '.' || $file == '..'){
                continue;
            }

            $imgs[] = asset("static/sys-head/{$file}");
        }
        
        return view('web.user.user-datum',['uinfo'=>$this->getUser(true),'imgs'=>$imgs]);
    }


    /**
     * 修改面提交处理接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editPassword(Request $request){
    	$oldpwd     = $request->input('oldpwd','');
        $newpwd    = $request->input('newpwd','');
        $newpwd2   = $request->input('newpwd2','');

        if(empty($oldpwd) || empty($newpwd) || empty($newpwd2)){
			return $this->ajaxParamError();
        }else if(!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',$newpwd)){
        	return $this->ajaxParamError('新密码格式错误...');
        }else if($newpwd !== $newpwd2){
			return $this->ajaxParamError('确认密码填写错误');
        }

    	list($isOk,$msg,$code) = User::chnagePwd($this->uid(),$oldpwd,$newpwd);
        return $this->ajaxReturn($code,$msg);
    }

    /**
     * 获取列表数据
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserArticleList(Request $request,Article $article){
        $page       = (int)$request->get('page', 1);
        $page_size  = (int)$request->get('page_size', 15);
        $category   = $request->get('category', '');



        return $this->ajaxSuccess('success',$article->getUserArticle(20,$page,$page_size,['category'=>$category]));
    }

    /**
     * 用户资料编辑
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datumEdit(Request $request){
        $nickname = $request->input('nickname','');
        $motto    = $request->input('motto','');
        $tags     = $request->input('tags','');
        $head     = $request->input('head','');

        $isTrue = User::where('id',$this->uid())->update(['nickname'=>$nickname,'motto'=>$motto,'tags'=>$tags,'head'=>$head]);
        if($isTrue !== false){
            return $this->ajaxSuccess('资料修改成功');
        }

        return $this->ajaxError('资料修改失败');
    }



    public function uploadHead(Request $request){
        $img = $_POST['img'];
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = '100001/'.date('ymd').'/'.uniqid().'.jpeg';
        \Storage::disk('public')->put($path, $data);
        return $this->ajaxSuccess('上传成功',['url'=>asset("storage/{$path}")]);
    }
}