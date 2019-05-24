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
                <li >
                    <a href="/admin/rbac/role-page" >
                        <span class="icon"></span>
                        <div class="text">角色管理</div>
                    </a>
                </li>
                <li  class="active">
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
                <span class="panel-tit">权限管理</span>
            </div>
            <div class="larryms-panel-body layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12">
                <div class="larryms-tools">
                    <div class="layui-btn-group larryms-btn-group" style="background: none;">
                        <button class="layui-btn layui-btn-sm layui-btn-warm" onclick="window.location.reload()" style="background-color: #77d9ed"><i class="icon larry-icon larry-kuangjia_daohang_shuaxin"></i> 刷新</button>
                        <button class="layui-btn layui-btn-sm layui-btn-warm " style="margin-left: 5px !important;"><i class="icon larry-icon larry-jia1"></i> 添加权限</button>
                    </div>
                </div>

                <table class="layui-table" lay-size="lg">
                    <colgroup>
                        <col width="30%">
                        <col width="30%">
                        <col width="8%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                    <tr >
                        <th>权限描述</th>
                        <th>权限路由</th>
                        <th style="text-align: center">权限类型</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($treeList as $rule)
                            <tr>
                                <td><?php echo $rule['description']; ?></td>
                                <td>{{$rule['route']}}</td>
                                <td style="text-align: center">
                                    @if ($rule['type'] == 0)
                                        <span class="layui-badge layui-bg-blue" style="width: 100px;">目&nbsp;&nbsp;&nbsp;&nbsp;录</span>
                                    @elseif ($rule['type'] == 1)
                                        <span class="layui-badge" style="width: 100px;">页&nbsp;&nbsp;&nbsp;&nbsp;面</span>
                                    @else
                                        <span class="layui-badge layui-bg-green" style="width: 100px;">权&nbsp;&nbsp;&nbsp;&nbsp;限</span>
                                    @endif
                                </td>
                                <td>编辑</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="/plugin/larryms/layui/layui.js"></script>
    <script type="text/javascript">
        layui.config({
            base: '/plugin/larryms/',
        }).extend({
            larry: 'js/base'
        }).use(['larry','table','larryms'],function(){
            var larryms = layui.larryms;
            $(document).on('mouseover','.my-tips', function(){
                layer.tips('点击可切换角色状态', this,{tips: 2}); //在元素的事件回调体中，follow直接赋予this即可
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
        });
    </script>
@endpush