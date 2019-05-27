@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/admin.css">
@endpush

@section('left-sidebar')
    <div class="side" id="my-left-box">
        <div class="brand">微信管理</div>
        <div class="menu">
            <ul>
                <a href="/admin/wechat/wx-conf-page">
                    <li class="active">
                        <span class="icon"></span>
                        <div class="text">微信配置设置</div>
                    </li>
                </a>

                <a href="/admin/wechat/menu-page">
                    <li >
                        <span class="icon"></span>
                        <div class="text">公众号菜单设置</div>
                    </li>
                </a>
            </ul>
        </div>
        <div class="toggle" id="my-close-left">
            <div class="shape"></div>
        </div>
    </div>
@endsection

@section('content')
    <div style="padding: 10px;">
        <div class="layui-row larryms-panel" style="border-radius: 0;">
            <div class="larryms-panel-heading layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12" style="background-color: #e2e3e3">
                <span class="panel-tit">微信配置 @if(count($config) == 0) <span style="font-size: 12px; color: #ff5353;">(温馨提示:当前后台没有配置微信相关信息)</span>  @endif  </span>
            </div>
            <form onsubmit="return false;" id="wechat-conf-form">
                <div class="larryms-panel-body layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12">
                    <div class="larryms-tools">
                        <div class="layui-btn-group larryms-btn-group" style="background: none;">
                            <button class="layui-btn layui-btn-sm radius-none" id="admin-table-reload" style="background-color: #77d9ed" type="reset"><i class="icon larry-icon larry-kuangjia_daohang_shuaxin"></i> 重置设置</button>
                            <button class="layui-btn layui-btn-sm save-conf-btn radius-none" style="margin-left: 5px !important;background-color: #ffa1a1"><i class="icon larry-icon larry-dingdanguanli"></i> 保存所有设置</button>
                        </div>
                    </div>
                    <div class="layui-tab" lay-filter="larrymsConf" id="larrymsConfTab" style="">
                        <div class="system-title-box clearfix">
                            <ul class="layui-tab-title" style="border-bottom-width: 1px;">
                                <li class="layui-this" id="systemLi" style="height: 41px;">公众号设置</li>
                                <li class="">小程序设置</li>
                                <li class="">支付商户设置</li>
                            </ul>
                        </div>
                        <div class="layui-tab-content" style="padding-top: 2px;padding-left: 0px; ">
                            <div class="layui-tab-item layui-show">
                                <table class="layui-table ">
                                    <thead><tr><th>参数说明(可登录微信公众平台查看)</th><th>参数值</th></tr></thead>
                                    <tbody>
                                    <tr><td>公众号 AppID</td><td><input type="text"  name="wxPublicAppID"  value="{{@$config['wxPublicAppID']}}"  class="form-control radius-none" placeholder="请设置公众号appID"></td></tr>
                                    <tr><td>公众号 AppSecret</td><td><input type="text" name="wxPublicAppSecret"  value="{{@$config['wxPublicAppSecret']}}" class="form-control radius-none"  placeholder="请设置公众号appsecret"></td></tr>
                                    <tr><td>公众号消息通知 Token</td><td><input type="text" name="wxPublicToken"  value="{{@$config['wxPublicToken']}}" class="form-control radius-none"  placeholder="公众号消息通知令牌"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="layui-tab-item">
                                <table class="layui-table ">
                                    <thead><tr><th>参数说明(可登录微信小程序平台查看)</th><th>参数值</th></tr></thead>
                                    <tbody>
                                    <tr><td>小程序 AppID</td><td><input type="text"  name="wxMinProgramAppID"  value="{{@$config['wxMinProgramAppID']}}"  class="form-control radius-none" placeholder="请设置小程序appID"></td></tr>
                                    <tr><td>小程序 AppSecret</td><td><input type="text" name="wxMinProgramAppSecret" value="{{@$config['wxMinProgramAppSecret']}}"  class="form-control radius-none"  placeholder="请设置小程序appsecret"></td></tr>
                                    <tr><td>小程序消息通知 Token</td><td><input type="text" name="wxMinProgramToken"  value="{{@$config['wxMinProgramToken']}}" class="form-control radius-none"  placeholder="小程序消息通知令牌"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="layui-tab-item">
                                <table class="layui-table ">
                                    <thead><tr><th>参数说明(可登录微信商户平台查看)</th><th>参数值</th></tr></thead>
                                    <tbody>
                                    <tr><td>商户号 mch_id</td><td><input type="text" name="wxMchID" value="{{@$config['wxMchID']}}"  class="form-control radius-none" placeholder="请设置商户号ID"></td></tr>
                                    <tr><td>商户支付密钥</td><td><input type="text" name="wxMchKey" value="{{@$config['wxMchKey']}}"  class="form-control radius-none"  placeholder="请设置商户支付密钥"></td></tr>
                                    <tr><td colspan="2" ></td></tr>
                                    <tr><td colspan="2" style="color: #e9b180">如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)</td></tr>
                                    <tr><td>cert_path</td><td><input type="text" name="wxMchCertPath" value="{{@$config['wxMchCertPath']}}"  class="form-control radius-none"  placeholder="(注:绝对路径)   /path/to/your/cert.pem "></td></tr>
                                    <tr><td>key_path</td><td><input type="text" name="wxMchKeyPath" value="{{@$config['wxMchKeyPath']}}"  class="form-control radius-none"  placeholder="(注:绝对路径)    /path/to/your/key"></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="/plugin/larryms/layui/layui.js"></script>
    <script type="text/javascript">
        let lock = false;
        layui.config({
            base: '/plugin/larryms/',
        }).extend({
            larry: 'js/base'
        }).use(['larry','larryms'],function(){
            let larryms = layui.larryms;
            $('.save-conf-btn').on('click',function(){
                if(lock){return};
                let data = {},_this=$(this);
                $.each($('#wechat-conf-form').serializeArray(),function(idx,obj){
                    let tmp = {};tmp[obj.name] = obj.value;
                    data = $.extend(data, tmp);
                });

                $(this).html('<i class="fa fa-spinner fa-spin"></i> 修改中...');
                lock = true;
                $.ajax({
                    url: "{{route('wx_conf_api')}}",
                    type: 'post',
                    dataType: 'json',
                    data:data,
                    success: function (res) {
                        lock = false;
                        if(res.code == 200){
                            larryms.notice({msg:"配置修改成功...",msgtype:'success',bgcolor:'#77d9ed'});
                        }else{
                            larryms.notice({msg:"配置修改失败...",msgtype:'danger'});
                        }
                        _this.html('<i class="icon larry-icon larry-dingdanguanli"></i> 保存所有设置');
                    },
                    error:function(){
                        _this.html('<i class="icon larry-icon larry-dingdanguanli"></i> 保存所有设置');
                        lock = false;
                        larryms.notice({msg:"网络错误，请稍后再试...",msgtype:'danger'});
                    }
                });
            });
        });
    </script>
@endpush