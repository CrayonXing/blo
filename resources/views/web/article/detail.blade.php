@extends('web.layouts.blog-layout')

@section('content')

<style type="text/css">
  pre {
    background-color: #0e0606 !important;
    color: #af4949 !important;
  }


  .news_infos-reprint{
    color: #c6b4b2;margin-top: 20px;
  }

  .news_infos-reprint i{
    color: #c6b4b2;
  }

  .news_infos-reprint a{
    color: #fc9d9a
  }

  .blog-info-nextpage{
      width: 100%;height: 60px;padding-left: 30px;padding-right: 10px;margin-top: 30px;
  }

  .blog-info-nextpage > p > span {
    color: black;
  }

  .blog-info-nextpage > p{
    overflow: hidden;
    text-overflow:ellipsis;
    white-space: nowrap;
  }

  .blog-info-nextpage > p > a{
    color: #8e8d8d;
  }

  .blog-info-nextpage > p > a:hover,.detail-href-hover:hover{
    color:#fc9d9a
  }

  .blog-info-fabulous{
    text-align: center;margin-top: 50px;margin-bottom: 50px;
  }

  .blog-info-fabulous > span{
    display: inline-block;min-width: 120px;height: 30px;border: 1px solid  #d2bebd;border-radius: 20px;line-height: 30px;margin-right: 20px;cursor: pointer;position: relative;color: #d2bebd;padding-right: 10px;
  }

  .blog-info-fabulous > span > i{
    font-size: 22px;color: #FC9D9B;position: absolute;top: -1px;left: 10px;
  }

  .blog-info-fabulous > span > a{
    margin-left: 30px;padding-left: 5px;display: inline-block;color: #ccc;
  }

  .blog-info-relevant{
    margin-bottom: 30px;
  }

  .blog-info-relevant-content ul{
    padding-left: 30px;
  }

  .blog-info-relevant-content ul li{
    height: 30px;line-height: 30px;color: #FC9D9A;
    text-overflow:ellipsis;
    white-space: nowrap;overflow: hidden;
  }

  .blog-info-relevant-content ul li:before{
    content:"•";
  }

  .blog-info-relevant-content ul li a{
    padding-left: 5px;
  }

  .comment-create{
    width: 100%;height: 200px;padding-left: 30px;padding-top: 10px;padding-right: 30px;
  }

  .comment-create ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    #999;
  }
  .comment-create :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
     color:    #999;
  }
  .comment-create ::-moz-placeholder { /* Mozilla Firefox 19+ */
     color:    #999;
  }
  .comment-create :-ms-input-placeholder { /* Internet Explorer 10-11 */
     color:    #999;
  }

  .comment-create-header{
    color: #999;
  }

  .comment-create-header > span:nth-child(1){
    display: inline-block;float: left;
  }

  .comment-create-header > span:nth-child(2){
    display: inline-block;float: right;
  }

  .comment-create-header > span:nth-child(2) em{
    font: 18px georgia;color: #f54343;
  }

  .comment-create > textarea{
    width: 100%;height: 80px;border: 1px solid #f5efef;margin-top: 5px;outline: none;padding: 10px;resize: none;color: #b9b2b2;
  }


  .comment-create-footer{
    background-color: #f5efef;
  }

  .comment-create-footer > span{
    background-color: #fc9d9a;border: none;color: #fff;
  }



  .comment-list-container{
    width: 100%;min-height: 100px;padding-left: 30px;padding-top: 10px;padding-right: 30px;
  }


  .blog-info-comment-title,.blog-info-relevant-title{
    width: 100%;height: 30px;border-bottom: 1px solid #d8cfcf;margin-top: 20px;padding-left: 5px;line-height: 30px;position: relative;padding-left: 30px;
  }

  .blog-info-comment-title > i,.blog-info-relevant-title > i{
    font-size: 20px;position: absolute;top: 0;left: 5px;
  }

  .blog-info-comment-title > i{
    font-size: 17px;
  }

  .blog-info-comment-title > em,.blog-info-relevant-title > em{
    font: 22px/24px Georgia;color: #f85959;
  }



  .comment-list{
    width: 100%;min-height: 50px;border:1px dashed #f7efef;margin-top: 5px;
  }

  .comment-list-left{
    width: 6%;min-height: 80px;float: left;padding-top: 5px;
  }

  .comment-list-left > img{
    width: 35px;height: 35px;border-radius: 5px;margin:0 auto
  }

  .comment-list-right{
    width: 94%;min-height: 80px;float: left;padding: 12px 5px 5px 5px;position: relative;
  }

  .comment-list-header{
    margin: 0;
  }

  .comment-list-name{
      float: left;
  }

  .comment-list-name > span:nth-child(1){
      color: #fc9d9a;
  }

  .comment-list-name > span:nth-child(2){
      color: #b1adad;
  }


  .comment-list-column{
    height: 30px;margin:0;line-height: 30px;position: absolute;right: 0;top: 10px;
  }

  .sub-comment-container{
    width: 100%;min-height: 50px;background-color: #f9f9f9;margin-bottom: 10px;
  }

  .sub-comment-list{
    width: 100%;min-height: 50px;border-top:1px dashed #e9d4d4;
  }

  .sub-comment-list:first-child{
    border-top:none;
  }

  .sub-comment-list-box{
    width: 100%;min-height: 100px;float: left;padding: 15px 5px 5px 5px;
  }

  .sub-comment-list-name{
    margin: 0;
  }

  .sub-comment-list-name > span:nth-child(1){
      color: #e5544f
  }

  .sub-comment-list-name > span:nth-child(2){
      color: #b1adad;margin-left:5px; 
  }

  .comment-list-text,.sub-comment-list-text{
    margin:10px 0 10px 0
  }

  .sub-comment-list-column{
    width: 100%;height: 30px;margin:0;line-height: 30px;
  }

  .comment-list-column >span ,.sub-comment-list-column > span{
    display: inline-block;margin-right: 10px;cursor: pointer;position: relative;padding-left:18px;color: #b1adad;
  }

  .comment-list-column >span i,.sub-comment-list-column > span i{
    font-size: 15px;position: absolute;left: 0px;
  }

  .comment-list-column > span:nth-child(2) i,.sub-comment-list-column > span:nth-child(2) i{
    font-size: 20px;
  }

    #comment-create-btn:hover{
        color: white !important;
    }

</style>

<article>
  <h1 class="t_nav"><span style="float: left;">您现在的位置是：<a href="/">首页</a> > 文章详情 > {{$info['title']}}</span></h1>
  <div class="infos">
    <div class="newsview">
      <h3 class="news_title">{{$info['title']}}</h3>
      <div class="news_author">
          @if(empty($info['describe']))
              <span class="am-badge am-badge-success" style="background-color: #d6b8b7">原创</span>
          @endif

          <span class="au01"><i class="iconfont icon-yonghu"></i> 嘿！boy</span>
          <span class="au02"><i class="iconfont icon-rili" style="font-size: 12px;"></i> <?php echo date('Y-m-d',strtotime($info['created_time'])) ?></span>
          <span class="au03"><i class="iconfont icon-liulan"></i> 浏览量({{$info['visits']}})</span>
      </div>

      <div class="tags">
        @if($info['tag'])
          @foreach ($info['tag'] as $tag)
              @if(!empty($tag))
                      <a href="" target="_blank">{{$tag}}</a>
              @endif
          @endforeach
        @endif
      </div>

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

    <div class="blog-info-nextpage">
        <p><span>上一篇 </span> &nbsp; <a href="" class="detail-href-hover">Apache配置PHP相关配置</a></p>
        <p><span>下一篇 </span> &nbsp; <a href="" class="detail-href-hover">[ Laravel 5.7 文档 ] 前端开发 —— Blade 模板引擎</a></p>
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

    <div class="blog-info-relevant">
        <p class="blog-info-relevant-title"> 
          <i class="iconfont icon-aipinpaiwenzhangshixiao" ></i> 
          <b>相关文章</b>
          <em style="">4</em>
        </p>
        <div class="blog-info-relevant-content">
            <ul>
                <li> <a href="" class="detail-href-hover">[ Laravel 5.7 文档 ] 基础组件 —— 中间件</a></li>
                <li> <a href="" class="detail-href-hover">Apache配置PHP相关配置</a></li>
                <li> <a href="" class="detail-href-hover">[ Laravel 5.7 文档 ] 前端开发 —— Blade 模板引擎</a></li>
                <li> <a href="" class="detail-href-hover">探访西南地区最大铁路配餐中心 动车盒饭这样“出锅”</a></li>
            </ul>
        </div>
    </div>

    <div class="blog-info-comment">
        <p class="blog-info-comment-title"> 
          <i class="iconfont icon-buoumaotubiao48"></i> <b>热门评论</b> <em >788</em>
        </p>

        <div class="blog-info-comment-container">
            <div class="comment-create">
                  <p class="comment-create-header">
                    <span>网友评论</span>
                    <span><em>205</em> 条评论 / <em>167</em> 人参与</span>
                  </p>
                  <div class="clear"></div>
                  <textarea placeholder="文明上网，不传谣言，登录评论！" id="fr-comment-content"></textarea>
                  <div class="comment-create-footer" >
                      <span style="float: left;height: 30px;line-height: 30px;display: inline-block;cursor: pointer;width: 696px;background: none;color: #fc9d9a;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;" id="huifu-ta"></span>
                      <span  class="am-btn am-btn-sm"  style="width: 84px;"  id="comment-create-btn" onclick="commentObj.submit()">发布评论</span>
                  </div>
            </div>  

            <div class="comment-list-container" >
                @if($commentList)
                    @foreach($commentList as $firstList)
                        <div class="comment-list">
                            <div class="comment-list-left"><img src="{{$firstList['head']}}" ></div>
                            <div class="comment-list-right">
                                <div class="comment-list-header">
                                    <div class="comment-list-name">
                                        <span>{{$firstList['nickname']}}</span>
                                        <span>{{$firstList['date']}}</span>
                                    </div>

                                    <div style="float: right;">
                                        <p class="comment-list-column">
                                            <span data-commentid="{{$firstList['id']}}" data-name="{{$firstList['nickname']}}"  data-content="{{$firstList['content']}}" class="click-comment" ><i class="iconfont icon-pinglun3-copy" ></i>回复Ta</span>
                                            <span><i class="iconfont icon-dianzan21" ></i>点赞({{$firstList['like']}})</span>
                                            <span   ><i class="iconfont icon-buoumaotubiao48" ></i>回复({{$firstList['answer_num']}})</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="clear"></div>

                                <p class="comment-list-text">{{$firstList['content']}}</p>

                                @if($firstList['children'])
                                    @foreach($firstList['children'] as $twoList)
                                        <div class="sub-comment-container">
                                            <div class="sub-comment-list" >
                                                <div class="sub-comment-list-box" >
                                                    <p class="sub-comment-list-name">
                                                        <span>{{$twoList['nickname']}}</span>
                                                        <span>{{$twoList['date']}}</span>
                                                    </p>
                                                    <p class="sub-comment-list-text">{{$twoList['content']}}</p>
                                                    <p class="sub-comment-list-column" >
                                                        <span><i class="iconfont icon-pinglun3-copy" ></i>回复Ta</span>
                                                        <span><i class="iconfont icon-dianzan21" ></i>点赞({{$twoList['like']}})</span>
                                                        <span><i class="iconfont icon-buoumaotubiao48" ></i>回复({{$twoList['answer_num']}})</span>
                                                    </p>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="clear"></div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

  </div>
  <div class="sidebar" style="margin-top: 20px;padding-bottom: 20px;">
    @include('web.article.sidebar')
  </div>
  </div>
</article>
@endsection


@push('scripts')
<script type="text/javascript">
(function ($) {
  $.extend({
    tipsBox: function (options) {
      options = $.extend({
        obj: null,  //jq对象，要在那个html标签上显示
        str: "+1",  //字符串，要显示的内容;也可以传一段html，如: "<b style='font-family:Microsoft YaHei;'>+1</b>"
        startSize: "12px",  //动画开始的文字大小
        endSize: "30px",    //动画结束的文字大小
        interval: 600,  //动画时间间隔
        color: "red",    //文字颜色
        callback: function () { }    //回调函数
      }, options);
      $("body").append("<span class='num'>" + options.str + "</span>");
      var box = $(".num");
      var left = options.obj.offset().left + options.obj.width() / 2;
      var top = options.obj.offset().top - options.obj.height();
      box.css({
        "position": "absolute",
        "left": left + "px",
        "top": top + "px",
        "z-index": 9999,
        "font-size": options.startSize,
        "line-height": options.endSize,
        "color": options.color
      });
      box.animate({
        "font-size": options.endSize,
        "opacity": "0",
        "top": top - parseInt(options.endSize) + "px"
      }, options.interval, function () {
        box.remove();
        options.callback();
      });
    }
  });
})(jQuery);
  
function niceIn(prop){
  prop.find('i').addClass('niceIn');
  setTimeout(function(){
    prop.find('i').removeClass('niceIn'); 
  },1000);    
}
$(function () {
  $("#test-id").click(function () {
    $.tipsBox({
      obj: $(this),
      str: "<b style='font-family:Microsoft YaHei;'>+1</b>",
      callback: function () {
      }
    });
    niceIn($(this));
  });
});
</script>

<script type="text/javascript">
    var commentObj = {
        comentLock:false,
        data:{
            aid:{{$info['id']}},
            cid:0,
        },
        submit(){
            var data = {content:$.trim($('#fr-comment-content').val()),aid:this.data.aid,cid:this.data.cid};
            if(data.content == ''){

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
                        alert(res.msg)
                    }
                });
            }
        },
    };

    $(document).on('click','.click-comment',function(){
        var name = $(this).data('name');
        var text = $(this).data('content');
        commentObj.data.cid = $(this).data('commentid');
        $('#huifu-ta').html(`<a style="color: #aaaaf2;margin-left: 5px;cursor: pointer" class="comment-click-cancel">取消回复Ta</a> @${name} //评论内容// ${text} `);

        $('html,body').animate({scrollTop: $('#fr-comment-content').offset().top - 300},300);

        $('#fr-comment-content').focus();
    });

    $(document).on('click','.comment-click-cancel',function(){
        $('#huifu-ta').html('');
        commentObj.data.cid = 0;
    });
</script>
@endpush