@extends('web.layouts.blog-layout')

@section('content')
    <article>
        @include('web.layouts.web-main-left')


        <style type="text/css">
            .web-sigin-box{
                width: 100%;min-height: 150px;box-shadow: 4px 6px 45px -11px #fc9d9a;
            }

        </style>

        <div class="web-main-right">
            <div class="web-main-breadcrumb">
                <p><a>会员中心</a> <span>/</span> <a>会员签到</a></p>
            </div>
            <div class="web-main-content" style="padding: 10px;" >
                <div class="web-sigin-box" >
                    签到开发中...
                </div>
            </div>
        </div>
    </article>

@endsection

@push('scripts')
    <script type="text/javascript">

    </script>
@endpush