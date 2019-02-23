<?php $__env->startSection('content'); ?>

<!-- <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
  <ul class="am-slides">
    <li><img src="/web/images/cus-bg.jpg" style="max-height: 800px;" /></li>
    <li><img src="https://up.enterdesk.com/edpic_source/53/f4/40/53f440313e932a14b768fc3130feb5ea.jpg" style="max-height: 800px;" /></li>
	<li><img src="https://up.enterdesk.com/edpic_source/e2/e4/71/e2e471f0be50030be1c23e7693909276.jpg" style="max-height: 800px;" /></li>
	<li><img src="https://up.enterdesk.com/edpic_source/73/01/3b/73013b1c9c41e0648c93ed82aa9c5eb3.jpg" style="max-height: 800px;" /></li>
  </ul>
</div> -->


<article>
  <div class="blogs">
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
<div class="blank"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="/plugin/template-web.js"></script>
  <?php echo $__env->make('web.template.tpl-blog-list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    var o = {
        pagingShow:function(type){
            if(type == 0){
                $('#blog-list-paging').html('<i class="iconfont icon-xia"></i> 加载下一页 ');
            }else if(type == 1){
                $('#blog-list-paging').html('<i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...');
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
                      if(res.code == 200 && res.data.rows.length > 0){
                          $('#blog-list-container').append(template("tpl-blog-list",{rows:res.data.rows}));
                            if(res.data.page == res.data.page_total){
                              o.pagingShow(2);
                              console.log('已加载全部');
                              o.loading = true;
                          }else{
                            o.pagingShow(0);
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