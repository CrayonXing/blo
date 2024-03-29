@extends('web.layouts.blog-layout')

@push('css')
    <link href="/static/web/css/article-detail.css" rel="stylesheet">
    <link href="/plugin/spop/spop.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet">
@endpush

@section('content')
<article>
      <h1 class="t_nav"><span style="float: left;"><a href="/">首页</a> > 文章详情 > {{$info['title']}}</span></h1>
      <div class="infos">
        <div class="newsview">
          <h3 class="news_title">{{$info['title']}}</h3>
          <div class="news_author">
              @if(empty($info['reprint_url']))
                  <span class="am-badge am-badge-success" style="background-color: #d6b8b7;border-radius: 0">原创</span>
              @endif
              <span class="au01"><i class="iconfont icon-yonghu"></i> {{$info['author']}}</span>
              <span class="au02"><i class="iconfont icon-rili" style="font-size: 12px;"></i> <?php echo date('Y-m-d',strtotime($info['created_time'])) ?></span>
              <span class="au03"><i class="iconfont icon-liulan"></i> 浏览量({{$info['visits']}})</span>
          </div>

          @if($info['tag'])
          <div class="tags">
              @foreach ($info['tag'] as $tag)
                  @if(!empty($tag))
                      <a href="javascript:void(0)" target="_blank">{{$tag}}</a>
                  @endif
              @endforeach
          </div>
          @endif

          @if($info['describe'])
            <div class="news_about">
              <strong>文章简介</strong>
                {{$info['describe']}}
            </div>
          @endif

          <div class="news_infos">
              <?php echo htmlspecialchars_decode($info['content']);?>
          </div>

          @if($info['reprint_url'])
          <div class="news_infos-reprint">
            <p><i class="iconfont icon-wenzhangzhuanzai" ></i> 文章转载自 @link <a href="{{$info['reprint_url']}}" target="_blank" >{{$info['reprint_url']}}</a></p>
          </div>
          @endif
        </div>

        @if($piece['previous'] || $piece['next'])
        <div class="blog-info-nextpage">
            @if($piece['previous'])
                <p><span>上一篇 </span> &nbsp; <a href="/p/{{$piece['previous']['short_code']}}" class="detail-href-hover">{{$piece['previous']['title']}}</a></p>
            @endif

            @if($piece['next'])
                <p><span>下一篇 </span> &nbsp; <a href="/p/{{$piece['next']['short_code']}}" class="detail-href-hover">{{$piece['next']['title']}}</a></p>
            @endif
        </div>
        @endif

        @if($relevant)
          <div class="blog-info-relevant">
              <p class="blog-info-relevant-title">
                  <b>推荐文章</b>(<em style="">{{count($relevant)}}</em>)
              </p>
              <div class="blog-info-relevant-content">
                  <ul>
                      @foreach($relevant as $rel)
                          <li> <a href="/p/{{$rel['short_code']}}" class="detail-href-hover">{{$rel['title']}}</a></li>
                      @endforeach
                  </ul>
              </div>
          </div>
        @endif

        <div class="blog-info-comment">
            <p class="blog-info-comment-title">
               <b>热门评论</b> (<em class="comment-create-header-comment-num" >0</em>)
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

      <div class="sidebar">
            @include('web.article.sidebar')
      </div>
</article>
@endsection

@push('scripts')
<script type="text/html" id="tpl-blog-comment-list">
    @{{if rows.length > 0 }}
        @{{each rows as firstList index1}}
        <div class="comment-list">
            <div class="comment-list-left"><img src="@{{firstList.head}} " ></div>
            <div class="comment-list-right">
                <div class="comment-list-header">
                    <div class="comment-list-name">
                        <span>@{{firstList.nickname}}</span>
                        <span>@{{firstList.date}}</span>
                    </div>

                    <div style="float: right;">
                        <p class="comment-list-column">
                            <span data-commentid="@{{firstList.id}}" data-name="@{{firstList.nickname}}"  data-content="@{{firstList.content}}" class="click-comment" ><i class="iconfont icon-pinglun3-copy" ></i>回复Ta</span>
                            <span><i class="iconfont icon-dianzan21" ></i>点赞(@{{firstList.like}})</span>
                            <span><i class="iconfont icon-buoumaotubiao48" ></i>回复(@{{firstList.answer_num}})</span>
                        </p>
                    </div>
                </div>

                <div class="clear"></div>

                <p class="comment-list-text">@{{firstList.content}} </p>

                @{{if firstList.children.length > 0 }}
                    @{{each firstList.children as twoList index2}}
                        <div class="sub-comment-container">
                            <div class="sub-comment-list" >
                                <div class="sub-comment-list-box" >
                                    <p class="sub-comment-list-name">
                                        <span>@{{twoList.nickname}}</span>
                                        <span>@{{twoList.date}}</span>
                                    </p>
                                    <p class="sub-comment-list-text">@{{twoList.content}}</p>
                                    <p class="sub-comment-list-column" >
                                        <span><i class="iconfont icon-pinglun3-copy" ></i>回复Ta</span>
                                        <span><i class="iconfont icon-dianzan21" ></i>点赞(@{{twoList.like}})</span>
                                        <span><i class="iconfont icon-buoumaotubiao48" ></i>回复(@{{twoList.answer_num}})</span>
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    @{{/each}}
                @{{/if}}
            </div>
            <div class="clear"></div>
        </div>
        @{{/each}}
    @{{/if}}
</script>
<script type="text/javascript" src="/plugin/template-web.js"></script>
<script type="text/javascript" src="/plugin/spop/spop.min.js"></script>
<script type="text/javascript">
    const  aid = '{{$info['id']}}';
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

    $('.news_infos a').attr('target','_blank');

    commentObj.loadCommentData();
</script>
<script type="text/javascript" src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
<script type="text/javascript">
    hljs.initHighlightingOnLoad();
    for (let i=1;i<5;i++){
        setTimeout(function(){
            $('code').removeClass('xml');
        },i*500);
    }
</script>
@endpush