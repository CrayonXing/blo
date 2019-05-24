@extends('admin.layouts.layout-box')

@push('css')
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/admin.css">

    <style>
        body.grant-auth ul.ztree>li>a>span {
            font-size: 15px;
            font-weight: 300;
            color: green;
        }
        body.grant-auth ul.ztree>li {
            background: #dfe5e9;
            padding: 8px;
            border-bottom: 1px solid #f8efef;
        }

        .ztree li a.curSelectedNode {
            padding-top: 0px;
             background-color: unset !important;
            color: black;
            height: 16px;
             border:unset !important;
            opacity: 0.8;
        }
    </style>

@endpush

@section('content')

    <div class="layui-row larryms-panel" style="height: 100%;border-radius: 0;overflow: auto;padding-bottom: 50px;">
        <div class="larryms-panel-heading layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12" style="background-color: #ffffff;margin-bottom: 10px;padding-bottom: 10px;">
            <span class="panel-tit">角色权限分配【<span style="color: #ff3333">{{$roleInfo->name}}</span>】</span>
        </div>
        <ul id="authTree" class="ztree"></ul>
    </div>

    <div style="position: fixed;left: 0;bottom: 0;background-color: #FFFFFF;width: 100%;height: 40px;text-align: center;padding-top: 5px;">
        <div class="larryms-tools">
            <div class="layui-btn-group larryms-btn-group" style="background: none;">
                <button class="layui-btn layui-btn-sm" id="from-cancel" style="background-color: #ccc" >取消授权</button>
                <button class="layui-btn layui-btn-sm" style="margin-left: 5px !important;background-color: #77d9ed" id="from-submit">保存授权</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="/plugin/larryms/layui/layui.js"></script>

    <script type="text/javascript">
        var obj = JSON.parse('<?php echo $data ;?>');
        let lock = false;
        layui.config({
            base: '/plugin/larryms/',
        }).extend({
            larry: 'js/base'
        }).use(['larry','table','larryms','ztreeCheck'],function(){
            var larry = layui.larry,ztree = layui.ztree,ztreeCheck = layui.ztreeCheck;
            var authNodes = obj;

            function setCheck() {
                var zTree = ztree.getZTreeObj('authTree');
                zTree.setting.check.chkboxType = { "Y": "ps", "N": "ps" };
            }

            ztree.init($('#authTree'), {
                check: { enable: true },
                view: { showLine: false, showIcon: false, dblClickExpand: false },
                data: {
                    simpleData: { enable: true, pIdKey: 'pid', idKey: 'id' },
                    key: { name: 'title' }
                }
            }, authNodes);
            setCheck();


            $('#from-submit').on('click', function(data) {
                if(lock){return;}

                var treeObj = ztree.getZTreeObj("authTree"),nodes = treeObj.getCheckedNodes(true),ids = "";
                for (var i = 0; i < nodes.length; i++) {
                    ids += nodes[i].id + ",";
                }

                var upload_index = layer.msg('授权中, 请稍等...', {icon: 16,shade: 0.01,time:0});
                lock = true;
                var parent_index = parent.layer.getFrameIndex(window.name);
                $.ajax({
                    url: "{{route('rbac_give_permissions_api')}}",
                    type: 'post',
                    dataType: 'json',
                    data:{roleID:"{{$roleInfo->id}}",ids:ids},
                    success: function (res) {
                        layer.close(upload_index)
                        if(res.code == 200){
                            layer.msg('授权成功');
                            setTimeout(function(){
                                parent.layer.close(parent_index);
                            },1500);
                        }else{
                            layer.close(upload_index)
                            lock = false;
                            layer.msg('授权失败');
                        }
                    },
                    error:function(){
                        lock = false;
                        layer.msg('授权失败');
                    }
                });

                return false;
            });

            $('#from-cancel').on('click',function(){
                var parent_index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(parent_index);
            });
        });
        $('body').addClass('larryms-auth grant-auth')
    </script>
@endpush




