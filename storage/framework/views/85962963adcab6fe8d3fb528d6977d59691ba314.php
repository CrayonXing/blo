<div class="web-main-left">
  <div class="web-main-header">
      <img src="https://thirdqq.qlogo.cn/qqapp/101404082/ADAC2A0D202D78CEFD0FD2D8EF8CB659/100" >
      <p class="web-main-header-name" >嘿！boy (ID：2068161)</p>
      <p class="web-main-header-integral" >积分(150) <a href="/user-signin">签到</a></p>
  </div>

  <div class="web-main-nav">
      <ul>
        <li <?php if(request()->path() == 'user-main'): ?> class="web-main-nav-current" <?php endif; ?> ><a href="/user-main">会员中心</a></li>
        <li <?php if(request()->path() == 'user-article-edit'): ?> class="web-main-nav-current" <?php endif; ?> ><a href="/user-article-edit">添加文章</a></li>
        <li <?php if(request()->path() == 'user-article'): ?> class="web-main-nav-current" <?php endif; ?>><a href="/user-article">文章管理</a></li>
        
        
        <li <?php if(request()->path() == 'user-datum'): ?> class="web-main-nav-current" <?php endif; ?>><a href="/user-datum">个人资料</a></li>
        <li <?php if(request()->path() == 'user-pwd'): ?> class="web-main-nav-current" <?php endif; ?>><a href="/user-pwd">修改密码</a></li>
      </ul>
  </div>
</div>