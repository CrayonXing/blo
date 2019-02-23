@extends('web.layouts.blog-layout')

@section('content')


<article>
      @include('web.layouts.web-main-left')

      <div class="web-main-right">
            <div class="web-main-breadcrumb">
                 <p><a>会员中心</a> <span>/</span> <a>个人中心</a></p>
            </div>
            <div class="web-main-content" style="padding: 10px;">
                  
            </div>
      </div>
</article>

@endsection

@push('scripts')

@endpush