@extends('admin.layouts.layout-box')

@push('css')

@endpush

@section('content')
    <div class="layui-col-lg6 layui-col-md6 layui-col-sm12 layui-col-xs12">
        <section class="layui-card">
            <div class="layui-card-body" style="height: 355px;overflow-y: auto">
                <table class="layui-table new-article" >
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>角色名</th>
                            <th>描述</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    <input type="checkbox" name="roles"  value="{{$role->id}}" lay-skin="primary" @if(!empty($role->admin_id)) checked  @endif >
                                </td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->description}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <div style="background-color: #FFFFFF;width: 100%;height: 40px;text-align: center;">
            <div class="larryms-tools">
                <div class="layui-btn-group larryms-btn-group" style="background: none;">
                    <button class="layui-btn layui-btn-sm" id="from-cancel" style="background-color: #ccc;border-radius: 0" >取消授权</button>
                    <button class="layui-btn layui-btn-sm" style="margin-left: 5px !important;background-color: #77d9ed;border-radius: 0" id="from-submit">保存授权</button>
                </div>
            </div>
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
        }).use(['larry','table','larryms'],function(){
            var larry = layui.larry;

            $('#from-cancel').on('click',function(){
                var parent_index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(parent_index);
            });

            $('#from-submit').on('click', function() {
                if(lock){return;}

                let ids = '';
                $.each($('input[name="roles"]:checked'),function(){
                    ids += $(this).val()+',';
                });

                let upload_index = layer.msg('授权中, 请稍等...', {icon: 16,shade: 0.01,time:0});
                lock = true;

                var parent_index = parent.layer.getFrameIndex(window.name);
                $.ajax({
                    url: "{{route('rbac_give_role_api')}}",
                    type: 'post',
                    dataType: 'json',
                    data:{adminID:"{{$adminID}}",ids:ids},
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
        });
    </script>
@endpush




