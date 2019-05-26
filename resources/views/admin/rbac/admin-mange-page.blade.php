@extends('admin.layouts.layout')

@push('css')
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
        .layui-layer-btn-c a{border-radius: 0 !important;}
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
                            <div class="text">规则管理</div>
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
                        <button class="layui-btn layui-btn-sm" id="admin-table-reload" style="background-color: #77d9ed"><i class="icon larry-icon larry-kuangjia_daohang_shuaxin"></i> 刷新</button>
                        <button class="layui-btn layui-btn-sm show-admin-box" style="margin-left: 5px !important;background-color: #ffa1a1" ><i class="icon larry-icon larry-jia1"></i> 添加管理员</button>
                    </div>
                </div>

                <table class="layui-table larryms-table-id"  id="table-list-admin" lay-filter="adminfilter"></table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="/plugin/larryms/layui/layui.js"></script>
    <script type="text/html" id="statusBar">
        <div data-status="@{{ d.status }}" data-adminid="@{{ d.id }}" data-lock="false"  class="changeStatus">
            @{{# if(d.status == 10){ }}
            <span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>
            @{{# } else { }}
            <span class="larryms-status-gray my-tips pointer" >禁止登录</span>
            @{{# }}}
        </div>
    </script>
    <script type="text/html" id="TplAdmineBox">
        <div style="width: 500px;height: 303px;overflow-y: auto;overflow-x: hidden;padding: 20px 20px 0 20px;">
            <form class="form-horizontal" id="create-admin-from">
                <div class="form-group">
                    <label class="col-sm-2 control-label">登录账号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control radius-none" id="fr-admin-username" placeholder="请设置登录账号">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">邮箱账号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control radius-none" id="fr-admin-email" placeholder="请设置邮箱账号">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">设置密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control radius-none" id="fr-admin-password" placeholder="请设置登录密码">
                        <span class="help-block m-b-none">密码格式必须为8~16位字母+数字+特殊字符</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">确认密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control radius-none" id="fr-admin-password2" placeholder="请再次输入登录密码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <p style="height: 30px;line-height: 30px;color: #ed6565;display: none" id="fr-admin-tip"><i class="fa fa-exclamation-circle" style="font-size: 16px;"></i>&nbsp;<span>1351531351</span></p>
                    </div>
                </div>
            </form>
        </div>
        <div style="text-align: center;border-top: 1px dashed #ccc;padding-top: 10px;">
            <button type="button" class="btn btn-w-m btn-white radius-none close-admin-box" style="background-color: #ece8e8;color: #cebebe;">取消编辑</button>
            <button type="button" class="btn btn-w-m btn-info radius-none submit-admin-box">立即添加</button>
        </div>
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
                if($(this).data('lock')){return;}
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
                    {field: 'email', title: '邮箱'},
                    {field: 'id', title: '登陆密码',width: 100,align: 'center',event:'resetPassword',templet:function(data){
                        return '<span class="larryms-status-blue" style="color: #77D9ED;cursor: pointer">重置密码</span>';
                    }},
                    {field: 'status',title: '账号状态',toolbar: '#statusBar',width: 100,align: 'center'},
                    {field: 'id',title: '在线状态',width: 100,align: 'center',templet:function(data){
                        return (data.order_type == 1)?'<span class="larryms-status-blue">登录状态</span>':'<span class="larryms-status-gray">离线状态</span>';
                    }},
                    {field: 'id',title: '角色权限',width: 120,align: 'center',event:'allocationRole',templet:function(data){
                        return '<span class="larryms-status-blue" style="color: #77D9ED;cursor: pointer">查看/分配</span>';
                    }},
                    {field: 'created_at', title: '添加时间',width: 150,align: 'center'},
                ]],
                limit:100000,
                limits: [20, 30, 50],
                page: false,
            });

            layui.table.on('tool(adminfilter)', function(obj){
                if(obj.event == 'resetPassword'){
                    adminPageObj.resetPassword(obj.data.id);
                }else if(obj.event == 'allocationRole'){
                    adminPageObj.allocationRole(obj.data.id);
                }
            });

            $('#admin-table-reload').on('click',function(){
                adminListTable.reload({page: false,where:{}});
            });

            var adminPageObj = {
                adminAddLock:false,
                adminBoxIndex:null,
                showAddAdminBox(){
                    this.adminBoxIndex = layui.layer.open({
                        type: 1,title:'添加管理员',closeBtn: 1,shadeClose: true,area: ['500px', '400px'],content: TplAdmineBox.innerHTML
                    });
                },
                closeAdminBox(){
                    layer.close(this.adminBoxIndex)
                },
                addAdmin(){
                    let _this = this;
                    let data = {
                        username:$('#fr-admin-username').val(),
                        email:$('#fr-admin-email').val(),
                        password:$('#fr-admin-password').val(),
                        password2:$('#fr-admin-password2').val(),
                    };

                    let pwdReg = /^(?![a-zA-z]+$)(?!\d+$)(?![!@#$%^&*]+$)(?![a-zA-z\d]+$)(?![a-zA-z!@#$%^&*]+$)(?![\d!@#$%^&*]+$)[a-zA-Z\d!@#$%^&*]+$/;
                    if(data.username == ''){
                        $('#fr-admin-tip').show().find('span').text('登陆账号不能为空');
                    }else if(data.email == ''){
                        $('#fr-admin-tip').show().find('span').text('重复密码输入错误');
                    }else if(!larryms.isVerify(data.email,'email')){
                        $('#fr-admin-tip').show().find('span').text('邮箱格式不正确');
                    }else if(data.password == ''){
                        $('#fr-admin-tip').show().find('span').text('登录密码不能为空');
                    }else if(data.password.length < 8 || data.password.length >16  || !pwdReg.test(data.password)){
                        $('#fr-admin-tip').show().find('span').text('登录密码格式设置不正确');
                    }else if(data.password !== data.password2){
                        $('#fr-admin-tip').show().find('span').text('重复密码输入错误');
                    }else if(!this.adminAddLock){
                        this.adminAddLock = true;
                        delete data.password2;
                        $('#fr-admin-tip').hide();
                        $.ajax({
                            url: "{{route('rbac_create_admin_api')}}",
                            type: 'post',
                            dataType: 'json',
                            data:data,
                            success: function (res) {
                                _this.adminAddLock = false;
                                if(res.code == 200){
                                    layer.msg('添加管理员已成功');
                                    _this.closeAdminBox();
                                    adminListTable.reload({page: false,where:{}});
                                }else {
                                    layer.msg(res.msg)
                                }
                            },
                            error:function(){
                                _this.adminAddLock = false;
                            }
                        });
                    }
                },
                resetPassword(adminId){
                    let index = layer.open({
                        type: 1,title: false,closeBtn: false,area: '400px;',shade: 0.6,id: 'LAY_layuipro',resize: false,btn: ['立即修改', '取消修改']
                        ,btnAlign: 'c',moveType: 1,content: resetPasswordHtml.innerHTML,
                        btn1: function(){
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
                        }
                    });
                },
                allocationRole(adminId){
                    layer.open({
                        title:'分配角色',
                        type: 2,
                        area: ['700px', '450px'],
                        fixed: false, //不固定
                        maxmin: false,
                        content: '/admin/rbac/give-role-page?id='+adminId
                    });
                }
            };

            $('.show-admin-box').on('click',function(){
                adminPageObj.showAddAdminBox();
            });

            $(document).on('click','.close-admin-box',function(){
                adminPageObj.closeAdminBox();
            });

            $(document).on('click','.submit-admin-box',function(){
                adminPageObj.addAdmin();
            });
        });
    </script>
@endpush




