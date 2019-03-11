<?php $__env->startSection('content'); ?>


<article>
      <?php echo $__env->make('web.layouts.web-main-left', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <div class="web-main-right">
            <div class="web-main-breadcrumb">
                 <p><a>会员中心</a> <span>/</span> <a>我的文章</a></p>
            </div>
            <div class="web-main-content" style="padding: 10px 10px 100px 10px;">
                  <div class="web-main-article">
                      <div class="web-main-article-category">
                          <div class="am-g">
                              <div class="am-u-sm-1" style="padding: 0;text-align: right">文章分类</div>
                              <div class="am-u-sm-11" style="padding-left: 0">
                                  <span class="web-main-article-category-current" data-category="0">全部</span>
                                  <?php if($list): ?>
                                      <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <span data-category="<?php echo e($row['id']); ?>"><?php echo e($row['name']); ?></span>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

                  <div class="web-main-article-list-container">
                        <div class="web-main-article-container-box">

                        </div>
                        <div class="web-main-article-list web-main-article-loading" style="text-align: center;cursor: pointer;" onclick="o.loadListData()">
                            <i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...
                        </div>
                  </div>
            </div>
      </div>
</article>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="/plugin/template-web.js"></script>

  <script id="tpl-bloglist-user" type="text/html">
      {{each rows as v index}}
          <div class="web-main-article-list animated {{if index%2 }} fadeInLeft {{ else}} fadeInRight {{/if}}" style="position: relative"  >
              <h6><a href="/article/details/aid/{{v.id}}">{{v.title}}</a></h6>

              {{if v.describe }}
                  <p>{{v.describe}}</p>
              {{/if}}

              <div class="web-main-article-list-footer">
                  {{if v.tag }}
                    <span class="list-footer-left">
                      <i class="iconfont icon-icontag" ></i>
                        <span style="display: inline-block">
                            {{each v.tag as tag index2}}
                            <a href="/"  target="_blank">{{tag}}</a>
                            {{/each}}
                        </span>
                    </span>
                  {{/if}}

                    <span class="list-footer-left">
                        <i class="iconfont icon-linedesign-04" ></i><span >{{v.created_time}}</span>
                    </span>

                    <span class="list-footer-left">
                       <i class="iconfont icon-yanjing"></i><span >浏览（{{v.visits}}）</span>
                    </span>

                  <span class="list-footer-right">
                      <a href="/article/details/aid/{{v.id}}">阅读原文</a>
                      <a href="/user-article-edit?aid={{v.id}}">编辑原文</a>
                  </span>
              </div>

              <div class="web-main-article-list-status">
                  {{v.status}}
              </div>
              <div class="clear"></div>
          </div>
      {{/each}}
  </script>


  <script type="text/javascript">
      var o = {
          pagingShow:function(type){
              if(type == 0){
                  $('.web-main-article-loading').html('<i class="iconfont icon-xia"></i> 加载下一页 ').css('color','rgb(128, 120, 120)');
              }else if(type == 1){
                  $('.web-main-article-loading').html('<i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...').css('color','#fc9d9a');
              }else{
                  $('.web-main-article-loading').html('已加载全部').css('color','#ccc');
              }
          },
          loading:false,
          page:0,
          page_size:10,
          category:'all',
          loadListData:function(){
              if(this.loading == false){
                  o.page++;
                  $.ajax({
                      url: "/user-article-list",
                      type: 'get',
                      data: {page:o.page,page_size:o.page_size,category:o.category},
                      dataType: 'json',
                      beforeSend: function () {
                          o.pagingShow(1);
                          o.loading = true;
                      },
                      success: function (res) {
                          o.loading = false;
                          if(res.code == 200){
                              if(res.data.category == o.category){
                                  $('.web-main-article-container-box').append(template("tpl-bloglist-user",{rows:res.data.rows}));
                                  if(res.data.page == res.data.page_total || res.data.rows.length  == 0){
                                      o.pagingShow(2);
                                      o.loading = true;
                                  }else{
                                      o.pagingShow(0);
                                  }
                              }
                          }
                      },
                      error:function(){
                          o.pagingShow(0);
                      }
                  });
              }
              return this;
          },
      };

      o.loadListData();
      $('.web-main-article-category  span').on('click',function(){
          if(!$(this).hasClass('web-main-article-category-current')){
              $(this).addClass('web-main-article-category-current').siblings().removeClass('web-main-article-category-current');
              $('.web-main-article-container-box').html('');
              o.loading = false;
              o.page = 0;
              o.category = $(this).data('category');
              o.loadListData();
          }
      });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layouts.blog-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>