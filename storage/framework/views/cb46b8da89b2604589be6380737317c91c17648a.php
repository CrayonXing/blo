<?php $__env->startPush('css'); ?>
    <link href="/web/css/article-detail.css" rel="stylesheet">
    <link href="/plugin/Spop/spop.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<article>
      <h1 class="t_nav"><span style="float: left;">您现在的位置是：<a href="/">首页</a> > 文章详情 > <?php echo e($info['title']); ?></span></h1>

      <div class="infos">
        <div class="newsview">
          <h3 class="news_title"><?php echo e($info['title']); ?></h3>
          <div class="news_author">
              <?php if(empty($info['describe'])): ?>
                  <span class="am-badge am-badge-success" style="background-color: #d6b8b7">原创</span>
              <?php endif; ?>

              <span class="au01"><i class="iconfont icon-yonghu"></i> 嘿！boy</span>
              <span class="au02"><i class="iconfont icon-rili" style="font-size: 12px;"></i> <?php echo date('Y-m-d',strtotime($info['created_time'])) ?></span>
              <span class="au03"><i class="iconfont icon-liulan"></i> 浏览量(<?php echo e($info['visits']); ?>)</span>
          </div>

          <div class="tags">
            <?php if($info['tag']): ?>
              <?php $__currentLoopData = $info['tag']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(!empty($tag)): ?>
                          <a href="" target="_blank"><?php echo e($tag); ?></a>
                  <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>

          <?php if($info['describe']): ?>
            <div class="news_about">
              <strong>文章简介</strong>
                <?php echo e($info['describe']); ?>

            </div>
          <?php endif; ?>

          <div class="news_infos">
              <?php echo htmlspecialchars_decode($info['content']);?>
          </div>

            <?php if($info['reprint_url']): ?>
                <div class="news_infos-reprint">
                    <p><i class="iconfont icon-wenzhangzhuanzai" ></i> 文章转载自 @link  <a href="<?php echo e($info['reprint_url']); ?>" target="_blank" ><?php echo e($info['reprint_url']); ?></a></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="blog-info-nextpage">

            <?php if($piece['previous']): ?>
                <p><span>上一篇 </span> &nbsp; <a href="/article/details/aid/<?php echo e($piece['previous']['id']); ?>" class="detail-href-hover"><?php echo e($piece['previous']['title']); ?></a></p>
            <?php endif; ?>

            <?php if($piece['next']): ?>
                <p><span>下一篇 </span> &nbsp; <a href="/article/details/aid/<?php echo e($piece['next']['id']); ?>" class="detail-href-hover"><?php echo e($piece['next']['title']); ?></a></p>
            <?php endif; ?>

        </div>

        <div class="blog-info-fabulous">
              <span  id="test-id">
                <i class="iconfont icon-dianzan1" data-icon2='icon-dianzan1' data-icon2='icon-dianzan2' ></i><a>点赞(51)</a>
              </span>

              <span>
                <i class="iconfont icon-shoucang" data-icon2='icon-dianzan1' data-icon2='icon-dianzan2' ></i><a>收藏(51)</a>
              </span>
        </div>

        <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />

          <?php if($relevant): ?>
              <div class="blog-info-relevant">
                  <p class="blog-info-relevant-title">
                      <b>推荐文章</b>
                      <em style=""><?php echo e(count($relevant)); ?></em>
                  </p>
                  <div class="blog-info-relevant-content">
                      <ul>

                          <?php $__currentLoopData = $relevant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li> <a href="/article/details/aid/<?php echo e($rel->id); ?>" class="detail-href-hover"><?php echo e($rel->title); ?></a></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </ul>
                  </div>
              </div>
          <?php endif; ?>


        <div class="blog-info-comment">
            <p class="blog-info-comment-title">
               <b>热门评论</b> <em class="comment-create-header-comment-num" >0</em>
            </p>

            <div class="blog-info-comment-container">
                <div class="comment-create">
                      <p class="comment-create-header">
                        <span>网友评论</span>
                        <span><em class="comment-create-header-comment-num">0</em> 条评论 / <em class="comment-create-header-people-num">0</em> 人参与</span>
                      </p>
                      <div class="clear"></div>
                      <textarea placeholder="文明上网，不传谣言，登录评论！" id="fr-comment-content"></textarea>
                      <div class="comment-create-footer" >
                          <span style="float: left;height: 30px;line-height: 30px;display: inline-block;cursor: pointer;width: 696px;background: none;color: #fc9d9a;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" id="reply-user"></span>
                          <span  class="am-btn am-btn-sm"  style="width: 84px;"  id="comment-create-btn" onclick="commentObj.submit()">发布评论</span>
                      </div>
                </div>

                <div class="comment-list-container" ></div>
            </div>
        </div>
      </div>

      <div class="sidebar" style="margin-top: 20px;padding-bottom: 20px;">
            <?php echo $__env->make('web.article.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
</article>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script type="text/html" id="tpl-blog-comment-list">
    {{if rows.length > 0 }}
        {{each rows as firstList index1}}
        <div class="comment-list">
            <div class="comment-list-left"><img src="{{firstList.head}} " ></div>
            <div class="comment-list-right">
                <div class="comment-list-header">
                    <div class="comment-list-name">
                        <span>{{firstList.nickname}}</span>
                        <span>{{firstList.date}}</span>
                    </div>

                    <div style="float: right;">
                        <p class="comment-list-column">
                            <span data-commentid="{{firstList.id}}" data-name="{{firstList.nickname}}"  data-content="{{firstList.content}}" class="click-comment" ><i class="iconfont icon-pinglun3-copy" ></i>回复Ta</span>
                            <span><i class="iconfont icon-dianzan21" ></i>点赞({{firstList.like}})</span>
                            <span><i class="iconfont icon-buoumaotubiao48" ></i>回复({{firstList.answer_num}})</span>
                        </p>
                    </div>
                </div>

                <div class="clear"></div>

                <p class="comment-list-text">{{firstList.content}} </p>

                {{if firstList.children.length > 0 }}
                    {{each firstList.children as twoList index2}}
                        <div class="sub-comment-container">
                            <div class="sub-comment-list" >
                                <div class="sub-comment-list-box" >
                                    <p class="sub-comment-list-name">
                                        <span>{{twoList.nickname}}</span>
                                        <span>{{twoList.date}}</span>
                                    </p>
                                    <p class="sub-comment-list-text">{{twoList.content}}</p>
                                    
                                        
                                        
                                        
                                    
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    {{/each}}
                {{/if}}
            </div>
            <div class="clear"></div>
        </div>
        {{/each}}
    {{/if}}
</script>
<script src="/plugin/template-web.js"></script>
<script src="/plugin/Spop/spop.min.js"></script>
<script type="text/javascript">
    const  aid = '<?php echo e($info['id']); ?>';
    const commentObj = {
        comentLock:false,
        data:{aid:aid,cid:0},
        submit(){
            var data = {content:$.trim($('#fr-comment-content').val()),aid:this.data.aid,cid:this.data.cid};
            if(data.content == ''){
                spop({template: '评论内容不能为空',position : 'bottom-right',style: 'error',autoclose: 3000});
            }else if(commentObj.comentLock == false){
                $.ajax({
                    url: "/article/comment",
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    beforeSend: function () {
                        commentObj.comentLock = true;
                    },
                    complete: function () {
                        commentObj.comentLock = false;
                    },
                    success: function (res) {
                        var style = 'error';
                        if(res.code == 200){
                            style = 'success';
                            $('#fr-comment-content').val('');$('#reply-user').html('');
                            commentObj.loadCommentData();
                        }
                        spop({template: res.msg,position : 'bottom-right',style: style,autoclose: 3000});
                    }
                });
            }
        },
        reply(o){
            let top = $('#fr-comment-content').focus().offset().top - 300;
            let html  = `<a style="color: #aaaaf2;margin-left: 5px;cursor: pointer" class="comment-click-cancel">取消回复Ta</a> @${o.name} //评论内容// ${o.text} `;
            commentObj.data.cid = o.cid;
            $('html,body').animate({'scrollTop':top},300);
            $('#reply-user').html(html);
        },
        loadCommentData(){
            $.get("/article/get-comment-list",{aid:aid}, function(result){
               if(result.code == 200){
                   $('.comment-create-header-comment-num').text(result.data.comment_num);
                   $('.comment-create-header-people-num').text(result.data.people_num);
                   $('.comment-list-container').html(template("tpl-blog-comment-list",{rows:result.data.rows}));
               }
            },'json');
        }
    };

    $(document).on('click','.click-comment',function(){
        commentObj.reply({name:$(this).data('name'),text:$(this).data('content'),cid:$(this).data('commentid')});
    }).on('click','.comment-click-cancel',function(){
        $('#reply-user').html('');
        commentObj.data.cid = 0;
    });

    commentObj.loadCommentData();
</script>
<script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
<script>
    hljs.initHighlightingOnLoad()
    setTimeout(function(){
        $('code').removeClass('xml');
    },500)
    setTimeout(function(){
        $('code').removeClass('xml');
    },1000)
    setTimeout(function(){
        $('code').removeClass('xml');
    },1500)
    setTimeout(function(){
        $('code').removeClass('xml');
    },2000)
</script>
<script>

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('web.layouts.blog-layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>