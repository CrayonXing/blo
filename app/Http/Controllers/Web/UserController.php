<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\User;
use App\Model\Article;
use App\Model\Category;

class UserController extends CController
{

    /**
     * 个人中心主页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = $this->getUser(true);
    	return view('web.user.main',['userInfo'=>$user]);
    }

    /**
     * 用户文章管理列表
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function article(Category $category){
        $data = [];
        if($categoryList = $category->select(['id','pid','sort','name'])->orderBy('pid','asc')->orderBy('sort','asc')->get()){
            $data = $categoryList->toArray();
        }
    	return view('web.user.article',['list'=>$data]);
    }

    /**
     * 用户修改密码页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password(){
    	return view('web.user.chenge-pwd');
    }

    /**
     * 用户资料页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function datum(){
        return view('web.user.user-datum',['uinfo'=>$this->getUser(true)]);
    }


    /**
     * 修改面提交处理接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editPassword(Request $request){
        $data = $request->only(['oldpwd','newpwd','newpwd2']);
        if(!$request->filled(['oldpwd','newpwd','newpwd2'])){
            return $this->ajaxParamError();
        }

        if(!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,16}$/',$data['newpwd'])){
        	return $this->ajaxParamError('新密码格式错误...');
        }else if($data['newpwd'] !== $data['newpwd2']){
			return $this->ajaxParamError('确认密码填写错误');
        }

    	[$isOk,$msg,$code] = User::chnagePwd($this->uid(),$data['oldpwd'],$data['newpwd']);

        return $this->ajaxReturn($code,$msg);
    }

    /**
     * 获取文章列表数据
     *
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserArticleList(Request $request,Article $article){
        $page       = $request->get('page', 1);
        $category   = $request->get('category', '');

        return $this->ajaxSuccess('success',$article->getUserArticle($this->uid(),$page,15,['category'=>$category]));
    }

    /**
     * 用户资料编辑数据提交接口
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datumEdit(Request $request){
        $data = $request->only(['nickname','motto','tags','head']);
        $isTrue = User::where('id',$this->uid())->update($data);

        return $isTrue ? $this->ajaxSuccess('资料修改成功') : $this->ajaxError('资料修改失败');
    }
}