<div class="web-main-left">
  <div class="web-main-header">
      <img src="https://thirdqq.qlogo.cn/qqapp/101404082/ADAC2A0D202D78CEFD0FD2D8EF8CB659/100" >
      <p class="web-main-header-name" >嘿！boy (ID：2068161)</p>
      <p class="web-main-header-integral" >积分(150) <span>签到</span></p>
  </div>

  <div class="web-main-nav">
      <ul>
        <li <?php if(request()->path() == 'user-main'): ?> class="web-main-nav-current" <?php endif; ?> ><a href="/user-main">个人中心</a></li>
        <li <?php if(request()->path() == 'user-article'): ?> class="web-main-nav-current" <?php endif; ?>><a href="/user-article">我的文章</a></li>
        <li <?php if(request()->path() == 'user-favorite'): ?> class="web-main-nav-current" <?php endif; ?>>文章收藏</li>
        <li <?php if(request()->path() == 'user-integral'): ?> class="web-main-nav-current" <?php endif; ?>>积分管理</li>
        <li <?php if(request()->path() == 'user-info'): ?> class="web-main-nav-current" <?php endif; ?>>个人资料</li>
        <li <?php if(request()->path() == 'user-pwd'): ?> class="web-main-nav-current" <?php endif; ?>><a href="/user-pwd">修改密码</a></li>
      </ul>
  </div>
</div>