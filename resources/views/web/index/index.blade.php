@extends('web.layouts.blog-layout')

@push('css')
    <link rel="stylesheet" href="/plugin/swiper/swiper.min.css">
@endpush

@section('content')
    <article>
      <div class="blogs">
          <div class="swiper-container cus-swiper-container" >
              <div class="swiper-wrapper">
                  <div class="swiper-slide"><img src="/static/web/images/background/a1bf0590d6002d63f4f183e7cff1b24.jpg" /></div>
                  <div class="swiper-slide"><img src="/static/web/images/background/ansjknfajsnfajsnnakj.jpeg"  /></div>
              </div>
              <div class="swiper-button-prev swiper-button-white"></div>
              <div class="swiper-button-next swiper-button-white"></div>
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