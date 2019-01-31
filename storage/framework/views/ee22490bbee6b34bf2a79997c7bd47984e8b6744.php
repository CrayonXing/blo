<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>微信菜单编辑 - demo</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico"> 

    <link href="<?php echo e(asset('hAdmin/css/bootstrap.min.css?v=3.3.6')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('hAdmin/css/font-awesome.min.css?v=4.4.0')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('hAdmin/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('hAdmin/css/style.css?v=4.1.0')); ?>" rel="stylesheet">
    <style>
    #cus-breadcrumb {
        width: 100%;
        padding: 10px;
        margin: 0;
    }

        .weixin-menu-setting{
            margin:0;
            margin-bottom:10px;
            width:100%;
        }
        .mobile-head-title{
            color: #fff;
            text-align: center;
            padding-top: 33px;
            font-size: 15px;
            width: auto;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            word-wrap: normal;
            margin: 0 40px 0 70px;
        }
        .weixin-body {
            padding:0;
            margin:0;
            margin-left:337px;
        }
        .weixin-content,.no-weixin-content{
            background-color: #f4f5f9;
            border: 1px solid #e7e7eb;
            padding:15px;
        }
        .no-weixin-content{
            border:#fff;
            background-color: #fff;
            vertical-align: middle;
            padding-top:200px;
            text-align: center;
        }

        .weixin-menu-title{
            border-bottom: 1px solid #e7e7eb;
            font-size: 16px;
            padding: 0 20px;
            line-height: 55px;
            margin-bottom: 20px;
        }
        .mobile-menu-preview{
            display:block;
            float:left;
            position:relative;
            width: 317px;
            height: 550px;
            background: transparent url(/hAdmin/img/wx_mobile_header_bg.png) no-repeat 0 0;
            background-position: 0 0;
            border: 1px solid #e7e7eb;
        }

        .mobile-menu-preview .menu-list {
            position: absolute;
            height:50px;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #e7e7eb;
            background: transparent url(/hAdmin/img/wx_mobile_footer_bg.png) no-repeat 0 0;
            background-position: 0 0;
            background-repeat: no-repeat;
            padding-left: 43px;
            margin:0;
        }
        .menu-list .menu-item,.menu-list .add-item{
            line-height: 50px;
            position: relative;
            float: left;
            text-align: center;
            width: 33.33%;
            list-style: none;
        }
        .ui-sortable-placeholder{
            background-color:#fff;
        }
        .menu-item a,.add-item a{
            display: block;
            width: auto;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            word-wrap: normal;
            color: #616161;
            text-decoration: none;
        }
        .menu-item.select-item a.menu-link{
            border: 1px solid #44b549;
            line-height: 48px;
            background-color: #fff;
            color: #44b549;
        }
        .menu-item .icon-menu-dot{
            background: url(/hAdmin/img/wx_mobile_index.png) 0 0 no-repeat;
            width: 7px;
            height: 7px;
            vertical-align: middle;
            display: inline-block;
            margin-right: 2px;
            margin-top: -2px;
            bottom: 60px;
            background-color: #fafafa;
            border-top-width: 0;
        }
        .menu-item .menu-link,.add-item .menu-link{
            border-left-width: 0;
            border-left: 1px solid #e7e7eb;
            text-align: center;
        }

        .sub-menu-item a,.add-sub-item a{
            border: 1px solid #d0d0d0;
            position:relative;
            padding:0 0.5em;
        }
        .sub-menu-item.select-item a{
            border: 1px solid #44b549;
            background-color: #fff;
            color: #44b549;
            z-index: 1;
            height: 46px;
        }
        .sub-menu-list li a:hover{
            background:#f1f1f1;
        }
        .menu-item.select-item .menu-link{
            border: 1px solid #44b549;
            line-height: 48px;
            background-color: #fff;
            color: #44b549;
        }
        .sub-menu-box{
            position: absolute;
            bottom: 60px;
            left: 0;
            width: 100%;
            background-color: #fff;
            border-top: none;
        }
        .sub-menu-list{
            line-height: 50px;
            margin:0;padding:0;
        }
        .sub-menu-list li{
            line-height: 44px;
            margin: -1px -1px 0;
            list-style: none;
        }
        .sub-menu-box .arrow {
            position: absolute;
            left: 50%;
            margin-left: -6px;
        }

        .sub-menu-box .arrow-in {
            bottom: -5px;
            display: inline-block;
            width: 0;
            height: 0;
            border-width: 6px;
            border-style: dashed;
            border-color: transparent;
            border-bottom-width: 0;
            border-top-color: #fafafa;
            border-top-style: solid;
        }
        .sub-menu-box .arrow-out {
            bottom: -6px;
            display: inline-block;
            width: 0;
            height: 0;
            border-width: 6px;
            border-style: dashed;
            border-color: transparent;
            border-bottom-width: 0;
            border-top-color: #d0d0d0;
            border-top-style: solid;
        }
        .sub-menu-inner-add{
            display: block;
            border-top: 1px solid #e7e7eb;
            width: auto;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            word-wrap: normal;
            cursor: pointer;
        }
        .weixin-icon{
            background: url(/hAdmin/img/weixin_icon.png) 0 -4418px no-repeat;
            width: 16px;
            height: 16px;
            vertical-align: middle;
            display: inline-block;
            line-height: 100px;
            overflow: hidden;
        }
        .weixin-icon.add-gray {
            background-position: 0 0;
        }
        .weixin-icon.sort-gray {
            background: url(/hAdmin/img/weixin_icon.png) 0 -32px no-repeat;
            background-position: 0 -32px;
            margin-top: -1px;
            display:none;
            width: 20px;
        }
        .weixin-icon.big-add-gray{
            background-position: -36px 0;
            width: 36px;
            height: 36px;
            vertical-align: middle;
        }
        .menu-item a.menu-link:hover{

        }

        .add-item.extra,.add-item.extra{
            float: none;
            width: auto;
            overflow: hidden;
        }

        table.btn-bar{width:100%;}
        table.btn-bar td{ text-align: center; }

        .item-info .item-head{
            position:relative;
            padding: 0;
            border-bottom: 1px solid #e7e7eb;
        }
        .item-info .item-delete{
            position:absolute;
            top:0;
            right:0;
        }

        table.weixin-form td{
            vertical-align:middle;
            height:24px;
            line-height: 24px;
            padding: 8px 0;
        }
        .form-item dl{
            position:relative;
            margin:10px 0;
        }
        .form-item dl dt{
            width:90px;
            height: 30px;
            line-height: 30px;
            text-align: right;
            position:absolute;
            vertical-align: middle;
            top:0;
            left:0;
            bottom:0;
            display:block;
        }
        .form-item dl dd{
            position:relative;
            display:block;
            margin-left: 90px;
            line-height: 30px;
        }
        .form-item .input-box {
            display: inline-block;
            position: relative;
            height: 30px;
            line-height: 30px;
            vertical-align: middle;
            width: 278px;
            font-size: 14px;
            padding: 0 10px;
            border: 1px solid #e7e7eb;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
            border-radius: 0;
            -moz-border-radius: 0;
            -webkit-border-radius: 0;
            background-color: #fff;
        }
        .form-item .input-box input{
            width: 100%;
            background-color: transparent;
            border: 0;
            outline: 0;
            height:30px;
        }

        .clickbox{
            text-align: center;
            margin:40px 0;
        }
        .create-click{
            display: inline-block;
            padding-top: 30px;
            position: relative;
            width:240px;
            height: 120px;
            border: 2px dotted #d9dadc;
            text-align: center;
            margin-bottom: 20px;
            margin-left: 50px;
        }
        .create-click a{
            display:block;
        }
        .create-click a strong{
            display:block;
        }
        dl.is-item dd>label {margin-left:5px;}

        input,.form-control, .single-line{
            border-radius: 0 !important;
        }

        .checkbox-inline, .radio-inline {
             padding-left: 0px !important;
        }
        .my-box{
            width: 600px;min-height: 100px;background: #f4f4f4;padding: 20px;border-radius: 5px;display: none;
        }
        #fr-menu-resources:active i{
            font-size: 28px !important;
        }
    </style>
</head>

<body class="gray-bg">
    <div class="row white-bg" id="cus-breadcrumb">
        <div class="col-sm-4">
            <ul class="breadcrumb">
                <li><a><i class="fa fa-home"></i> 主页</a></li>
                <li>我的管理</li>
                <li>日记案例管理</li>
            </ul>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInLeftBig">
        <div class="row">
            <div class="col-sm-12">
                <div class="mobile-menu-preview">
                    <div class="mobile-head-title">微琳医美</div>
                    <ul class="menu-list" id="menu-list">
                        <li class="add-item extra" id="add-item">
                            <a href="javascript:;" class="menu-link" title="添加菜单">
                                <i class="weixin-icon add-gray"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div style="margin-left: 337px;margin-right: 2px;padding: 0;margin: 0;margin-left: 337px; ">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox" style="border-radius: 0;">
                                <div class="ibox-content">
                                    <div class="file-manager">
                                        <h5 style="color: #f18a71;font-size: 14px;">温馨提示：</h5>
                                        <div class="hr-line-dashed"></div>
                                        <a href="javascript:void(0)" style="color: #b7b1b1;">
                                            1、自定义菜单最多包括3个一级菜单，每个一级菜单最多包含5个二级菜单。<br/>
                                            2、一级菜单最多4个汉字，二级菜单最多7个汉字，多出来的部分将会以“...”代替。<br/>
                                            3、创建自定义菜单后，菜单的刷新策略是，在用户进入公众号会话页或公众号profile页时，如果发现上一次拉取菜单的请求在5分钟以前，就会拉取一下菜单，如果菜单有更新，就会刷新客户端的菜单。测试时可以尝试取消关注公众账号后再次关注，则可以看到创建后的效果。
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox" style="border-radius: 0;">
                                <div class="ibox-content" style="padding: 15px;min-height: 400px;">
                                    <h3 style="font-weight: 500;border-bottom: 1px solid #e7eaec;padding-bottom: 20px;">微信菜单编辑区域</h3>
                                    <form class="form-horizontal" onsubmit="return false;">
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label" >标题</label>
                                            <div class="col-sm-11">
                                                <input type="text" class="form-control" style="width: 200px;" id="fr-menu-name">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="cus-menu-box form-group hidden">
                                            <label class="col-sm-1 control-label">事件</label>
                                            <div class="col-sm-11">
                                                <label class="checkbox-inline"><input type="radio" value="click" name="type"> 发送消息</label>
                                                <label class="checkbox-inline"><input type="radio" value="view" name="type"> 跳转网页</label>
                                                <label class="checkbox-inline"><input type="radio" value="miniprogram" name="type"> 跳转小程序</label>
                                                <label class="checkbox-inline"><input type="radio" value="scancode_push" name="type"> 扫码推</label>
                                                <label class="checkbox-inline"><input type="radio" value="scancode_waitmsg" name="type"> 扫码推提示框</label>
                                                <label class="checkbox-inline"><input type="radio" value="pic_sysphoto" name="type"> 拍照发图</label>
                                                <label class="checkbox-inline"><input type="radio" value="pic_photo_or_album" name="type"> 拍照相册发图</label>
                                                <label class="checkbox-inline"><input type="radio" value="pic_weixin" name="type"> 相册发图</label>
                                                <label class="checkbox-inline"><input type="radio" value="location_select" name="type"> 地理位置选择</label>
                                            </div>
                                        </div>
                                        <div class="cus-menu-box hr-line-dashed hidden"></div>

                                        <div class="cus-menu-box form-group hidden">
                                            <div class="col-sm-offset-1 col-sm-11">
                                                <div class="my-box-type1 my-box">
                                                    <h5 style="color: #d2cbcb">点击该子菜单会跳到以下小程序</h5>
                                                    <div class="ibox-content" style="padding-bottom: 0px;">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                    <div class="form-group">
                                                                        <label>小程序ID:</label>
                                                                        <input type="text" placeholder="在小程序后台获取" class="form-control" id="fr-menu-appid">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>小程序页面路径:</label>
                                                                        <input type="text" placeholder="小程序页面路径" class="form-control" id="fr-menu-pagepath">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>页面地址:</label>
                                                                        <input type="text" placeholder="页面地址，当不支持小程序时会跳转此页面" class="form-control" id="fr-menu-url2">
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="my-box-type2 my-box">
                                                    <h5 style="color: #d2cbcb">点击该菜单会跳到以下链接</h5>
                                                    <div class="ibox-content" style="padding-bottom: 0px;">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                    <div class="form-group">
                                                                        <label>页面地址:</label>
                                                                        <input type="text"  class="form-control" id="fr-menu-url">
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="my-box-type3 my-box">
                                                    <h5 style="color: #d2cbcb">点击编辑资源信息</h5>
                                                    <div style="width: 292px;height: 137px;background:white;margin: 0 auto;border: 1px dashed #f1e1e1;">
                                                        <p style="margin: 0;height: 30px;line-height: 30px;background: #ebe7e7;text-align: center">资源名: <span id="resources-name">- -</span></p>
                                                        <div style="width: 100%;cursor: pointer" id="fr-menu-resources">
                                                            <p><i class="glyphicon glyphicon-plus" style="font-size: 26px;color: #91cdeb;margin-left: 136px;margin-top: 20px;"></i></p>
                                                            <p style="text-align: center;color: #91cdeb">选择现有资源</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-1 col-sm-11" style="padding-left: 3px;">
                                                <button class="btn btn-info" id="fr-submit">保存并发布</span></button>
                                                <button class="btn btn-danger" id="fr-remove"> 移除菜单</button>
                                                <button class="btn btn-danger" onclick="menuObj.getSelectionData()"> 获取选中</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 全局js -->
    <script src="<?php echo e(asset('hAdmin/js/jquery.min.js?v=2.1.4')); ?>"></script>
    <script src="<?php echo e(asset('hAdmin/js/wechat-menu.js?v=2.1.4')); ?>"></script>
    <script type="text/javascript">
        var menuJson = '{"button":[{"name":"一级菜单","sub_button":[{"type":"click","name":"活动一","key":"key|","sub_button":[]},{"type":"click","name":"活动二","key":"key|","sub_button":[]},{"type":"view","name":"活动三","url":"http://172.16.100.85/weixin","sub_button":[]}]},{"name":"官网","sub_button":[{"type":"view","name":"微信端","url":"http://172.16.100.85/weixin","sub_button":[]},{"type":"click","name":"PC端","key":"key|","sub_button":[]}]},{"name":"网站","sub_button":[{"type":"view","name":"百度网站","url":"https://news.baidu.com/","sub_button":[]},{"type":"view","name":"新浪新闻","url":"https://news.sina.com.cn/","sub_button":[]},{"type":"view","name":"腾讯新闻","url":"https://news.qq.com/","sub_button":[]},{"type":"miniprogram","name":"跳转小程序","url":"http://47.105.180.123/admin","appid":"AKASDAS1A1S5FA1531DA","pagepath":"http://47.105.180.123","sub_button":[]},{"type":"view","name":"添加子菜单","url":"发送到","sub_button":[]}]}]}';
        let menuObj =  new Menu(menuJson);
    </script>
</body>
</html>
