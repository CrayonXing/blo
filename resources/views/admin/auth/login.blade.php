<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台登录</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="/static/hAdmin/login/style.css" tppabs="css/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}

        .submit_btn:active{
            background: #0d957a !important;
        }
        .logo{
            /*color: #FC9D9A !important;*/
            font-family: "Times New Roman",Georgia,Serif;
            font-size: 30px;
        }
    </style>
</head>
<body>
<dl class="admin_login">
    <dt>
        <strong ><b class="logo">New博客</b>(管理系统)</strong>
        <em>Management System</em>
    </dt>
    <dd class="user_icon">
        <input type="text" placeholder="管理员账号" class="login_txtbx"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" class="login_txtbx"/>
    </dd>
    <dd class="val_icon">
        <div class="checkcode">
            <input type="text" id="J_codetext" placeholder="验证码" maxlength="8" class="login_txtbx" style="width: 207px;">
        </div>
        <div style="height: 100%;width: 50px;position: absolute;right: 0;background-color: #57cec2;width: 87px;line-height: 40px;text-align: center;cursor: pointer;color: white">验证码</div>
    </dd>
    <dd>
        <input type="button" value="立即登陆" class="submit_btn"/>
    </dd>
    <dd>
        <p>© 2019-2020 New博客 版权所有</p>
    </dd>
</dl>

<script src="/static/hAdmin/login/jquery.js"></script>
<script src="/static/hAdmin/login/Particleground.js" tppabs="/static/admin/login/Particleground.js"></script>
<script>
    $('body').particleground({dotColor: '#5cbdaa',lineColor: '#5cbdaa'});
</script>
</body>
</html>
