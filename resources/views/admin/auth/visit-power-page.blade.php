@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/larryms.css">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/admin.css">
    <style>
        body{
            background: #314961;
            color: #73879C;
        }

        .content{
            background-color: none;
        }
    </style>
@endpush

@section('left-sidebar')

@endsection

@section('content')


    <div class="larry-fluid p25 error">
        <div class="larry-row larry-col-space15">
            <div class="larry-col-lg12 larry-col-md12 larry-col-sm12 larry-col-xs12">
                <div class="full-center pt70 mt70">
                    <h1 class="error-403-h3 text-center" style="color: #f6a0a0">403 访问未授权！</h1>
                    <p class="text-center mt20">服务器理解客户端的请求，但是拒绝执行此请求</p>
                    <p class="text-center mt30"><span class="text-center larry-btn w-lg" id="cl" style="background: #85dc9c;" onclick="window.history.back(-1); ">点此返回 上一页</p>
                </div>
            </div>
        </div>
    </div>


    <ul class="layui-fixbar"><li class="layui-icon layui-fixbar-top" lay-type="top" style=""></li></ul>

@endsection

@push('scripts')

@endpush




