<div class="web-main-left">
  <div class="web-main-header">
      <img src="https://thirdqq.qlogo.cn/qqapp/101404082/ADAC2A0D202D78CEFD0FD2D8EF8CB659/100" >
      <p class="web-main-header-name" >嘿！boy（远东）</p>
{{--      <p class="web-main-header-integral" >积分(150) <a href="/user-signin">签到</a></p>--}}
  </div>

  <div class="web-main-nav">
      <ul>
        <li @if(request()->path() == 'user-main') class="web-main-nav-current" @endif ><a href="/user-main">个人中心</a></li>
        <li @if(request()->path() == 'user-article-edit') class="web-main-nav-current" @endif ><a href="/user-article-edit">添加文章</a></li>
        <li @if(request()->path() == 'user-article') class="web-main-nav-current" @endif><a href="/user-article">文章管理</a></li>
        {{--<li @if(request()->path() == 'user-favorite') class="web-main-nav-current" @endif>文章收藏</li>--}}
        {{--<li @if(request()->path() == 'user-integral') class="web-main-nav-current" @endif>积分管理</li>--}}
        <li @if(request()->path() == 'user-datum') class="web-main-nav-current" @endif><a href="/user-datum">个人资料</a></li>
        <li @if(request()->path() == 'user-pwd') class="web-main-nav-current" @endif><a href="/user-pwd">修改密码</a></li>
      </ul>
  </div>
</div>