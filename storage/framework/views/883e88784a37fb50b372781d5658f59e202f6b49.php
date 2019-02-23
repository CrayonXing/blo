

<?php $__env->startSection('content'); ?>


<article>
      <?php echo $__env->make('web.layouts.web-main-left', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <div class="web-main-right">
            <div class="web-main-breadcrumb">
                 <p><a>会员中心</a> <span>/</span> <a>个人中心</a></p>
            </div>
            <div class="web-main-content" style="padding: 10px;">
                  
            </div>
      </div>
</article>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layouts.blog-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>