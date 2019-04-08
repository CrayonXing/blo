@extends('web.layouts.blog-layout')

@section('content')
    <link rel="stylesheet" href="/plugin/tagsInput/jquery.tagsinput-revisited.css"/>
    <style type="text/css">
        .tagsinput .tag {
            position: relative;background: #e7e2e2;display: block;max-width: 100%;word-wrap: break-word;
            color: #fff;padding: 5px 30px 5px 5px;border-radius: 0;margin: 0 5px 5px 0;
        }

        .tagsinput div input {
            outline: none;

        }

        .tagsinput{
            border: none !important;
            border-bottom: 1px solid #ebe7e7 !important;
        }

        .web-sys-head{
            list-style: none;margin: 0;padding: 5px 5px 5px 10px;
        }
        .web-sys-head li{
            float: left;margin-top: 10px;position: relative;width: 80px;
        }
        .web-sys-head li img{
            width: 60px;height: 60px;border-radius: 5px;cursor: pointer;
        }

        .web-sys-head li i{
            width: 30px;
            height: 10px;
            display: none;
            position: absolute;
            top: 37px;
            right: 15px;
            font-size: 18px;
            color: #159d15;
        }

        .head-img-selectd i{
            display: inline-block !important;
        }

        .web-sys-head::-webkit-scrollbar {/*滚动条整体样式*/
            width: 5px;     /*高宽分别对应横竖滚动条的尺寸*/
            height: 1px;
        }
        .web-sys-head::-webkit-scrollbar-thumb {/*滚动条里面小方块*/
            /*border-radius: 10px;*/
            -webkit-box-shadow: inset 0 0 2px rgba(170, 170, 170, 0.2);
            background: #b7b7b7;
        }
        .web-sys-head::-webkit-scrollbar-track {/*滚动条里面轨道*/
            -webkit-box-shadow: inset 0 0 2px rgba(92, 92, 92, 0.2);
            /*border-radius: 10px;*/
            background: #EDEDED;
        }
    </style>
    <article>
        @include('web.layouts.web-main-left')

        <div class="web-main-right">
            <div class="web-main-breadcrumb">
                <p><a>会员中心</a> <span>/</span> <a>个人信息</a></p>
            </div>
            <div class="web-main-content" style="padding: 50px 10px 20px 10px;">
                <div class="am-g">
                    <div class="am-u-sm-8">
                        <form class="am-form am-form-horizontal" onsubmit="return false">
                            <div class="am-form-group">
                                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label" style="font-weight: initial;color: #ccc;">登录账号</label>
                                <div class="am-u-sm-10">
                                    <input type="text"  value="{{$uinfo['mobile']}}"  disabled style="border: none;background-color:#fff;padding-left: 0;color: #d8c6c6;font-size: 18px;" />
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label" style="font-weight: initial;color: #ccc;">我的头像</label>
                                <div class="am-u-sm-10" style="padding-bottom: 20px;">
                                    <div class="am-g">
                                        <div class="am-u-sm-2"><img src="{{$uinfo['head']}}" id="fr-userdatum-head"  style="width:70px;height: 70px;border-radius: 50% 50%;"></div>
                                        <div class="am-u-sm-10">
                                            <span style="display: block;color: #9ddbf7;border: 1px solid #9ddbf7;border-radius: 3px;width: 90px;height: 25px;line-height: 21px;padding-left: 5px;cursor: pointer;margin-top: 20px;margin-left: 20px;" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 800, height: 400}"><i class="iconfont icon-editor"></i> 更换头像</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label  class="am-u-sm-2 am-form-label" style="font-weight: initial;color: #ccc;" >博主昵称</label>
                                <div class="am-u-sm-10">
                                    <input type="text"  value="{{$uinfo['nickname']}}"  placeholder="输入你的昵称"  id="fr-userdatum-nickname" style="color: #8a8686;border: none;border-bottom: 1px solid #ebe7e7;" />
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label" style="font-weight: initial;color: #ccc;" >个人标签</label>
                                <div class="am-u-sm-10">
                                    <input  type="text" value="{{$uinfo['tags']}}"  id="fr-userdatum-tags">
                                    <p class="am-form-help">注: 个人标签不能超过3个</p>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label" style="font-weight: initial;color: #ccc;" >座 右 铭</label>
                                <div class="am-u-sm-10">
                                    <textarea rows="5"  style="resize: none;color: #8a8686;border: 1px solid #ebe7e7 !important;"  id="fr-userdatum-motto" >{{$uinfo['motto']}}</textarea>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-10 am-u-sm-offset-2">
                                    <span style="width: 100px;height: 30px;line-height: 30px;background: #fc9d9a;display: block;text-align: center;cursor: pointer;color: white" id="fr-userdatum-btn"  onclick="o.submit()">修改资料</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>


    <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1" style="z-index: 999999999999999">
        <div class="am-modal-dialog">
            <div class="am-modal-hd" style="text-align: left;background-color: #fbeaea;padding-top: 5px;">更改头像
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd" style="padding-top: 10px;background-color: white">
                <div class="am-tabs" data-am-tabs="{noSwipe: 1}" id="doc-tab-demo-1" style="height: 100%;">
                    <ul class="am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="javascript: void(0)">系统个性头像</a></li>
                        <li><a href="javascript: void(0)">自定义上传</a></li>
                    </ul>

                    <div class="am-tabs-bd" >
                        <div class="am-tab-panel am-active" style="height: 410px;padding: 0;">
                            <ul class="web-sys-head" style="height: 360px;overflow-y: auto;padding-left: 35px">
                                @foreach($imgs as $src)
                                    <li><img src="{{$src}}" alt=""><i class="am-icon-check-circle"></i></li>
                                @endforeach
                            </ul>
                            <div style="height: 40px;padding: 0;margin-top: 5px;border-top: 1px solid #ccc;line-height: 40px;">
                                <span class="am-btn am-btn-default am-btn-sm" onclick="$('#doc-modal-1').modal('close')" >取消</span>
                                <span class="am-btn am-btn-secondary am-btn-sm" id="head-btn" >确定</span>
                            </div>
                        </div>
                        <div class="am-tab-panel" style="height: 410px;">
                                https://github.com/fengyuanchen/cropper
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"></script>
    <script type="text/javascript" src="/plugin/tagsInput/jquery.tagsinput-revisited.js"></script>
    <script type="text/javascript">
        $('#fr-userdatum-tags').tagsInput();

        var o = {
            isSubmit:false,
            getData(){
                return {
                    nickname:$('#fr-userdatum-nickname').val(),
                    tags:$('#fr-userdatum-tags').val(),
                    motto:$('#fr-userdatum-motto').val(),
                    head:$('#fr-userdatum-head').attr('src')
                };
            },
            submit(){
                if(o.isSubmit){return false;}

                $.ajax({
                    url: "/user-edit-datum",
                    type: 'post',
                    data: o.getData(),
                    dataType: 'json',
                    beforeSend: function () {
                        o.isSubmit = true;
                        $('#fr-userdatum-btn').html('<i class="am-icon-spinner am-icon-pulse"></i>');
                    },
                    success: function (res) {
                        if(res.code !== 200){
                            alert(res.msg);
                            $('#fr-userdatum-btn').html('修改资料');
                            o.isSubmit = false;
                        }else{
                            $('#fr-userdatum-btn').html('修改成功<i class="am-icon-check"></i>');
                            setTimeout(function(){
                                $('#fr-userdatum-btn').html('修改资料');
                                o.isSubmit = false;
                            },3000);
                        }
                    },
                    error:function(){
                        o.isSubmit = false;
                    }
                });

                return false;
            }
        };

        $('.web-sys-head li').click(function(){
            $(this).addClass('head-img-selectd').siblings().removeClass('head-img-selectd');
        });

        $('#head-btn').click(function(){
            $('#fr-userdatum-head').attr('src',$('.head-img-selectd img').attr('src'));
            $('#doc-modal-1').modal('close')
        });
    </script>
@endpush