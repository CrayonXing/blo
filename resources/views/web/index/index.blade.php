@extends('web.layouts.blog-layout')

@section('content')
    <link rel="stylesheet" href="/plugin/swiper/swiper.min.css">
    <article>
      <div class="blogs" style="min-height: 850px;">
          <div class="swiper-container" style="margin-top: -15px;margin-bottom: 10px;height: 400px;">
              <div class="swiper-wrapper">
                  <div class="swiper-slide"><img src="/static/web/images/background/a1bf0590d6002d63f4f183e7cff1b24.jpg" style="width: 100%;height: 100%" /></div>
                  <div class="swiper-slide"><img src="/static/web/images/background/ansjknfajsnfajsnnakj.jpeg" style="width: 100%;height: 100%" /></div>
              </div>
              <div class="swiper-button-prev swiper-button-white"></div><!--左箭头。如果放置在swiper-container外面，需要自定义样式。-->
              <div class="swiper-button-next swiper-button-white"></div><!--右箭头。如果放置在swiper-container外面，需要自定义样式。-->
              <div class="swiper-pagination"></div>
          </div>
          <div id="blog-list-container"></div>
          <div id="blog-list-paging">
               <i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...
          </div>
      </div>
      <div class="sidebar" id="test-sidebar" >
            @include('web.article.sidebar')
        </div>
      </div>
    </article>
@endsection

@push('scripts')
<script src="/plugin/swiper/swiper.min.js"></script>
<script src="/plugin/template-web.js"></script>
@include('web.template.tpl-blog-list')
<script type="text/javascript" src="/static/web/js/page/index-page.js"></script>
<script type="text/javascript">
    let sidebarHeight  = $('#test-sidebar').height();
    $(window).scroll(function(event){
        var oTop = document.body.scrollTop==0?document.documentElement.scrollTop:document.body.scrollTop;
        if(oTop > sidebarHeight){

        }else{

        }
    });
</script>
@endpush