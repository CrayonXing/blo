<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8" />
    <title>New博客 - 文章编辑</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/plugin/editor-md/css/editormd.css" />
    <link rel="stylesheet" href="/plugin/tagsInput/jquery.tagsinput-revisited.css"/>
    <link rel="stylesheet" href="/web/css/markdown-edit-page.css"/>
</head>
<body>
<div id="layout">
    <div class="medit-header">
        <div class="medit-header-son medit-header-lson" >
            <input type="hidden" id="fr-input-id" value="{{@$info->id}}">
            <input type="text" id="fr-input-title" placeholder="请输入文章标题(必填)"  value="{{@$info->title}}">
            <input type="text" id="fr-input-describe" placeholder="文章摘要(可选)" value="{{@$info->describe}}" >
            <input id="fr-blog-tags" type="text" value="{{@$info->tag}}">
        </div>
        <div class="medit-header-son">
            <div class="son-left-box">
                <img src="{{@$info->img}}" onerror="this.src='/web/images/xitongempty.png'" id="artcle-img" >
                <form id="form-upload-file" enctype="multipart/form-data">
                    <p>
                        <span style="">文章宣传图(点击上传)</span>
                        <input type="file" name="file-img" id="upload-container-input" >
                    </p>
                </form>
            </div>
            <div class="son-right-box">
                <div >
                    <span class="left-tilte">文章栏目:</span>
                    <p class="artcle-type-box" style="cursor: pointer" id="fr-choice-category" data-cid="{{@$info->category_id}}" >
                        @if($info)
                                @foreach($categoryInfos as $category2)
                                    @if($category2['id'] == $info->category_id)
                                    {{$category2['name']}}
                                    @endif
                                @endforeach
                            @else
                            请选择文章所在栏目(必选)
                        @endif
                    </p>
                    <div class="category-box">
                        @foreach($categoryInfos as $category)
                            <p data-id="{{$category['id']}}" >{{$category['name']}}</p>
                        @endforeach
                    </div>
                </div>

                <div >
                    <span class="left-tilte">原文链接:</span>
                    <input type="text" placeholder="原文链接(可选)" id="original-text-link" value="{{@$info->reprint_url}}" >
                </div>

                <div >
                    <span class="left-tilte">是否公开:</span>
                    <p class="artcle-type-box">
                        <span class="artcle-type-btn artcle-type-active" data-val="1" >公开</span>
                        <span class="artcle-type-btn" data-val="2">私有</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="test-editormd">
                <textarea style="display:none;">{{@$info->markdown_content}}</textarea>
    </div>
</div>

<div style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;background-color:rgb(103,100,100,.8);z-index: 9999999999999;display: none;" id="uplod-mask-box">
    <div style="width: 300px;height: 50px;background-color: #d7d7d7;margin-left: calc(50% - 150px);margin-top: 250px;line-height: 50px;text-align: center;color: green;" id="uplod-mask-tips">
        图片上传中,请耐心等待...
    </div>
</div>



<script src="/web/js/jquery-2.1.1.min.js"></script>
<script src="/plugin/editor-md/editormd.min.js"></script>
<script type="text/javascript" src="/plugin/tagsInput/jquery.tagsinput-revisited.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
    var clientHeight = 130;
    var testEditor = editormd("test-editormd", {
            width        : "100%",
            height       : document.documentElement.clientHeight - clientHeight,

            theme        : (localStorage.theme) ? localStorage.theme : "dark",
            previewTheme : (localStorage.previewTheme) ? localStorage.previewTheme : "dark",
            editorTheme  : (localStorage.editorTheme) ? localStorage.editorTheme : "pastel-on-dark",
            path    : "/plugin/editor-md/lib/",
            saveHTMLToTextarea : true,

            imageUpload : true,
            imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "/uoload/upload-img?_token="+$('meta[name="csrf-token"]').attr('content'),

            toolbarIcons : function() {
                return ["undo", "redo",'bold','del','italic','hr','link','image','code','preformatted-text','code-block','table','watch','fullscreen','clear','search','|','articleSave','articleRelease']
            },
            toolbarIconTexts : {
                articleSave : "<i class=\"fa fa-floppy-o\"></i> 保存",  // 指定一个FontAawsome的图标类
                articleRelease : "<i class=\"fa fa-mail-forward\"></i> 立即发布"  // 指定一个FontAawsome的图标类
            },

            // 自定义工具栏按钮的事件处理
            toolbarHandlers : {
                /**
                 * @param {Object}      cm         CodeMirror对象
                 * @param {Object}      icon       图标按钮jQuery元素对象
                 * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                 * @param {String}      selection  编辑器选中的文本
                 */
                articleSave : function(cm, icon, cursor, selection) {
                    pageObj.operate('articleSave');
                },

                articleRelease : function(cm, icon, cursor, selection) {
                    pageObj.operate('articleRelease');
                }
            }
        });

        var pageObj = {
            operate:function (name) {
                let data = this.getData();

                //文章保存方式
                data.saveMode = name;
                $.ajax({
                    url: "/article/create",
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        $('#uplod-mask-box').show();
                        if(data.saveMode == 'articleSave'){
                            $('#uplod-mask-tips').text('文章正在保存,请耐心等待...').css('color','#585858');
                        }else{
                            $('#uplod-mask-tips').text('文章正在发布中,请耐心等待...').css('color','#585858');
                        }
                    },
                    success: function (res) {
                        if(res.code == 200){
                            $('#fr-input-id').val(res.data.id);
                            if(data.saveMode == 'articleSave'){
                                $('#uplod-mask-tips').text('文章保存成功...').css('color','#349834');
                            }else{
                                $('#uplod-mask-tips').text('文章发布成功...').css('color','#349834');
                            }
                        } else {
                            if(data.saveMode == 'articleSave'){
                                $('#uplod-mask-tips').text('文章保存失败,请稍后再试...').css('color','#ff543d');
                            }else{
                                $('#uplod-mask-tips').text('文章发布失败,请稍后再试...').css('color','#ff543d');
                            }
                        }

                        $('#uplod-mask-box').delay(1000).fadeOut();
                    },
                    error:function(){
                        $('#uplod-mask-tips').text('网络繁忙,请稍后再试...').css('color','#ff543d');
                        $('#uplod-mask-box').delay(1000).fadeOut();
                    }
                });
            },
            
            getData:function () {
                let data = {
                    id:$('#fr-input-id').val() || 0,
                    cid:$('#fr-choice-category').data('cid') || 0,
                    title:$.trim($('#fr-input-title').val()),
                    describe:$.trim($('#fr-input-describe').val()),
                    tags:$('#fr-blog-tags').val(),
                    img:$('#artcle-img').attr('src'),
                    isOvert:$('.artcle-type-active').data('val') || 1,
                    link:$('#original-text-link').val(),
                    markdownContent:testEditor.getMarkdown(),// 获取 Markdown 源码
                    htmlContent:testEditor.getHTML(),// 获取 Textarea 保存的 HTML 源码
                };

                if(data.img == '/web/images/xitongempty.png'){
                    data.img = '';
                }

                return data;
            }
        };

        $('#fr-blog-tags').tagsInput({
            'onAddTag': function (input, value) {
                // console.log('tag added', input, value);
            },
            'onRemoveTag': function (input, value) {
                // console.log('tag removed', input, value);
            },
            'onChange': function (input, value) {
                // console.log('change triggered', input, value);
            }
        });

        $('.tag-input').attr('placeholder', '设置文章标签(回车确定)');


    $('#upload-container-input').on('change',function(){
        if($(this).val() !== ''){
            let maxSize = 1 * 1024 * 1024;
            if($(this)[0].files[0].size > maxSize){
                $(this).val('');
                alert('图片文件大小不能超过1M');
                return;
            }

            var formData = new FormData($('#form-upload-file')[0]);
            $.ajax({
                url: '/uoload/upload-img',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function () {
                    $('#uplod-mask-box').show();
                    $('#uplod-mask-tips').text('图片上传中,请耐心等待...').css('color','#585858');
                },
                success: function (data) {
                    if (data.success == 1) {
                        $('#artcle-img').attr('src',data.url);
                        $('#uplod-mask-tips').text('图片上传成功...').css('color','#349834');
                    } else {
                        $('#uplod-mask-tips').text('图片上传失败,请稍后再试...').css('color','#ff543d');
                    }

                    $('#uplod-mask-box').delay(1000).fadeOut();
                },
                error:function(){
                    $('#uplod-mask-tips').text('网络繁忙,请稍后再试...').css('color','#ff543d');
                    $('#uplod-mask-box').delay(1000).fadeOut();
                }
            });
        }
    });

    $('.artcle-type-box .artcle-type-btn').on('click',function () {
        $(this).addClass('artcle-type-active');
        $(this).siblings().removeClass('artcle-type-active');
    });

    $('#fr-choice-category').on('click',function () {
        $('.category-box').css('left',$(this).offset().left + 'px').show();
    });

    $('.category-box p').on('click',function () {
        $('#fr-choice-category').data('cid',$(this).data('id')).text($(this).text());
        $('.category-box').hide();
    });

    $(document).on("click", function (e) {
        var target = $(e.target);
        if(!target.closest("#fr-choice-category").length){
            if (target.closest(".category-box").length == 0) {
                $('.category-box').hide();
            }
        }
    });
</script>
</body>
</html>