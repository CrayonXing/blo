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
              <div class="swiper-pagination"></div>
          </div>
          <div id="blog-list-container"></div>
          <div id="blog-list-paging">
               <i class="am-icon-spinner am-icon-pulse"></i> 数据加载中...
          </div>
      </div>
      <div class="sidebar" >
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
@endpush