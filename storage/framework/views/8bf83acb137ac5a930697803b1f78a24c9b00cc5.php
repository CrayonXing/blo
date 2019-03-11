<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="/plugin/Swiper/swiper.min.css">

    <article>
      <div class="blogs" style="min-height: 850px;">
          <div class="swiper-container"style="margin-top: -15px;margin-bottom: 10px;height: 400px;">
              <div class="swiper-wrapper">
                  <div class="swiper-slide"><img src="/web/images/background/a1bf0590d6002d63f4f183e7cff1b24.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/background/8cbd5322e2ee97ddf8dc6e8fc95206a.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/background/24d48da79e27b326b6b69d8bf3a70a6.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/background/848c8bd0b677b9b89cbacbceb86f330.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/background/61855be530e14b35d7c939c2283f22f.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/background/a85cd35b138a6d18d58e5d4b2b80dbe.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/background/afedcb676a157749fc0f8b81e6095f8.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/web/images/background/sdfgldfaa35ds1s35gf51d51a.jpg" style="width: 100%;height: 100%" /></div>
              </div>
              <div class="swiper-pagination"></div>
          </div>
          <div id="blog-list-container"></div>
          <div id="blog-list-paging">
               <i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...
          </div>
      </div>
      <div class="sidebar" >
            <?php echo $__env->make('web.article.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="/plugin/Swiper//swiper.min.js"></script>
  <script src="/plugin/template-web.js"></script>
  <?php echo $__env->make('web.template.tpl-blog-list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script>
        new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
            },
            autoplay: {
                delay: 6000
            },
        });
    </script>
<script type="text/javascript">
    var o = {
        pagingShow:function(type){
            if(type == 0){
                $('#blog-list-paging').html('<i class="iconfont icon-xia"></i> 加载下一页 ').css('color','rgb(128, 120, 120)');
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
                      };
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
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layouts.blog-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>