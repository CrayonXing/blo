<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\User;
use App\Model\Article;
use App\Model\Category;

use App\Helpers\Tree;

use App\Helpers\SigninCalendar;

use App\Model\SigninRecord;


class UserController extends BaseController
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
        
        return view('web.user.user-datum',['uinfo'=>$this->uInfo(),'imgs'=>$imgs]);
    }

    /**
     * 用户签到页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function signin(Request $request,SigninCalendar $signinCalendar,SigninRecord $signinRecord){
        $year  = (int)$request->input('y',date('Y'));
        $month = (int)$request->input('m',date('m'));

        if($month == 1){
            $lastY = $year -1;$lastM = 12;
        }else{
            $lastY = $year;$lastM = $month - 1;
        }

        if($month==12){
            $nextM = 1;$nextY = $year + 1;
        }else{
            $nextM = $month + 1;$nextY = $year;
        }

        $signinStr = $signinCalendar->init($year,$month,$signinRecord->getSigninRecord($this->uInfo('id'),$year,$month));

        return view('web.user.user-signin',[
            'isSignin'      =>$signinRecord->isSamedaySignin($this->uInfo('id')),
            'signinCalendar'=>$signinStr,
            'date'          =>date('Y年m月',strtotime("{$year}-{$month}")),
            'lastMonth'     =>'/user-signin?y='.$lastY.'&m='.$lastM,
            'nextMonth'     =>'/user-signin?y='.$nextY.'&m='.$nextM,
        ]);
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
			return $this->returnAjax([],'参数不符合规范',301);
        }else if(!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',$newpwd)){
        	return $this->returnAjax([],'新密码格式错误',301);
        }else if($newpwd !== $newpwd2){
			return $this->returnAjax([],'确认密码填写错误',301);
        }

    	list($isOk,$msg,$code) = User::chnagePwd($this->uInfo('id'),$oldpwd,$newpwd);

    	return $this->returnAjax([],$msg,$code);
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
        return $this->returnAjax($article->getUserArticle(20,$page,$page_size,['category'=>$category]));
    }

    /**
     * 编辑文章
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articleEdit(Request $request,Article $article,Category $category){
        $aid = (int)$request->get('aid',0);

        $info = $article->getEditArticle($aid,$this->uInfo('id'));

        $data = [];
        if($categoryList = $category->select(['id','pid','sort','name'])->orderBy('pid','asc')->orderBy('sort','asc')->get()){
            $data = $categoryList->toArray();
        }

        $tree = Tree::instance();
        $tree->init($data, 'pid');

        return view('web.user.article-edit',['info'=>$info,'category_tree'=>$tree->getTreeList($tree->getTreeArray(0), 'name')]);
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

        $isTrue = User::where('id',$this->uInfo('id'))->update(['nickname'=>$nickname,'motto'=>$motto,'tags'=>$tags,'head'=>$head]);
        if($isTrue !== false){
            return $this->returnAjax([],'资料修改成功');
        }

        return $this->returnAjax([],'资料修改失败',305);
    }


    /**
     * 用户签到接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userSign(Request $request,SigninRecord $signinRecord){
        list($isOK,$msg,$code,$data) = $signinRecord->userSignIn($this->uInfo('id'));

        if($isOK){
            return $this->rJson(200,'签到成功');
        }

        if($code == 1){
            return $this->rJson(302,'不能重复签到');
        }

        return $this->rJson(305,'签到失败');
    }


    public function uploadHead(Request $request){
        $img = $_POST['img'];
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $path = '100001/'.date('ymd').'/'.uniqid().'.jpeg';
        \Storage::disk('public')->put($path, $data);
        return $this->rJson(200,'上传成功',['url'=>asset("storage/{$path}")]);
    }
}