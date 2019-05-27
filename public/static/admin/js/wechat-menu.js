/**
 * 微信菜单操作对象
 * @constructor
 */
function Menu(menuJsonStr){

    this.menuJsonStr = JSON.parse(menuJsonStr);

    /**
     * 初始化设置菜单
     */
    this.init = function(){
        var _this = this;
        if(this.menuJsonStr.button && Array.isArray(this.menuJsonStr.button)){
            $.each(this.menuJsonStr.button,function(key,val){
                $('#menu-list .menu-item').find('.sub-menu-box').hide();
                $('#add-item').before(_this.getItemHtml(val));
                if(val.sub_button.length > 0){
                    $.each(val.sub_button,function(key2,val2){
                        $('#menu-list .menu-item').eq(key).find('.add-sub-item').before(_this.getSubItemHtml(val2));
                    });
                }
            });

            $('#menu-list').find('.select-item').removeClass('select-item');
        }

        this.bindEvent();
    };

    /**
     *  包装一级菜单
     */
    this.getItemHtml = function (ops){
        ops = $.extend({},{type: "click",name: "添加菜单",key: "key|no",url:'',appid:'',pagepath:''}, ops);
        return `<li class="menu-item select-item" data-type="${ops.type}" data-key="${ops.key}" data-name="${ops.name}" data-url="${ops.url}"  data-appid="${ops.appid}" data-pagepath="${ops.pagepath}"><a href="javascript:;" class="menu-link"><i class="icon-menu-dot"></i><i class="weixin-icon sort-gray"></i><span class="title">${ops.name}</span></a><div class="sub-menu-box" style="display: block;"><ul class="sub-menu-list"><li class="add-sub-item"><a href="javascript:;" title="添加子菜单"><span class=""><i class="weixin-icon add-gray"></i></span></a></li></ul><i class="arrow arrow-out"></i><i class="arrow arrow-in"></i></div></li>`;
    };

    /**
     * 包装二级子菜单
     */
    this.getSubItemHtml = function (ops){
        ops = $.extend({},{type: "click",name: "添加子菜单",key: "key|no",url:'',appid:'',pagepath:''}, ops);
        return `<li class="sub-menu-item select-item" data-type="${ops.type}" data-key="${ops.key}" data-name="${ops.name}" data-url="${ops.url}" data-appid="${ops.appid}" data-pagepath="${ops.pagepath}"><a href="javascript:;"><span class=""><i class="weixin-icon sort-gray"></i><span class="sub-title">${ops.name}</span></span></a></li>`;
    };

    /**
     * 设置编辑区域
     */
    this.setEditArea = function (type,el){
        if(type == 'sub-menu-item'){
            $('.cus-menu-box').removeClass('hidden');
        }else{
            if(el.find('.sub-menu-item').length > 0){
                $('.cus-menu-box').addClass('hidden');
            }else{
                $('.cus-menu-box').removeClass('hidden');
            }
        }

        var data = this.getMenuVal(el);

        $("input[type=radio][name=type][value='" + data.type + "']").prop("checked", "checked").trigger('click');
        $('#fr-menu-name').val(data.name);
        $("#fr-menu-url,#fr-menu-url2").val(data.url);
        $("#fr-menu-appid").val(data.appid);
        $("#fr-menu-pagepath").val(data.pagepath);
    };

    /**
     * 设置选中的资源值
     * @param str
     */
    this.setKeyVal = function(key){
        var el = $('.select-item');
        if(el.length > 0){
            el.data('key',key);
            return true;
        }

        return false;
    }

    /**
     * 获取菜单对象数据
     * @param el
     * @returns {{type: *, name: *, key: *, url: *, appid: *, pagepath: *}}
     */
    this.getMenuVal = function(el){
        return {type: el.data('type') || '',name: el.data('name') || '',key: el.data('key') || '',url:el.data('url') || '',appid:el.data('appid') || '',pagepath:el.data('pagepath') || ''};
    };

    /**
     * 包装一级菜单json数据
     * @param el
     * @returns {*}
     */
    this.getItemJson = function(el){
        let data = this.getMenuVal(el)
        if(data.type == 'click'){
            return  {type: data.type,name: data.name,key: data.key,sub_button: []};
        }else if(data.type == 'view'){
            return  {type: data.type,name: data.name,url: data.url,sub_button: []};
        }else if(data.type == 'miniprogram'){
            return  {type:data.type,name: data.name,url: data.url,appid:data.appid,pagepath:data.pagepath,sub_button: []};
        }

        return {};
    };

    /**
     * 获取当前选中的菜单数据信息
     * @returns {{index: {menuItemIndex: number, subMenuItemIndex: number, subMenuItemNum: number}, data: *}}
     */
    this.getSelectionData = function(){
        var el = $('.select-item'),data = {menuItemIndex:0,subMenuItemIndex:0,subMenuItemNum:0,itemType:""};
        if(el.length >0 && el.hasClass('menu-item')){
            data.menuItemIndex = el.index();
            data.subMenuItemNum = el.find('.sub-menu-item').length;
            data.itemType = 'menu-item';
        }else if(el.length >0 && el.hasClass('sub-menu-item')){
            data.menuItemIndex = el.parent().parent().parent().index();
            data.subMenuItemIndex = el.index();
            data.subMenuItemNum = el.find('.sub-menu-item').length;
            data.itemType = 'sub-menu-item';
        }

        return {index:data,data:this.getMenuVal(el)};
    }

    /**
     * 获取发布的json数据
     */
    this.getReleaseData = function(){
        var _this = this,menuJson = {button:[]};
        $('.menu-item').each(function(index){
            var currentMenuItem  =  $('.menu-item').eq(index),subMenuItem =  currentMenuItem.find('.sub-menu-item');
            if(subMenuItem.length > 0){
                var  subMenuItemArr = [];
                subMenuItem.each(function(index2){
                    subMenuItemArr.push(_this.getItemJson(subMenuItem.eq(index2)));
                });
                menuJson.button.push({name: currentMenuItem.data('name') || '',sub_button:subMenuItemArr});
            }else{
                menuJson.button.push(_this.getItemJson(currentMenuItem));
            }
        });
        return menuJson;
    };

    this.bindEvent = function(){
        //添加一级菜单
        $(document).on('click','#add-item',function(event){
            $('#menu-list .menu-item').removeClass('select-item').find('.sub-menu-box').hide();

            $('.cus-menu-box').removeClass('hidden');
            $('#add-item').before(menuObj.getItemHtml());
            $('.select-item').trigger('click');

            event.stopPropagation();
        });

        //添加二级菜单
        $(document).on('click','.add-sub-item',function(event){
            if($(this).parent().find('.sub-menu-item').length < 5){
                $(this).parent().find('.sub-menu-item').removeClass('select-item');
                $(this).before(menuObj.getSubItemHtml());
            }else{
                alert('最多只能添加5个子菜单');
            }

            $('#menu-list .menu-item').removeClass('select-item');
            $('.select-item').trigger('click');
            event.stopPropagation();
        });

        //一级菜单点击
        $(document).on('click','.menu-item',function(){
            $('.sub-menu-item').removeClass('select-item');
            $(this).addClass('select-item').find('.sub-menu-box').show();
            $(this).siblings().removeClass('select-item').find('.sub-menu-box').hide();

            menuObj.setEditArea('menu-item',$(this));
            event.stopPropagation();    //  阻止事件冒泡
        });

        //二级子菜单点击
        $(document).on('click','.sub-menu-item',function(event){
            $(this).addClass('select-item').siblings().removeClass('select-item');

            menuObj.setEditArea('sub-menu-item',$(this));
            $('#menu-list .menu-item').removeClass('select-item');
            event.stopPropagation();    //  阻止事件冒泡
        });

        $('#fr-submit').on('click',function(){
            menuObj.saveRelease();
        });

        $('#fr-remove').on('click',function(){
            $('.select-item').remove();

            $('.my-box').hide();
            $('.form-horizontal').find('.form-control').val('');
        });

        $("input[name='type']:radio").bind('change click',function(){
            var type = $(this).val();
            $('.my-box').hide();
            if(type == 'view'){
                $('.my-box-type2').show();
            }else if(type == 'miniprogram'){
                $('.my-box-type1').show();
            }else{
                $('.my-box-type3').show();
            }

            $('.select-item').data('type',type);
        });

        $('#fr-menu-name').on('input',function(){
            let name = $.trim($(this).val());
            if($('.select-item').hasClass('menu-item')){
                $('.select-item').data('name',name).find('.title').text(name);
            }else{
                $('.select-item').data('name',name).find('.sub-title').text(name);
            }
        });

        $('#fr-menu-url').bind('change input',function(){
            $('.select-item').data('url',$(this).val());
        });

        $('#fr-menu-resources').on('click',function(){
            // alert('此功能暂未开放');
        });
    };

    this.init();
}