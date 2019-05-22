@extends('admin.layouts.layout')

@push('css')
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/console.css">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/demo/library.css" media="all">
    <style>
        .admin-title{
            color: #FC9D9A !important;
            font-family: "Times New Roman",Georgia,Serif;
            font-size: 20px;
        }

        .new-article tbody tr {
            border-bottom: 1px solid #e4eaec;
        }
    </style>
@endpush

@section('left-sidebar')
    <div class="side" id="my-left-box">
        <div class="brand">权限管理</div>
        <div class="menu">
            <ul>
                <li class="active"><span class="icon"></span>
                    <div class="text">管理员管理</div>
                </li>
                <li class=" "><span class="icon"></span>
                    <div class="text">角色管理</div>
                </li>
                <li class=" "><span class="icon"></span>
                    <div class="text">权限管理</div>
                </li>
            </ul>
        </div>
        <div class="toggle" id="my-close-left">
            <div class="shape"></div>
        </div>
    </div>
@endsection

@section('content')

@endsection

@push('scripts')

@endpush





