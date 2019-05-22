@extends('web.layouts.blog-layout')

@section('content')
    <link rel="stylesheet" href="/plugin/tagsInput/jquery.tagsinput-revisited.css"/>
    <style type="text/css">
        .tagsinput .tag {
            position: relative;background: #68c1ec;display: block;max-width: 100%;word-wrap: break-word;
            color: #fff;padding: 5px 30px 5px 5px;border-radius: 0;margin: 0 5px 5px 0;
        }

        .infos {
            float: left;width: 70%;overflow: initial;background: #FFF;margin: 20px 0;
        }

        .w-e-toolbar {
            background-color: #f7f7f7 !important;border: 1px solid #e3dada !important;
        }

        .w-e-text-container {
            border: 1px solid #f3f2f2 !important;
        }

        .w-e-text {
            padding: 0 10px;
            overflow-y: auto !important;
        }

        .am-ucheck-icons {
            color: #efe4e4;
        }

        .preview-container-show:hover i {
            color: #64c1ef !important;
        }

        #preview-container{
            position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index:999999999;display: none
        }

        #preview-container-right{
            position: fixed;top: 0;right: 0;width: 844px;height: 100%;border-left:1px solid #f4f4f4;z-index: 999999999;background-color: #fff;overflow-y: auto;box-shadow: -46px 29px 114px -21px #fbf7f7;
        }

        #upload-container{
            position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 99999999999;background: rgba(66,66,66,0.8);display: none;
        }

        #upload-container-left{
            width: 600px;height: 400px;position: fixed;right: 0;left: 0;margin: 0 auto;top: 25%;background: #fff;z-index: 99999999999;
        }

        .upload-container-title{
            height: 40px;background: #f7b8b6;line-height: 40px;font-size: 18px;color: #fff;padding-left: 10px;
        }

        .upload-container-title > span{
            display: inline-block;float: right;padding-right: 10px;
        }

        .upload-container-title > span > i{
            color: #fff;cursor: pointer;
        }

        .upload-container-footer{
            position: absolute;bottom: 0;left: 0;height: 50px;width: 100%;text-align: right;border-top:1px solid #f1efef;padding-top: 5px;padding-right: 10px;
        }

        .upload-container-fr-div{
            width: 400px;height: 50px;margin: 0 auto;margin-top: 20px;position: relative;
        }

        .upload-container-fr-div i{
            font-size: 66px;color: #ccc;
        }

        .upload-container-fr-div input{
            opacity: 0;position: absolute;width: 100%;height: 100px;top: 0;cursor: pointer;
        }

        .upload-container-img-box{
            width: 80px;height: 80px;border: 1px dashed #dbd5d5;position: relative;float: left;margin-left: 15px;cursor: pointer;
        }
        .upload-container-img-box > img{
            width: 78px;height: 78px;
        }

        .upload-container-img-box > span{
            display: inline-block;width:16px;height: 16px;position: absolute;top: 0;right: 0;background: #aba5a5;display: none;
        }

        .upload-container-img-box > span > i{
            color: #fff;cursor: pointer;
        }

        .fr-img-box-list-remove{
            position: absolute;top: 0;left: 0;background: rgb(49,49,49,0.5);color: #fff;z-index: 2;width: 100%;height: 100%;line-height: 77px;text-align: center;cursor: pointer;display: none
        }

        .fr-img-box{
            position: relative;float: left;margin-right: 10px;
        }

        .fr-img-box img{
            width: 80px;height: 77px;z-index: 1;
        }

        .pet_sixin_form_r_nr {
            position: absolute;bottom: 61px;right: 6px;color: #b5adad;background: #fadbdb;font-size: 14px;border-radius: 5px;padding: 15px;z-index: 99;width: 300px;max-height: 300px;height: auto;display: none;
        }

        .pet_sixin_form_r_nr_sj {
            position: absolute;background: #fadbdb;width: 17px;height: 17px;-webkit-transform: rotate(45deg);transform: rotate(45deg);bottom: -5px;right: 35px;border-radius: 2px;
        }

        #upload-container-tip-box{
            position: absolute;top: 0;left: 0;width: 100%;height: 100%;background: rgb(49,49,49,0.6);line-height: 100%;color: #fff;text-align: center;padding-top:150px;display: none;
        }

        .fr-img-box-list{
            height: 77px;float: left;margin-left: 5px;
        }

        .upload-container-error{
            display: none;float: left;line-height: 33px;padding-left: 10px;color: #ed9696;font-size: 16px;
        }

    </style>
    <article>
        <div class="web-main-right" style="width: 1200px;">
            <div class="web-main-breadcrumb">
                <p><a>New博客</a> <span>/</span> <a>添加(编辑文章)</a></p>
            </div>
            <div class="web-main-content">
                <div class="newsview">
                    <div class="news_about" style="margin-left: 8px;margin-right: 10px;"><strong>简介</strong>
                        New博客，用来做什么？
                        我刚开始就把它当做一个我自我学习的地方，
                        写上一些写一些在工作中遇到的问题及相应的解决方案，
                        也会放上自我的学习的心得体会。
                    </div>
                    <div class="news_infos" style="min-height: 800px;padding-bottom: 100px;">
                        <form class="am-form">
                            <fieldset style="position: relative;">
                                <legend style="color: #d8c5c5">编辑文章</legend>
                                <div class="am-form-group">
                                    <input type="hidden" id="fr-blog-id"  value="{{$info['id']}}" >
                                    <input type="text" placeholder="文章标题(必填)" id="fr-blog-title" maxlength="60" value="{{$info['title']}}" >
                                </div>

                                <div class="am-form-group">
                                    <textarea placeholder="文章摘要(选填)" id="fr-blog-abstract" maxlength="200" >{{$info['describe']}}</textarea>
                                </div>

                                <div class="am-form-group">
                                    <div id="wang-editor" style="min-height:300px;"><?php echo htmlspecialchars_decode($info['content']);?></div>
                                </div>

                                <div class="am-form-group">
                                    <span style="padding-right: 15px;">文章分类</span>
                                    <select id="fr-blog-category" data-am-selected>
                                        @if($category_tree)
                                            @foreach($category_tree as $tree)
                                                <option value="{{$tree['id']}}" @if($info['category_id'] == $tree['id']) selected  @endif ><?php echo $tree['name'];?></option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="am-form-caret"></span>
                                </div>

                                <div class="am-form-group">
                                    <label style="font-weight: 300; ">标签</label>
                                    <input id="fr-blog-tags" type="text" value="{{$info['tag']}}">
                                    <p class="am-form-help">注: 文章标签添加不能大于3个</p>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-radio-inline" style="padding-left: 0;">
                                        是否公开
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="fr-blog-power" value="true" data-am-ucheck checked > 公开
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="fr-blog-power" value="false" data-am-ucheck @if($info['is_overt'] == 2) checked @endif> 私有
                                    </label>
                                </div>

                                <div class="am-form-group">
                                    <label class="am-checkbox-inline">
                                        <input type="checkbox"  name="fr-original" value="" data-am-ucheck  @if(empty($info['reprint_url'])) checked @endif   id="fr-original" > 原创作品<span style="color: #ccc;">(注:若不是原创作品请勿勾选)</span>
                                    </label>
                                </div>

                                <div class="am-form-group fr-url-box" @if(empty($info['reprint_url'])) style="display: none" @endif >
                                    <input type="url" class="" placeholder="原创链接地址" id="fr-blog-link" value="{{$info['reprint_url']}}" >
                                </div>

                                <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

                                <div class="am-form-group">
                                    <div id="fr-imgs-box">
                                        <div onclick="obj.showUploadImgBox()" style="float: left;" >
                                            <img src="/web/images/webuploader.png" style="border: 1px dashed #ccc;cursor: pointer;" >
                                        </div>

                                        <div  class="fr-img-box-list">
                                            @if($info && !empty($info['imgs']))
                                                @foreach(json_decode($info['imgs'],true) as $img)
                                                    <div class="fr-img-box"><img src="{{$img}}">
                                                        <div class="fr-img-box-list-remove" style="display: none;">删除图片</div>
                                                    </div>
                                                @endforeach
                                            @endif


                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div style="clear: both;"> </div>
                                    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>
                                </div>

                                <p>
                               <span style="float: left;">
                                <span style="color: #c6c1c1;">自定义上传封面 (宽高不能小于300)</span>
                               </span>

                                    <span style="float: right;">
                                  <span style="position: relative;cursor: pointer;" class="preview-container-show">
                                    <i class="icon iconfont icon-yanjing preview-container-show" style="position: absolute;top: 0px;font-size: 20px;color: #c6c1c1;"></i>
                                    <span style="display: inline-block;padding-left: 23px;color: #c6c1c1;">在线预览</span>
                                  </span>

                                  <label class="am-checkbox" style="@if($info['status'] == 1 || $info['status'] == 2) display:none; @else display: inline-block;  @endif margin-left:20px;color: #c6c1c1;cursor: pointer;" >
                                    <input type="checkbox" value="1" data-am-ucheck id="fr-blog-draft" >保存草稿
                                  </label>

                                  <button type="button" class="am-btn am-btn-secondary am-radius" style="margin-left: 20px;" onclick="obj.submit()">保存发布</button>
                                </span>
                                </p>

                                <div class="pet_sixin_form_r_nr" >
                                    <div class="pet_sixin_form_r_nr_sj"></div>
                                    <span class="pet-error-text"></span>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <div id="preview-container">
        <div id="preview-container-right">
            <div class="infos" style="width: 100%;">
                <div style="width: 844px;;height: 40px;background: #f7f7f7;position: fixed;top: 0;right: : 0;">
                    <span style="font-size: 20px;color: #a19b9b;line-height: 39px;padding-left: 10px;display: inline-block;float: left;">文章阅览</span>
                    <span style="display: inline-block;float: right;padding-right: 50px;line-height: 39px;">
                        <i class="icon iconfont icon-guanbi1 preview-container-close" style="color: black;cursor: pointer;"></i>
                    </span>
                </div>
                <div class="newsview">
                    <h3 class="news_title" style="padding-top: 25px;padding-bottom: 0px;" id="preview-container-title"></h3>
                    <div class="news_author">
                        <span class="au01"><a href="mailto:dancesmiling@qq.com">XXX</a></span>
                        <span class="au02">XXX-XX-XX</span>
                        <span class="au03">共<b>0</b>人围观</span>
                    </div>
                    <div class="tags" id="preview-container-tags"></div>
                    <div class="news_about">
                        <strong>文章摘要</strong><br>
                        <span id="preview-container-abstract"></span>
                    </div>
                    <div class="news_infos" id="preview-container-conent"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="upload-container">
        <div id="upload-container-left" style="position: relative;">
            <div class="upload-container-title" >
                上传图片  <span > <i class="icon iconfont icon-guanbi1" onclick="obj.hideUploadImgBox()"></i></span>
            </div>

            <div class="upload-container-body">
                <div style="height: 110px;text-align: center;">
                    <div class="upload-container-fr-div" >
                        <i class="icon iconfont icon-shangchuan1" ></i>
                        <form id="form-upload-file" enctype="multipart/form-data">
                            <input type="file"  name="file"  id="upload-container-uploadfile"  />
                        </form>
                    </div>
                    <p style="margin-top: 30px;color: #6490c8">点击此处上传图片(最多只能上传三张)</p>
                </div>

                <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed"/>

                <div id="upload-container-img-box">

                </div>
            </div>
            <div class="upload-container-footer" >
                <span  class="upload-container-error"><i class="icon iconfont icon-iconfontzhizuobiaozhun023132"></i>图片文件大小不能超过5M</span>
                <button type="button" class="am-btn am-btn-secondary" onclick="obj.hideUploadImgBox()">上传完成</button>
            </div>

            <div id="upload-container-tip-box">
                <p><i class="am-icon-spinner am-icon-pulse" style="font-size: 30px;"></i></p>
                <p>图片上传中...</p>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="/plugin/wangEditor/release/wangEditor.min.js"></script>
    <script type="text/javascript" src="/plugin/tagsInput/jquery.tagsinput-revisited.js"></script>
    <script type="text/javascript" src="http://cdn.amazeui.org/amazeui/2.7.2/js/amazeui.min.js"></script>
    <script type="text/javascript">

        var E = window.wangEditor;
        var editor = new E('#wang-editor');
        editor.customConfig.uploadImgServer = '/article/uploadFile';
        editor.customConfig.uploadImgMaxSize = 3 * 1024 * 1024;
        editor.customConfig.uploadImgMaxLength = 3;
        editor.customConfig.showLinkImg = false;
        editor.customConfig.uploadImgHeaders = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        };

        editor.create();

        $('#fr-blog-abstract').keydown(function (e) {
            var key = window.event ? e.keyCode : e.which;
            if (key.toString() == "13") {
                return false;
            }
        }).each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });


        $("#preview-container").click(function (event) {
            var _con = $('#preview-container-right'); // 设置目标区域
            if (!_con.is(event.target) && _con.has(event.target).length == 0) {
                $("#preview-container").fadeOut();
            }
        });

        $('.preview-container-close').click(function (event) {
            $("#preview-container").fadeOut();
        });


        $('.preview-container-show').on('click',function () {
            $('#preview-container-title').text($('#fr-blog-title').val());
            $('#preview-container-abstract').text($('#fr-blog-abstract').val());
            var tags = '';
            $.each($('#fr-blog-tags').val().split(','),function(k,val){
                if(val != ''){tags += '<a>'+val+'</a>';}
            });
            $('#preview-container-tags').html(tags);
            $('#preview-container-conent').html(editor.txt.html());
            $("#preview-container").fadeIn();
        });

        $(document).on('mouseover','.fr-img-box',function(){
            $(this).find('.fr-img-box-list-remove').show();
        }).on('mouseout','.fr-img-box',function(){
            $(this).find('.fr-img-box-list-remove').hide();
        });

        $(document).on('click','.upload-container-img-box span,.fr-img-box-list-remove',function(){
            $(this).parent().remove();
        });

        $(document).on('mouseover','.upload-container-img-box',function(){
            $(this).find('span').show();
        }).on('mouseout','.upload-container-img-box',function(){
            $(this).find('span').hide();
        });

        $('#fr-original').on('click',function(){
            if(!$(this).is(":checked")){
                $('.fr-url-box').show();
            }else{
                $('.fr-url-box').hide();
            }
        });

        $('#fr-blog-tags').tagsInput({
            'onAddTag': function (input, value) {
                console.log('tag added', input, value);
            },
            'onRemoveTag': function (input, value) {
                console.log('tag removed', input, value);
            },
            'onChange': function (input, value) {
                console.log('change triggered', input, value);
            }
        }).attr('placeholder', '添加标签');


        $('#upload-container-uploadfile').on('change',function(){
            if($(this).val() !== ''){
                let maxSize = 3 * 1024 * 1024;
                if($(this)[0].files[0].size > maxSize){
                    $(this).val('');
                    $('.upload-container-error').html('<i class="icon iconfont icon-tubiao-" ></i> 图片文件大小不能超过3M').fadeIn().delay(3000).fadeOut();
                    return;
                }

                var formData = new FormData($('#form-upload-file')[0]);
                $.ajax({
                    url: '/article/uploadFile',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#upload-container-tip-box').fadeIn().fadeOut();
                    },
                    complete: function () {
                        $('#upload-container-tip-box').fadeOut();
                    },
                    success: function (data) {
                        if (data.errno == 0) {
                            obj.appendUploadImgBox(data.data[0]);
                            $('.upload-container-error').html('<i class="icon iconfont icon-tubiao-" ></i> 图片上传成功...').fadeIn().delay(3000).fadeOut();
                        } else {
                            $('.upload-container-error').html('<i class="icon iconfont icon-tubiao-" ></i> 图片上传失败,请稍后再试...').fadeIn().delay(3000).fadeOut();
                        }
                    },
                    error:function(){
                        $('.upload-container-error').html('<i class="icon iconfont icon-tubiao-" ></i> 网络繁忙,请稍后再试...').fadeIn().delay(3000).fadeOut();
                    }
                });
            }
        });

        var obj = {
            showUploadImgBox(){
                $('#upload-container-img-box').html('');

                var _this = this;
                $('.fr-img-box img').each(function(){
                    _this.appendUploadImgBox(this.src);
                });

                $('#upload-container').fadeIn();
            },
            hideUploadImgBox(){
                $('.fr-img-box-list').html('');

                var _this = this;
                $('.upload-container-img-box img').each(function(){
                    _this.appendImgBox(this.src);
                });

                $('#upload-container').fadeOut();
            },
            getData(){
                var imgs = [];
                $('.fr-img-box img').each(function(){imgs.push(this.src);});
                return {
                    id:$('#fr-blog-id').val(),
                    title:$.trim($('#fr-blog-title').val()),
                    describe:$.trim($('#fr-blog-abstract').val()),
                    category:$('#fr-blog-category').val(),
                    tag:$('#fr-blog-tags').val(),
                    imgs:imgs,
                    content:editor.txt.html(),
                    url:$('#fr-blog-link').val(),
                    isDraft:$('#fr-blog-draft').is(":checked"),
                    isOriginal:$('#fr-original').is(":checked"),
                    isOvert:$('input[name="fr-blog-power"]:checked').val()
                };
            },
            submit(){
                var data = this.getData(),_this = this;;
                if(data.title == ''){
                    this.showErorBox('文章标题为必填项');return;
                }else if(data.content == '' || data.content == '<p><br></p>'){
                    this.showErorBox('文章内容不能为空');return;
                }

                $.ajax({
                    url: "/article/create",
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        $('#upload-container-tip-box').fadeIn().fadeOut();
                    },
                    complete: function () {
                        $('#upload-container-tip-box').fadeOut();
                    },
                    success: function (res) {
                        if(res.code == 200){
                            obj.clearFrom();
                            setTimeout(function(){
                                window.location.href = '/user-article';
                            },2000);
                        }

                        _this.showErorBox(res.msg);
                    },
                    error:function(){
                        _this.showErorBox('网络繁忙，请稍后再试...');
                    }
                });
            },
            showErorBox(text){
                $('.pet_sixin_form_r_nr').find('.pet-error-text').text(text);
                $('.pet_sixin_form_r_nr').fadeIn().delay(3000).fadeOut();
            },
            appendImgBox(src){
                let html = `<div  class="fr-img-box"><img src="${src}" ><div class="fr-img-box-list-remove">删除图片</div></div>`;
                $('.fr-img-box-list').append(html);
            },
            appendUploadImgBox(src){
                var html = `<div class="upload-container-img-box"><img src="${src}" ><span ><i class="icon iconfont icon-guanbi1 preview-container-close" ></i></span></div>`;
                $('#upload-container-img-box').append(html);
            },
            clearFrom(){
                $('.fr-img-box').remove();
                $('#fr-blog-title,#fr-blog-abstract,#fr-blog-tags').val('');
                editor.txt.html('<p><br></p>');
            },
        };
    </script>
@endpush