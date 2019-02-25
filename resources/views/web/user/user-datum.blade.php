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
                        <form class="am-form am-form-horizontal">
                            <div class="am-form-group">
                                <label for="doc-ipt-3" class="am-u-sm-2 am-form-label" style="font-weight: initial;color: #ccc;">登录账号</label>
                                <div class="am-u-sm-10">
                                    <input type="text"  value="{{$uinfo['mobile']}}"  disabled style="border: none;background-color:#fff;padding-left: 0;color: #d8c6c6;font-size: 18px;" />
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label  class="am-u-sm-2 am-form-label" style="font-weight: initial;color: #ccc;" >博主昵称</label>
                                <div class="am-u-sm-10">
                                    <input type="text"  value="{{$uinfo['nickname']}}"  placeholder="输入你的昵称"  id="fr-userdatum-nickname" style="color: #8a8686;" />
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
                                    <textarea rows="5"  style="resize: none;color: #8a8686;"  id="fr-userdatum-motto">{{$uinfo['motto']}}</textarea>
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
@endsection

@push('scripts')
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
                };
            },
            submit(){
                if(o.isSubmit){return;}

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
            }
        };
    </script>
@endpush