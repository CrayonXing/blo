$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var clientHeight = 130;
var editorObj = editormd("container-editormd", {
    width        : "100%",
    height       : document.documentElement.clientHeight - clientHeight,
    theme        : (localStorage.theme) ? localStorage.theme : "dark",
    previewTheme : (localStorage.previewTheme) ? localStorage.previewTheme : "dark",
    editorTheme  : (localStorage.editorTheme) ? localStorage.editorTheme : "pastel-on-dark",
    path    : "/plugin/editor-md/lib/",
    saveHTMLToTextarea : true,

    imageUpload : true,
    imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
    imageUploadURL : "/upload/upload-img?_token="+$('meta[name="csrf-token"]').attr('content'),

    toolbarIcons : function() {
        return ["undo", "redo",'bold','del','italic','hr','link','image','code','preformatted-text','code-block','table','watch','fullscreen','clear','search','|','articleSave','articleRelease']
    },
    toolbarIconTexts : {
        articleSave : "<i class=\"fa fa-floppy-o\"></i> 保存",  // 指定一个FontAawsome的图标类
        articleRelease : "<i class=\"fa fa-mail-forward\"></i> 发布更新"  // 指定一个FontAawsome的图标类
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
    },

    onload : function() {
        // let keyMap = {
        //     "Ctrl-S": function(cm) {
        //         // pageObj.operate('articleSave');
        //     }
        // };
        //
        // this.addKeyMap(keyMap);
    }
});

var pageObj = {
    lock:false,
    operate:function (name) {
        let data = this.getData(),_this = this;

        //文章保存方式
        data.saveMode = name;

        if(data.title == ''){
            this.showTipBox(2,'文章标题不能为空...');return;
        }

        if(data.cid == 0){
            this.showTipBox(2,'请选择文章所在栏目...');return;
        }
        if(this.lock){
            return;
        }
        $.ajax({
            url: "/article/create",
            type: 'post',
            data: data,
            dataType: 'json',
            beforeSend: function () {
                _this.lock = true;
                if(data.saveMode == 'articleSave'){
                    _this.showTipBox(1,'文章正在保存,请耐心等待...');
                }else{
                    _this.showTipBox(1,'文章正在发布中,请耐心等待...');
                }
            },
            complete:function(){
                _this.lock = false;
            },
            success: function (res) {
                if(res.code == 200){
                    $('#fr-input-id').val(res.data.id);
                    if(data.saveMode == 'articleSave'){
                        _this.showTipBox(1,'文章保存成功...');
                    }else{
                        _this.showTipBox(1,'文章发布成功...');
                    }
                } else {
                    if(data.saveMode == 'articleSave'){
                        _this.showTipBox(2,'文章保存失败,请稍后再试...');
                    }else{
                        _this.showTipBox(2,'文章发布失败,请稍后再试...');
                    }
                }
            },
            error:function(){
                _this.showTipBox(2,'网络繁忙,请稍后再试...');
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
            markdownContent:editorObj.getMarkdown(),// 获取 Markdown 源码
            htmlContent:editorObj.getHTML(),// 获取 Textarea 保存的 HTML 源码
        };

        if(data.img == '/static/web/images/xitongempty.png'){
            data.img = '';
        }

        return data;
    },

    //显示提示信息
    showTipBox:function(type,title){
        $('#editormd-error-box').find('.editormd-error-tip').text(title);

        let colorClass = (type == 1) ? 'editormd-error-green': 'editormd-error-red';

        $('#editormd-error-box').removeClass('editormd-error-green').removeClass('editormd-error-red').removeClass('fadeOutUp').addClass(colorClass).addClass('fadeInDown').show();
        setTimeout(function () {
            pageObj.hideTipBox();
        },5000);
    },

    //隐藏提示信息
    hideTipBox:function () {
        $('#editormd-error-box').removeClass('fadeInDown').addClass('fadeOutUp');
    }
};

$('#fr-blog-tags').tagsInput({
    'onAddTag': function (input, value) {},
    'onRemoveTag': function (input, value) {},
    'onChange': function (input, value) {}
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
            url: '/upload/upload-img',
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

//点击空白出隐藏分类选择框
$(document).on("click", function (e) {
    var target = $(e.target);
    if(!target.closest("#fr-choice-category").length){
        if (target.closest(".category-box").length == 0) {
            $('.category-box').hide();
        }
    }
});


$(document).keydown(function(e){
    var currKey=0,
    currKey = e.keyCode||e.which||e.charCode;

    //监听Ctrl-S 键盘组合键事件
    if(currKey == 83 && (e.ctrlKey||e.metaKey)){
        $("i[name$='articleSave']").parent().addClass('bg-huibai');
        setTimeout(function () {
            $("i[name$='articleSave']").parent().removeClass('bg-huibai');
        },1000);
        pageObj.operate('articleSave');return false;
    }
});