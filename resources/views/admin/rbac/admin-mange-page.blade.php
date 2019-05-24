@extends('admin.layouts.layout')

@push('css')

    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/larryms.css">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/admin.css">

    <style>
        .admin-title{
            color: #FC9D9A !important;
            font-family: "Times New Roman",Georgia,Serif;
            font-size: 20px;
        }

        .new-article tbody tr {
            border-bottom: 1px solid #e4eaec;
        }
    </style>
@endpush

@section('left-sidebar')
    <div class="side" id="my-left-box">
        <div class="brand">权限管理</div>
        <div class="menu">
            <ul>
                <ul>
                    <li class="active">
                        <a href="/admin/rbac/admin-page" >
                            <span class="icon"></span>
                            <div class="text">管理员管理</div>
                        </a>
                    </li>
                    <li  >
                        <a href="/admin/rbac/role-page" >
                            <span class="icon"></span>
                            <div class="text">角色管理</div>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/rbac/permissions-page">
                            <span class="icon"></span>
                            <div class="text">权限管理</div>
                        </a>
                    </li>
                </ul>
            </ul>
        </div>
        <div class="toggle" id="my-close-left">
            <div class="shape"></div>
        </div>
    </div>
@endsection

@section('content')
    <div style="padding: 10px;">
        <div class="layui-row larryms-panel" style="height: 100%;border-radius: 0;">
            <div class="larryms-panel-heading layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12" style="background-color: #e2e3e3">
                <span class="panel-tit">管理员列表</span>
            </div>
            <div class="larryms-panel-body layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12">
                <div class="larryms-tools">
                    <div class="layui-btn-group larryms-btn-group" style="background: none;">
                        <button class="layui-btn layui-btn-sm layui-btn-warm" id="admin-table-reload" style="background-color: #77d9ed"><i class="icon larry-icon larry-kuangjia_daohang_shuaxin"></i> 刷新</button>
                        <button class="layui-btn layui-btn-sm layui-btn-warm" style="margin-left: 5px !important;"><i class="icon larry-icon larry-jia1"></i> 添加管理员</button>
                    </div>
                </div>

                <table class="layui-table larryms-table-id"  id="table-list-admin" lay-filter="adminfilter"></table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="/plugin/larryms/layui/layui.js"></script>
    <script type="text/html" id="menuBar">
        <a href="" style="color: #77D9ED">编辑信息</a>
    </script>
    <script type="text/html" id="statusBar">
        <div data-status="@{{ d.status }}" data-adminid="@{{ d.id }}" data-lock="false"  class="changeStatus">
            @{{# if(d.status == 10){ }}
            <span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>
            @{{# } else { }}
            <span class="larryms-status-gray my-tips pointer" >禁止登录</span>
            @{{# }}}
        </div>
    </script>

    <script type="text/html" id="roleBar">
        <span style="color: #77D9ED">查看角色</span>
    </script>

    <script type="text/html" id="resetPasswordHtml">
        <div style="padding: 20px;line-height: 22px;background-color: #ffffff;color: #9d8c8c;font-weight: 300;border-bottom: 1px solid #d7d7d7;">
            <form class="form-horizontal" id="changePasswordBox">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">操作令牌</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="change-pwd-secretkey" placeholder="请输入修改令牌" style="border-radius: 0;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">新密码</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="change-pwd1" placeholder="请输入新的密码" style="border-radius: 0;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">重复密码</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="change-pwd2" placeholder="请输入重复输入密码" style="border-radius: 0;">
                    </div>
                </div>
            </form>
        </div>
    </script>

    <script type="text/javascript">
        layui.config({
            base: '/plugin/larryms/',
        }).extend({
            larry: 'js/base'
        }).use(['larry','table','larryms'],function(){
            var table = layui.table,larryms = layui.larryms;

            $(document).on('mouseover','.my-tips', function(){
                layer.tips('点击可切换账号状态', this,{tips: 2}); //在元素的事件回调体中，follow直接赋予this即可
            }).on('mouseout','.my-tips', function(){
                layer.close(layer.tips());
            });

            $(document).on('click','.changeStatus',function(){
                if($(this).data('lock')){
                    return;
                }

                $(this).html('<span><i class="fa fa-spinner fa-spin"></i></span>');

                let _this = $(this);
                let status = $(this).data('status');
                let html =  status == 10?'<span class="larryms-status-gray my-tips pointer" >禁止登录</span>':'<span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>';

                _this.data('lock',true);
                $.ajax({
                    url: "{{route('rbac_chage_admin_status')}}",
                    type: 'post',
                    dataType: 'json',
                    data:{id:_this.data('adminid'),status:status==10?0:10},
                    success: function (res) {
                        if(res.code == 200){
                            _this.data('status',status==0?10:0);
                            _this.html(html);
                        }else{
                            _this.data('status',status);
                            _this.html(status == 0?'<span class="larryms-status-gray my-tips pointer" >禁止登录</span>':'<span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>');
                        }

                        _this.data('lock',false);
                    },
                    error:function(){
                        _this.data('lock',false);
                        _this.data('status',status);
                        _this.html(status == 0?'<span class="larryms-status-gray my-tips pointer" >禁止登录</span>':'<span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>');
                    }
                });
            });

            let adminListTable = table.render({
                elem: '#table-list-admin'
                , id: 'table-list-admin-reload'
                , url: '/admin/rbac/get-admin-api',
                loading: true,
                parseData: function (res) {
                    return {code: res.code == 200 ? 0 : res.code, msg: res.msg, data: res.data.rows, count: res.data.total};
                },
                text: {none: '暂无数据...'},
                cols: [[
                    {field: 'name', title: '登录账号'},
                    {field: 'id', title: '登陆密码',width: 100,align: 'center',event:'resetPassword',templet:function(data){
                        return '<span class="larryms-status-blue" style="color: #77D9ED;cursor: pointer">重置密码</span>';
                    }},
                    {field: 'email', title: '邮箱'},
                    {field: 'status',title: '账号状态',toolbar: '#statusBar',width: 100,align: 'center'},
                    {field: 'id',title: '在线状态',width: 100,align: 'center',templet:function(data){
                            if(data.order_type == 1){
                                return '<span class="larryms-status-blue">登录状态</span>';
                            }else{
                                return '<span class="larryms-status-gray">离线状态</span>';
                            }
                    }},
                    {field: 'id',title: '角色权限',templet: '#roleBar',width: 100,align: 'center'},
                    {field: 'created_at', title: '添加时间',width: 150,align: 'center'},
                    {field: 'id', title: '操作',toolbar: '#menuBar',width:200,align:'center'}
                ]],
                limit:100000,
                limits: [20, 30, 50],
                page: false,
            });

            layui.table.on('tool(adminfilter)', function(obj){
                if(obj.event == 'resetPassword'){
                    let adminId = obj.data.id;
                    let index = layer.open({
                        type: 1,title: false,closeBtn: false,area: '400px;',shade: 0.6,id: 'LAY_layuipro',resize: false,btn: ['放弃修改', '立即修改']
                        ,btnAlign: 'c',moveType: 1,content: resetPasswordHtml.innerHTML
                        ,btn1: function(){
                            layer.close(index);
                        }
                        ,btn2: function(){
                            let pwd2 = $('#change-pwd2').val();
                            let data = {
                                id:adminId,
                                secretkey:$.trim($('#change-pwd-secretkey').val()),
                                password:$('#change-pwd1').val(),
                            };

                            if(data.secretkey == ''){
                                larryms.message('操作令牌不能为空');
                            }else if(data.password == ''){
                                larryms.message('新密码不能为空');
                            }else if(data.password != pwd2){
                                larryms.message('两次密码输入不一致');
                            }else{
                                $.ajax({
                                    url: "{{route('rbac_reset_admin_pwd')}}",
                                    type: 'post',
                                    dataType: 'json',
                                    data:data,
                                    success: function (res) {
                                        if(res.code == 200){
                                            layer.close(index);
                                            larryms.message('密码修改成功');
                                        } else if(res.code == 302){
                                            larryms.message('操作令牌验证错误');
                                        }else {
                                            larryms.message('密码修改失败');
                                        }
                                    }
                                });
                            }

                            return false;
                        }
                    });
                }
            });

            $('#admin-table-reload').on('click',function(){
                adminListTable.reload({
                    page: false,
                    where:{}
                });
            });
        });



    </script>
@endpush




