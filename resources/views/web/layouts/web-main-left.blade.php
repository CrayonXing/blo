<div class="web-main-left">
  <div class="web-main-header">
      <img src="/static/web/images/touxiao.jpg" >
      <p class="web-main-header-name" >嘿！boy（远东）</p>
  </div>

  <div class="web-main-nav">
      <ul>
        <li @if(request()->path() == 'user-main') class="web-main-nav-current" @endif ><a href="/user-main">个人中心</a></li>
        <li @if(request()->path() == 'user-article-edit') class="web-main-nav-current" @endif ><a href="/article/markdown-editor" target="_blank">添加文章</a></li>
        <li @if(request()->path() == 'user-article') class="web-main-nav-current" @endif><a href="/user-article">文章管理</a></li>
        <li @if(request()->path() == 'user-datum') class="web-main-nav-current" @endif><a href="/user-datum">个人资料</a></li>
        <li @if(request()->path() == 'user-pwd') class="web-main-nav-current" @endif><a href="/user-pwd">修改密码</a></li>
      </ul>
  </div>
</div>