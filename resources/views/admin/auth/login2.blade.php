<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New博客(管理系统)</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="/static/hAdmin/login/login2.css" tppabs="css/style.css"/>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1038155_qwh7wmvveo.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .larry-btn-submit:active {
            background: rgba(31, 204, 188, 0.8) !important;
        }
        .error{
            width: 400px;height: 40px;position: fixed;top: 0;left: 0;right: 0;margin: 0 auto;
            box-shadow: -2px 6px 25px 15px rgba(231, 202, 202, 0.7);
            background: -webkit-gradient(linear, left bottom, right top, color-stop(0%, #35394a), color-stop(100%, rgb(123, 135, 148)));
            background: -webkit-linear-gradient(230deg, rgba(53, 57, 74, 0) 0%, rgb(123, 135, 148) 100%);
            background: linear-gradient(230deg, rgba(53, 57, 74, 0) 0%, rgb(123, 135, 148) 100%);
            text-align: center;
            line-height: 40px;
            color: white;
            display: none;
        }
    </style>
</head>

<body class="login-body">
<canvas class="pg-canvas" width="2048" height="590"></canvas>
<div class="login pt-page-scaleUp">
    <div class="login-title">
        <strong><b class="logo">New博客</b>(管理系统)</strong>
        <em style="font-size: 12px;">Management System</em>
    </div>

    <form class="layui-form larryms-form" onsubmit="return false;" autocomplete="off">
        <dvi class="layui-form-item">
            <label class="larryms-label"><i class="iconfont icon-ai-user" style="color: white"></i></label>
            <input type="text" id="fr-login-username" autocomplete="off" placeholder="请输入您的用户名" class="layui-input larry-input" >
            <span class="validation"><i class="larry-icon larry-gou4"></i></span>
        </dvi>

        <dvi class="layui-form-item">
            <label class="larryms-label"><i class="iconfont icon-suo" style="color: white"></i></label>
            <input type="password" id="fr-login-password" autocomplete="off" placeholder="请输入您的密码" class="layui-input larry-input" >
            <span class="validation"><i class="larry-icon larry-gou4"></i></span>
        </dvi>

        <dvi class="layui-form-item larryms-code">
            <label class="larryms-label"><i class="iconfont icon-yanzhengma" style="color: white"></i></label>
            <input type="text" id="fr-login-code" autocomplete="off" placeholder="输入验证码" class="layui-input larry-input">
            <span class="validation"><i class="larry-icon larry-gou4"></i></span>
            <div class="code">
                <div class="code-img"><img src="{{captcha_src()}}" alt="" style="border-radius: 3px;"></div>
            </div>
        </dvi>

        <div class="layui-form-item">
            <button class="layui-btn larry-btn-submit" style="border: none;outline: none;cursor: pointer" onclick="obj.submit()">立即登录</button>
        </div>

        <div class="layui-form-item layui-trans larryms-user-login-other">
            <a href="" class="reg-a forget">忘记密码</a>
        </div>

        <div class="layui-form-item">
            <label style="font-size: 10px;margin-left: 25px;color: #020202;">Copyright © 2019 New博客. All Rights
                Reserved.</label>
        </div>
    </form>
</div>

<div class="error"  >
<i class="iconfont icon-tubiao-"></i>
    <span style="color: #c8c8c8">asdfanskdnf </span>
</div>

<script src="/static/hAdmin/login/jquery.js"></script>
<script src="/static/hAdmin/login/Particleground.js"></script>
<script>
    $('body').particleground({dotColor: '#5cbdaa', lineColor: '#5cbdaa'});

    $('.code-img img').on('click', function () {
        var _that = $(this);
        $.ajax({
            url: "{{route('admin_auth_code')}}",
            type: 'get',
            dataType: 'json',
            success: function (res) {
                _that.attr('src', res.img_url);
            }
        });
    });

    const obj = {
        showError(msg){
            $('.error').fadeIn("slow").delay(2000).fadeOut();
            $('.error').find('span').text(msg);
        },
        submit(){
            let data = {
                username:$.trim($('#fr-login-username').val()),
                password:$.trim($('#fr-login-password').val()),
                code    :$.trim($('#fr-login-code').val()),
                '_token':'{{csrf_token()}}'
            };

            if(data.username == ''){
                this.showError('登录名不能为空');return;
            }else if(data.password == ''){
                this.showError('密码不能为空');return;
            }else if(data.code == ''){
                this.showError('验证码不能为空');return;
            }

            $('.larry-btn-submit').text('登录中...');

            $.ajax({
                url: "{{route('admin_login')}}",
                type: 'post',
                dataType: 'json',
                data:data,
                success: function (res) {
                    if(res.code == 200){
                        $('.larry-btn-submit').text('登录成功');
                        obj.showError('登录成功');
                        window.location.href = "{{route('admin')}}";
                    }else if(res.code == 401){
                        $('.larry-btn-submit').text('立即登录');
                        obj.showError('验证码错误');
                    }else{
                        $('.larry-btn-submit').text('立即登录');
                        obj.showError('登录密码错误');
                    }
                },
                error:function(){
                    $('.larry-btn-submit').text('立即登录');
                    obj.showError('登录密码错误');
                }
            });
        }
    };

    document.onkeydown = function (event) {
        var e = event || window.event;
        if (e && e.keyCode == 13) { //回车键的键值为13
            obj.submit();
        }
    };
</script>
</body>
</html>