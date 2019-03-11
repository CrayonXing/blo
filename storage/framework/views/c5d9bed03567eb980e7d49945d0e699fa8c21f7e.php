    <?php if(auth('web')->check()): ?>
        <a href="/user-article-edit" class="add-article"><i class="am-icon-plus"></i> 我要发文</a>
    <?php endif; ?>

    <div class="about" >
      <div class="avatar"> <img src="/web/images/touxiao.jpg" alt=""> </div>
      <p class="abname">YuanDong | 3年 <i class="iconfont iconyanjing_bi"></i></p>
      <p class="abposition">PHP开发工程师</p>
      <div class="abtext"> 生活需要梦想、需要坚持。只有不断提高自我，才会得到想要的生活... </div>
    </div>

    <?php if($tagCloudArr = app('help')->getTags()): ?>
        <div class="cloud">
            <h2 class="hometitle">热门标签</h2>
            <ul>
                <?php $__currentLoopData = $tagCloudArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag=>$num): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/"><?php echo e($tag); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if($rankingList = app('help')->getRankingList()): ?>
        <div class="paihang">
            <h2 class="hometitle">点击排行</h2>
            <ul>
                <?php $__currentLoopData = $rankingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rankingRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="/article/details/aid/<?php echo e($rankingRow['id']); ?>" target="_blank"><?php echo e($rankingRow['title']); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="links">
      <h2 class="hometitle">友情链接</h2>
      <ul>
            <li><a href="https://laravel.sh-jinger.com" target="_blank" >流星博客</a></li>
      </ul>
    </div>