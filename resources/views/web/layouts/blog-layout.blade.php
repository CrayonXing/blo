<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<title>New博客</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="keywords" content="New博客" />
<meta name="description" content="New博客" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="applicable-device" content="pc">
<link href="http://cdn.amazeui.org/amazeui/2.7.2/css/amazeui.min.css" rel="stylesheet">
<link href="{{asset('web/css/base.css')}}" rel="stylesheet">
<link href="{{asset('web/css/index.css')}}" rel="stylesheet">
<link href="//at.alicdn.com/t/font_1038155_tajfhfyfkuq.css" rel="stylesheet">
<link href="{{asset('plugin/animate.min.css')}}" rel="stylesheet">
<link href="{{asset('web/css/login.css')}}" rel="stylesheet">
<style type="text/css">
	
</style>
</head>
<body>
	@section('header')
        <header id="blog-header" class="blog-header-fixed" >
		  <div class="tophead">
		    <div class="logo"><a href="/">New博客</a></div>
		    <nav class="topnav" id="topnav" style="width: 850px;float: left;">
		      <ul >
		        <li><a href="/"  @if(request()->path() == '/') id="topnav_current" @endif >首页</a></li>
		        <li><a href="/article/category/php" @if(request()->fullUrl() == url('/article/category/php')) id="topnav_current" @endif>PHP</a></li>
		        <li><a href="/article/category/swoole"  @if(request()->fullUrl() == url('/article/category/swoole')) id="topnav_current" @endif>Swoole</a></li>
		        <li><a href="/article/category/redis"  @if(request()->fullUrl() == url('/article/category/redis')) id="topnav_current" @endif>Redis</a></li>
		        <li><a href="/article/category/vue"  @if(request()->fullUrl() == url('/article/category/vue')) id="topnav_current" @endif>Vue</a></li>
		        <li><a href="/article/category/web"  @if(request()->fullUrl() == url('/article/category/web')) id="topnav_current" @endif>Web</a></li>
		        <li><a href="/article/category/问答"  @if(request()->fullUrl() == url('/article/category/问答')) id="topnav_current" @endif>问答</a></li>
		        <li><a href="/article/category/IT趣事"  @if(request()->fullUrl() == url('/article/category/IT趣事')) id="topnav_current" @endif>IT趣事</a></li>
		      </ul>
		    </nav>
		    <div class="blog-header-login-nav">
		    	<ul >
		    	@if(!auth('web')->check())
					<li style="background: #FC9D9A;border-radius: 20px;color: #fff;" onclick="userLogin.showBox('login')">登录</li>
			        <li style="color: #FC9D9A" onclick="userLogin.showBox('register')">注册</li>
			    @else
					<li style="background: #FC9D9A;border-radius: 20px;color: #fff;" ><a href="/user-main" style="color: #fff;" >个人中心</a></li>
					<li  > <a href="/user-logout" style="color: #FC9D9A;">&nbsp;&nbsp;退出登录</a></li>
		    	@endif
		        </ul>
		    </div>
		  </div>
		</header>
		<div style="width: 100%;height: 80px;clear: both;"></div>
    @show

    @yield('content')

    @section('footer')
	    <footer>
		  <p>© 2018 - 2019 New博客</p>
		</footer>
	@show

	<div id="web-login-container">
			<div id="login-box" class="animated rotateIn">
				<div class="login-box-header">
					<p class="login-box-header-logo"></p>
					<p class="login-box-header-logo-name">New博客</p>
				</div>

				<div class="login-box-body">
					<ul class="login-box-body-tab" >
						<li >账号登录</li>
						<li>短信注册</li>
					</ul>

					<div class="login-box-body-from">
						<div class="login-box-error" ></div>

						<form onsubmit="return false;" >
						  <fieldset style="display: none" >
							    <div style="border-bottom: 1px solid #f1e4e4;">
							      	<input type="text" class="login-box-body-from-input"  id="loginbox-login-mobile"   placeholder="手机号/用户名" >
							    </div>

							    <div style="border-bottom: 1px solid #f1e4e4;margin-top: 30px;">
							      	<input type="password"  placeholder="请输入登录密码" class="login-box-body-from-input" id="loginbox-login-pwd">
							    </div>

							    <div style="margin-top: 30px;">
							      	<p  class="login-box-btn login-box-btn-login">登 录</p>
							    </div>
						  </fieldset>
						  <fieldset style="display: none">
							    <div style="border-bottom: 1px solid #f1e4e4;">
							      	<input type="text" class="login-box-body-from-input"  placeholder="登录时使用的手机号" id="loginbox-reg-mobile">
							    </div>

							    <!-- <div style="border-bottom: 1px solid #f1e4e4;margin-top: 30px;position: relative;">
							      	<input type="text"  placeholder="图片验证码" class="login-box-body-from-input" maxlength="6" id="loginbox-reg-tucode">
							      	<p class="login-box-body-pos-tucode">
							      		<img src="http://118.24.1.228/captcha/default?JP7BM35C" width="100">
							      	</p>
							    </div> -->

							    <div style="border-bottom: 1px solid #f1e4e4;margin-top: 30px;position: relative;">
							      	<input type="text"  placeholder="短信验证码" class="login-box-body-from-input" maxlength="6" id="loginbox-reg-smscode">
							      	<p class="login-box-body-pos-smscode" >发送短信</p>
							    </div>

							    <div style="border-bottom: 1px solid #f1e4e4;margin-top: 30px;position: relative;">
							      	<input type="password"  id="login-box-body-from-set-pwd"  placeholder="设置登录密码" class="login-box-body-from-input" maxlength="16" id="loginbox-reg-pwd">
							      	<p class="login-box-body-pos-eye">
							      		<i class="iconfont icon-yanjing_bi" id="login-box-body-from-eye"></i>
							      	</p>
							    </div>

							    <div style="margin-top: 30px;">
							      	<p  class="login-box-btn login-box-btn-register">立即注册</p>
							    </div>
						  </fieldset>
						</form>
					</div>
				</div>

				<div class="login-box-close" style="position: absolute;top:0;right: -30px;">
					<i class="iconfont icon-guanbi" style="color: #fff;font-size: 25px;cursor: pointer;" onclick="userLogin.hideBox()"></i>
				</div>
			</div>
	</div>

	<div id="web-toolbar">
		<ul class="web-toolbar-item" >
			<li class="web-toolbar-item-list" id="web-to-top"  style="padding-top: 2px;display: none">
				<i class="iconfont icon-zhiding" ></i>
			</li>
		</ul>
	</div>

	<script src="{{asset('web/js/jquery-2.1.1.min.js')}}"></script>
	<script src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"></script>
	<script src="{{asset('plugin/functions.js')}}"></script>
	

	<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

		$(window).scroll(function(){//bug
	        var _top= $(window).scrollTop();
	        if(_top > 200){
	            $("#web-to-top").show();
            }else{
                $("#web-to-top").hide();
            }
	    });

	    $("#web-to-top").click(function(){
			$('html,body').animate({scrollTop: '0px'},300);
	    });
	</script>
	<script src="{{asset('web/js/login-box.js')}}"></script>

	@stack('scripts')
</body>
</html>
