layui.extend({
    larryms: "lib/larryms"
}).define(["jquery", "configure", "layer", "larryms"], function(e) {
    "use strict";
    var d = layui.$,
        o = layui.configure,
        s = layui.layer,
        c = layui.device(),
        r = d(window),
        u = layui.larryms;
    var i = new Function;
    var l = {
        forms: "larry/modules/forms",
        cascade: "larry/modules/cascade",
        larryms: "lib/larryms",
        larryElem: "lib/larryElem",
        larryEditor: "lib/larryEditor",
        larryTree: "lib/larryTree",
        webuploader: "lib/extend/webuploader/webuploader",
        face: "lib/face",
        xss: "lib/xss",
        wangEditor: "lib/extend/we/wangEditor",
        echarts: "lib/extend/echarts",
        echartStyle: "lib/extend/echartStyle",
        md5: "lib/extend/md5",
        base64: "lib/extend/base64",
        fullPage: "lib/extend/fullPage",
        geetest: "lib/extend/geetest",
        classie: "lib/extend/classie",
        snapsvg: "lib/extend/svg/snapsvg",
        svgLoader: "lib/extend/svg/svgLoader",
        clipboard: "lib/extend/clipboard",
        swiper: "lib/extend/swiper/swiper",
        ckplayer: "lib/extend/ckplayer/ckplayer",
        countup: "lib/extend/countup",
        qrcode: "lib/extend/qrcode",
        flash: "lib/extend/video/flash",
        EvEmitter: "lib/extend/EvEmitter",
        imagesloaded: "lib/extend/imagesloaded",
        jqui: "lib/extend/jqueryui/jqui",
        ztree: "lib/extend/ztree/ztree",
        ztreeCheck: "lib/extend/ztree/ztreeCheck",
        ztreeExedit: "lib/extend/ztree/ztreeExedit",
        ztreeExhide: "lib/extend/ztree/ztreeExhide",
        ueconfig: "lib/extend/ueditor/ueconfig",
        neconfig: "lib/extend/neditor/neconfig",
        nebase: "lib/extend/neditor/nebase",
        ueditor: "lib/extend/ueditor/ueditor",
        neditor: "lib/extend/neditor/neditor",
        pdfobject: "lib/extend/pdfobject",
        coords: "lib/extend/gridster/coords",
        collision: "lib/extend/gridster/collision",
        fullpages: "lib/extend/fullpage/fullpages",
        cropper: "lib/extend/cropper",
        tinymce: "lib/extend/tinymce/tinymce",
        ckeditor: "lib/extend/ckeditor/ckeditor",
        masonry: "lib/extend/masonry",
        modernizr: "lib/modernizr"
    };

    i.prototype.modules = function() {
        for (var e in l) {
            layui.modules[e] = l[e]
        }
    }();

    window.larrymsExtend = true;
    layui.cache.extendStyle = o.basePath + "lib/extendStyle/";

    function b() {
        var e = r.width();
        if (e >= 1200) {
            return 3
        } else if (e >= 992) {
            return 2
        } else if (e >= 768) {
            return 1
        } else {
            return 0
        }
    }


    i.prototype.init = function() {
        if (o.browserCheck) {
            if (c.ie && c.ie < 8) {
                s.alert("本系统最低支持ie8，您当前使用的是古老的 IE" + c.ie + " \n 建议使用IE9及以上版本的现代浏览器", {
                    title: u.tit[0],
                    skin: "larry-debug",
                    icon: 2,
                    resize: false,
                    zIndex: s.zIndex,
                    anim: Math.ceil(Math.random() * 6)
                })
            }
            if (c.ie) {
                d("body").addClass("larryms-ie-hack")
            }
        }

        u.screen = b();
        if (o.fontSet) {
            if (o.font !== "larry-icon") {
                layui.link(layui.cache.base + "css/fonts/larry-icon.css")
            }
            u.fontset({
                font: o.font,
                url: o.fontUrl,
                online: o.fontSet
            })
        } else {
            layui.link(layui.cache.base + "css/fonts/larry-icon.css")
        }
    }();

    window.onresize = function() {
        u.screen = b()
    };

    e("larry", {})
});