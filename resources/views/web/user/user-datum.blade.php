@extends('web.layouts.blog-layout')

@section('content')
    <link rel="stylesheet" href="/plugin/tagsInput/jquery.tagsinput-revisited.css"/>
    <link rel="stylesheet" href="/plugin/cropper/cropper.min.css"/>
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

    <style type="text/css">

    .avatar-view {
        display: block;
        margin: 15% auto 5%;
        height: 220px;
        width: 220px;
        border: 3px solid #fff;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, .15);
        cursor: pointer;
        overflow: hidden
    }

    .avatar-view img {
        width: 100%
    }

    .avatar-wrapper {
        height: 364px;
        width: 100%;
        margin-top: 15px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .25);
        background-color: #fcfcfc;
        overflow: hidden
    }

    .avatar-wrapper img {
        display: block;
        height: auto;
        max-width: 100%
    }

    .avatar-preview {
        float: left;
        margin-top: 15px;
        margin-right: 15px;
        border: 1px solid #eee;
        background-color: #fff;
        overflow: hidden;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .25);
    }

    .avatar-preview:hover {
        border-color: #ccf;
        box-shadow: 0 0 5px rgba(0, 0, 0, .15)
    }

    .avatar-preview img {
        width: 100%
    }

    .preview-lg {
        height: 184px;
        width: 184px;
        margin-top: 15px
    }

    .preview-md {
        height: 100px;
        width: 100px
    }

    .preview-sm {
        height: 50px;
        width: 50px
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
                                            <span style="display: block;color: #9ddbf7;border: 1px solid #9ddbf7;border-radius: 3px;width: 90px;height: 25px;line-height: 21px;padding-left: 5px;cursor: pointer;margin-top: 20px;margin-left: 20px;" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 800, height: 500}"><i class="iconfont icon-editor"></i> 更换头像</span>
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
            <div class="am-modal-hd" style="text-align: left;background-color: #fbeaea;padding-top: 5px;"><i class="iconfont icon-editor"></i> 头像设置
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
                        <div class="am-tab-panel" style="height: 460px;overflow-y: auto;">
                            <form class="avatar-form"  enctype="multipart/form-data" onsubmit="return false;" >
                                <div style="width: 755px;height: 100%;">
                                    <div style="width: 555px;float: left;height: 400px;">
                                        <div class="avatar-wrapper"></div>
                                    </div>
                                    <div style="width: 200px;height: 400px;float: left;padding: 0px 5px 5px 8px;">
                                        <div class="avatar-preview preview-lg" id="imageHead"></div>
                                        <div class="avatar-preview preview-md"></div>
                                        <div class="avatar-preview preview-sm"></div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <div class="avatar-btns" >
                                    	<input class="avatar-src" name="avatar_src" type="hidden">
                                        <input class="avatar-data" name="avatar_data" type="hidden">

                                        <div class="avatar-upload" style="float: left;width: 210px;">
											<div style="position: relative;;width: 200px;">
												<input style="position: absolute;top: 0;left: 0;z-index: 1;opacity: 0"  class="avatar-input" id="avatarInput" name="avatar_file" type="file" >
												

												<div style="position: absolute;;width:200px;height: 33px;top: 0;left: 0;background: #6ae8fd;line-height: 33px;text-align: center;color: white;cursor:pointer !important;">选择图片</div>
											</div>
                                        </div>

                                        <button  class="am-btn am-btn-secondary am-btn-sm" data-method="rotate" data-option="-15" style="float: left;margin-left: 343px;" type="submit">左旋转</button>

                                        <button class="am-btn am-btn-secondary am-btn-sm" data-method="rotate" data-option="15" style="float: left;margin-left: 5px;" type="submit">右旋转</button>

                                        <button class="am-btn am-btn-success am-btn-sm avatar-save" type="submit" style="float: left;margin-left: 5px;">保存</button>
                                    </div>
                                </div>
                            </form>
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
    <script type="text/javascript" src="/plugin/cropper/cropper.min.js"></script>
    <script type="text/javascript" src="/plugin/cropper/cropper.min.js"></script>
    <script src="/plugin/cropper/html2canvas.min.js"></script>
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
    <script type='text/JavaScript'>
    (function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        factory(jQuery);
    }
})(function ($) {
    'use strict';
    var console = window.console || {
        log: function () {}
    };

    function CropAvatar($element) {
        this.$container = $element;
        this.$avatarView = this.$container.find('.avatar-view');
        this.$avatar = this.$avatarView.find('img');
        this.$loading = $('.loading');
        this.$avatarForm = $('.avatar-form');
        this.$avatarUpload = $('.avatar-upload');
        this.$avatarSrc = $('.avatar-src');
        this.$avatarData = $('.avatar-data');
        this.$avatarInput = $('.avatar-input');
        this.$avatarSave = $('.avatar-save');
        this.$avatarBtns = $('.avatar-btns');
        this.$avatarWrapper = $('.avatar-wrapper');
        this.$avatarPreview = $('.avatar-preview');
        this.init();
    }
    CropAvatar.prototype = {
        constructor: CropAvatar,
        support: {
            fileList: !! $('<input type="file">').prop('files'),
            blobURLs: !! window.URL && URL.createObjectURL,
            formData: !! window.FormData
        },
        init: function () {
            this.support.datauri = this.support.fileList && this.support.blobURLs;
            if (!this.support.formData) {
                this.initIframe();
            }

            this.addListener();
        },
        addListener: function () {
            this.$avatarView.on('click', $.proxy(this.click, this));
            this.$avatarInput.on('change', $.proxy(this.change, this));
            this.$avatarForm.on('submit', $.proxy(this.submit, this));
            this.$avatarBtns.on('click', $.proxy(this.rotate, this));
        },
        initPreview: function () {
            var url = this.$avatar.attr('src');
            this.$avatarPreview.empty().html('<img src="' + url + '">');
        },
        initIframe: function () {
            var target = 'upload-iframe-' + (new Date()).getTime(),
                $iframe = $('<iframe>').attr({
                    name: target,
                    src: ''
                }),
                _this = this;
            $iframe.one('load', function () {
                    $iframe.on('load', function () {
                        var data;
                        try {
                            data = $(this).contents().find('body').text();
                        } catch (e) {
                            console.log(e.message);
                        }
                        if (data) {
                            try {
                                data = $.parseJSON(data);
                            } catch (e) {
                                console.log(e.message);
                            }
                            _this.submitDone(data);
                        } else {
                            _this.submitFail('Image upload failed!');
                        }
                        _this.submitEnd();
                    });
                });
            this.$iframe = $iframe;
            this.$avatarForm.attr('target', target).after($iframe.hide());
        },
        change: function () {
            var files, file;
            if (this.support.datauri) {
                files = this.$avatarInput.prop('files');
                if (files.length > 0) {
                    file = files[0];
                    if (this.isImageFile(file)) {
                        if (this.url) {
                            URL.revokeObjectURL(this.url);
                        }
                        this.url = URL.createObjectURL(file);
                        this.startCropper();
                    }
                }
            } else {
                file = this.$avatarInput.val();
                if (this.isImageFile(file)) {
                    this.syncUpload();
                }
            }
        },
        submit: function () {
            if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
                return false;
            }

            if (this.support.formData) {
                var img_lg = document.getElementById('imageHead');
                // 截图小的显示框内的内容
                html2canvas(img_lg, {
                    allowTaint: true,
                    taintTest: false,
                    onrendered: function(canvas) {
                        canvas.id = "mycanvas";
                        //生成base64图片数据
                        var dataUrl = canvas.toDataURL("image/jpeg");
                        var newImg = document.createElement("img");
                        newImg.src = dataUrl;
                        console.log(dataUrl)

                        $.ajax('/user-uploadHead', {
                            type: 'post',
                            data: {img:dataUrl},
                            dataType: 'json',
                            success: function (data) {
                                if(data.code == 200){
                                    $('#fr-userdatum-head').attr('src',data.data.url);
                                    $('#doc-modal-1').modal('close')
                                }
                            },
                        });
                    }
                });

                return false;
            }
        },
        rotate: function (e) {
            var data;
            if (this.active) {
                data = $(e.target).data();
                if (data.method) {
                    this.$img.cropper(data.method, data.option);
                }
            }
        },
        isImageFile: function (file) {
            if (file.type) {
                return /^image\/\w+$/.test(file.type);
            } else {
                return /\.(jpg|jpeg|png|gif)$/.test(file);
            }
        },
        startCropper: function () {
            var _this = this;
            if (this.active) {
                this.$img.cropper('replace', this.url);
            } else {
                this.$img = $('<img src="' + this.url + '">');
                this.$avatarWrapper.empty().html(this.$img);
                this.$img.cropper({
                    aspectRatio: 1,
                    preview: this.$avatarPreview.selector,
                    strict: false,
                    crop: function (data) {
                        var json = ['{"x":' + data.x, '"y":' + data.y, '"height":' + data.height, '"width":' + data.width, '"rotate":' + data.rotate + '}'].join();
                        _this.$avatarData.val(json);
                    }
                });
                this.active = true;
            }
        },
        stopCropper: function () {
            if (this.active) {
                this.$img.cropper('destroy');
                this.$img.remove();
                this.active = false;
            }
        },
        ajaxUpload: function () {
            var url = this.$avatarForm.attr('action'),
                data = new FormData(this.$avatarForm[0]),
                _this = this;
            $.ajax(url, {
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        _this.submitStart();
                    },
                    success: function (data) {
                        _this.submitDone(data);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        _this.submitFail(textStatus || errorThrown);
                    },
                    complete: function () {
                        _this.submitEnd();
                    }
                });
        },
        syncUpload: function () {
            this.$avatarSave.click();
        },
        submitStart: function () {
            this.$loading.fadeIn();
        },
        submitDone: function (data) {
            console.log(data);
            if ($.isPlainObject(data) && data.state === 200) {
                if (data.result) {
                    this.url = data.result;
                    if (this.support.datauri || this.uploaded) {
                        this.uploaded = false;
                        this.cropDone();
                    } else {
                        this.uploaded = true;
                        this.$avatarSrc.val(this.url);
                        this.startCropper();
                    }
                    this.$avatarInput.val('');
                } else if (data.message) {
                    this.alert(data.message);
                }
            } else {
                this.alert('Failed to response');
            }
        },
        submitFail: function (msg) {
            this.alert(msg);
        },
        submitEnd: function () {
            this.$loading.fadeOut();
        },
        cropDone: function () {
            this.$avatarForm.get(0).reset();
            this.$avatar.attr('src', this.url);
            this.stopCropper();
        },
        alert: function (msg) {
            var $alert = ['<div class="alert alert-danger avater-alert">', '<button type="button" class="close" data-dismiss="alert">&times;</button>', msg, '</div>'].join('');
            this.$avatarUpload.after($alert);
        }
    };

    $(function () {
        return new CropAvatar($('#my-test-div'));
    });
});
</script>
@endpush