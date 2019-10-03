new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    paginationClickable: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    parallax: true,
    speed: 600,
});


var o = {
    pagingShow:function(type){
        if(type == 0){
            $('#blog-list-paging').html('<i class="iconfont icon-xia"></i> 加载更多... ').css('color','rgb(128, 120, 120)');
        }else if(type == 1){
            $('#blog-list-paging').html('<i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...').css('color','rgb(128, 120, 120)');
        }else{
            $('#blog-list-paging').html('已加载全部').css('color','#ccc');
        }
    },
    loading:false,
    page:0,
    page_size:20,
    loadListData:function(){
        if(this.loading == false){
            o.page++;
            $.ajax({
                url: "/article/search",
                type: 'get',
                data: {page:o.page,page_size:o.page_size},
                dataType: 'json',
                beforeSend: function () {
                    o.pagingShow(1);
                    o.loading = true;
                },
                success: function (res) {
                    o.loading = false;
                    if(res.code == 200){
                        if(res.data.rows.length > 0){
                            $('#blog-list-container').append(template("tpl-blog-list",{rows:res.data.rows}));
                            if(res.data.page == res.data.page_total){
                                o.pagingShow(2);
                                o.loading = true;
                            }else{
                                o.pagingShow(0);
                            }
                        }else{
                            o.pagingShow(2);
                        }
                    }
                },
                error:function(){
                    o.pagingShow(0);
                }
            });
        }
        return this;
    }
};

setTimeout(function(){
    o.loadListData();
},1000);

$('#blog-list-paging').on('click',function(){
    o.loadListData();
});

$(function () {
    $('html,body').animate({ scrollTop: 0 }, 700);
})
