<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="data-spm" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>New博客后台</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.css">

    {{--自定义阿里字体库--}}
    <link type="text/css" rel="stylesheet" href="//at.alicdn.com/t/font_1038155_bvfj232ori.css">

    {{--框架css--}}
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/larry/css/larry.css" media="all">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/larryms.css">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/larry/font/fa/font-awesome.min.css" media="all">
    @stack('css')
    <link type="text/css" rel="stylesheet" href="/static/admin/css/style-main.css">
</head>

<body>
    @yield('content')
</body>

<script type="text/javascript" src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('scripts')

</html>