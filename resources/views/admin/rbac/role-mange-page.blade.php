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
            <li>
                <a href="/admin/rbac/admin-page" >
                    <span class="icon"></span>
                    <div class="text">管理员管理</div>
                </a>
            </li>
            <li class="active" >
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
            <span class="panel-tit">角色管理</span>
        </div>
        <div class="larryms-panel-body layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12">
            <div class="larryms-tools">
                <div class="layui-btn-group larryms-btn-group" style="background: none;">
                    <button class="layui-btn layui-btn-sm layui-btn-warm" id="admin-table-reload" style="background-color: #77d9ed"><i class="icon larry-icon larry-kuangjia_daohang_shuaxin"></i> 刷新</button>
                    <button class="layui-btn layui-btn-sm layui-btn-warm " style="margin-left: 5px !important;" id="create-role"><i class="icon larry-icon larry-jia1"></i> 添加角色</button>
                </div>
            </div>

            <table class="layui-table larryms-table-id"  id="table-list-role" lay-filter="rolefilter"></table>


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
    <div data-status="@{{ d.status }}" data-id="@{{ d.id }}" data-lock="false"  class="changeStatus">
        @{{# if(d.status == 10){ }}
        <span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>
        @{{# } else { }}
        <span class="larryms-status-gray my-tips pointer" >禁止操作</span>
        @{{# }}}
    </div>
</script>

<script type="text/html" id="addRoleHtml">
    <div style="padding: 20px;line-height: 22px;background-color: #ffffff;color: #9d8c8c;font-weight: 300;border-bottom: 1px solid #d7d7d7;">
        <form class="form-horizontal" id="changePasswordBox">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">角色名称</label>
                <div class="col-sm-9">
                    <input type="hidden" class="form-control" id="fr-role-id" value="0">
                    <input type="text" class="form-control" id="fr-role-name" placeholder="请填写角色名称" style="border-radius: 0;">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">角色名描述</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fr-role-desc" placeholder="请填写角色名描述" style="border-radius: 0;">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-3 control-label">角色状态</label>
                <div class="col-sm-9" style="padding-top: 8px;">
                    <input type="radio" name="fr-role-status" value="10" id="fr-role-status10"><label for="fr-role-status10">正常</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="fr-role-status" value="0"  id="fr-role-status0"><label for="fr-role-status0">禁用</label>
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
            let html =  status == 10?'<span class="larryms-status-gray my-tips pointer" >禁止操作</span>':'<span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>';

            _this.data('lock',true);
            $.ajax({
                url: "{{route('rbac_chage_role_status')}}",
                type: 'post',
                dataType: 'json',
                data:{id:_this.data('id'),status:status==10?0:10},
                success: function (res) {
                    if(res.code == 200){
                        _this.data('status',status==0?10:0);
                        _this.html(html);
                    }else{
                        _this.data('status',status);
                        _this.html(status == 0?'<span class="larryms-status-gray my-tips pointer" >禁止操作</span>':'<span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>');
                    }

                    _this.data('lock',false);
                },
                error:function(){
                    _this.data('lock',false);
                    _this.data('status',status);
                    _this.html(status == 0?'<span class="larryms-status-gray my-tips pointer" >禁止操作</span>':'<span class="larryms-status-green my-tips pointer" style="color: #75d790;cursor: pointer"  >正常使用</span>');
                }
            });
        });

        let roleListTable = table.render({
            elem: '#table-list-role'
            , id: 'table-list-role-reload'
            , url: '/admin/rbac/get-role-api',
            loading: true,
            parseData: function (res) {
                return {code: res.code == 200 ? 0 : res.code, msg: res.msg, data: res.data.rows, count: res.data.total};
            },
            text: {none: '暂无数据...'},
            cols: [[
                {field: 'name', title: '角色名称',width:200},
                {field: 'description',title: '角色描述',align: 'center'},
                {field: 'status',title: '角色状态',toolbar: '#statusBar',width: 100,align: 'center'},
                {field: 'user_count',title: '分配人数',width: 100,align: 'center'},
                {field: 'id', title: '角色权限',width: 100,align: 'center',event:'setPermissions',templet:function(data){
                        return '<span class="larryms-status-blue" style="color: #77D9ED;cursor: pointer">分配权限</span>';
                }},
                {field: 'created_at', title: '创建时间',width: 200,align: 'center'},
                {field: 'id', title: '操作',width: 100,align: 'center',event:'edit',templet:function(data){
                        return '<span class="larryms-status-blue" style="color: #77D9ED;cursor: pointer">编辑信息</span>';
                }},
            ]],
            limit:1000000,
            limits: [20, 30, 50],
            page: false,
        });

        layui.table.on('tool(rolefilter)', function(obj){
            if(obj.event == 'setPermissions'){
                layer.open({
                    type: 2,
                    title: false,
                    shadeClose: false,
                    area: ['893px', '600px'],
                    content: '/admin/rbac/give-permissions-page?id='+obj.data.id
                });
            }else if(obj.event == 'edit'){
                roleObj.showEditBox();
                $('#fr-role-id').val(obj.data.id);
                $('#fr-role-name').val(obj.data.name);
                $('#fr-role-desc').val(obj.data.description);
                $('#fr-role-status'+obj.data.status).prop("checked",true);
            }
        });

        $('#admin-table-reload').on('click',function(){
            roleListTable.reload({
                page: {curr: 1},
                where:{}
            });
        });


        let roleObj = {
            lock:false,
            showEditBox(){
                let index = layer.open({
                    type: 1,title: false,closeBtn: false,area: '400px;',shade: 0.6,id: 'LAY_layuipro',resize: false,btn: ['保存', '取消']
                    ,btnAlign: 'c',moveType: 1,content: addRoleHtml.innerHTML
                    ,btn1: function(){
                        if(roleObj.lock){return;}
                        let data = {
                            id:$('#fr-role-id').val(),
                            name:$('#fr-role-name').val(),
                            desc:$('#fr-role-desc').val(),
                            status:$('input[name="fr-role-status"]:checked').val() || null,
                        };

                        if(data.name ==''){
                            layer.msg('角色名称不能为空');return;
                        }else if(data.desc ==''){
                            layer.msg('角色名描述不能为空');return;
                        }else if(data.status == null){
                            layer.msg('请选择角色状态');return;
                        }else {
                            $.ajax({
                                url: "{{route('rbac_create_role_api')}}",
                                type: 'post',
                                dataType: 'json',
                                data:data,
                                success: function (res) {
                                    if(res.code == 200){
                                        layer.close(index);
                                        layer.msg('操作成功');

                                        $('#admin-table-reload').trigger('click');
                                    } else if(res.code == 302){
                                        layer.msg('角色已存在');
                                    }else {
                                        layer.msg('操作失败');
                                    }
                                }
                            });
                        }
                    }
                });
            }
        };


        $('#create-role').on('click',function(){
            roleObj.showEditBox();
        })
    });
</script>
@endpush




