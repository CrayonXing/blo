<?php $__env->startSection('content'); ?>


<article>
      <?php echo $__env->make('web.layouts.web-main-left', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <div class="web-main-right">
            <div class="web-main-breadcrumb">
                 <p><a>会员中心</a> <span>/</span> <a>我的文章</a></p>
            </div>
            <div class="web-main-content" style="padding: 10px;">
                  <div class="web-main-article">
                      <div class="web-main-article-category">
                          文章分类
                          <span class="web-main-article-category-current">全部</span>  
                          <span>PHP</span>  
                          <span>Swoole</span> 
                          <span>Redis</span> 
                          <span>Vue</span> 
                          <span>Web</span> 
                          <span>问答</span> 
                          <span>IT趣事</span>
                          <span>其它</span>
                      </div>
                  </div>
                  <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

                  <div class="web-main-article-list-container">
                        <div class="web-main-article-list" >
                            <h6 >[ Laravel 5.7 文档 ] 前端开发 —— Blade 模板引擎</h6>
                            <p>置了一个中间件来验证用户是否经过认证（如登录），如果用户没有经过认证。</p>
                            <div class="web-main-article-list-footer">
                                <span class="list-footer-left">
                                  <i class="iconfont icon-icontag" ></i> 
                                  <span >
                                    <a href="">Laravel</a> <a href="">PHP</a> <a href="">Swoole</a>
                                  </span> 
                                </span>

                                <span class="list-footer-left">
                                    <i class="iconfont icon-linedesign-04" ></i><span >2018-02-08</span> 
                                </span>

                                <span class="list-footer-left">
                                   <i class="iconfont icon-yanjing"></i><span >浏览（0）</span> 
                                </span>

                                <span class="list-footer-right"><a href="" >查看详情</a></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                  </div>

                  <div class="web-main-article-list-container">
                        <div class="web-main-article-list" >
                            <h6 >【PHP】 [ Laravel 5.7 文档 ] 基础组件 —— 中间件</h6>
                            <p>中间件为过滤进入应用的 HTTP 请求提供了一套便利的机制。例如，Laravel 内置了一个中间件来验证用户是否经过认证（如登录），如果用户没有经过认证，中间件会将用户重定向到登录页面，而如果用户已经经过认证，中间件就会允许请求继续往前进入下一步操作。</p>
                            <div class="web-main-article-list-footer">
                                <span class="list-footer-left">
                                  <i class="iconfont icon-icontag" ></i> 
                                  <span >
                                    <a href="">Laravel</a> <a href="">PHP</a> <a href="">Swoole</a>
                                  </span> 
                                </span>

                                <span class="list-footer-left">
                                    <i class="iconfont icon-linedesign-04" ></i><span >2018-02-08</span> 
                                </span>

                                <span class="list-footer-left">
                                   <i class="iconfont icon-yanjing"></i><span >浏览（0）</span> 
                                </span>

                                <span class="list-footer-right"><a href="" >查看详情</a></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                  </div>

                  <div class="web-main-article-list-container">
                        <div class="web-main-article-list" >
                            <h6 >【Redis】Apache配置PHP相关配置</h6>
                            <!-- <p>置了一个中间件来验证用户是否经过认证（如登录），如果用户没有经过认证。</p> -->
                            <div class="web-main-article-list-footer">
                                <span class="list-footer-left">
                                  <i class="iconfont icon-icontag" ></i> 
                                  <span >
                                    <a href="">Laravel</a> <a href="">PHP</a> <a href="">Swoole</a>
                                  </span> 
                                </span>

                                <span class="list-footer-left">
                                    <i class="iconfont icon-linedesign-04" ></i><span >2018-02-08</span> 
                                </span>

                                <span class="list-footer-left">
                                   <i class="iconfont icon-yanjing"></i><span >浏览（0）</span> 
                                </span>

                                <span class="list-footer-right"><a href="" >查看详情</a></span>
                            </div>
                            <div class="clear"></div>
                        </div>
                  </div>
            </div>
      </div>
</article>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="/plugin/template-web.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layouts.blog-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>