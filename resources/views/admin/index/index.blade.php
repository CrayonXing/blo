@extends('admin.layouts.layout')

@section('left-sidebar')

@endsection


@section('content')


    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/console.css">

    <style>
        .admin-title{
            color: #FC9D9A !important;
            font-family: "Times New Roman",Georgia,Serif;
            font-size: 20px;
        }
    </style>
<div class="layui-fluid">
    <div class="larry-container">
        <div class="layui-row layui-col-space15 larryms-data-top">
            <div class="larry-col-lg12 larry-col-md12 larry-col-sm12 larry-col-xs12">
                <section class="larry-card">
                    <div class="larry-card-body">
                        <p class="title p10"><cite class="admin-title">New博客后台管理主页</cite></p>
                    </div>
                </section>
            </div>

            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg3">
                <section class="layui-card">
                    <div class="layui-card-body countup">
                        <div class="left a">
                            <i class="larry-icon larry-gouwucheman"></i>
                            <p>新增文章</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangxiajiantoushixin"></i>
                            <div class="p">
                                <h3 id="orderCounter">666</h3>
                                <cite>+18%同比增长</cite>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg3">
                <section class="layui-card">
                    <div class="layui-card-body countup">
                        <div class="left b">
                            <i class="larry-icon larry-shouru"></i>
                            <p>文章总量</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangshang2"></i>
                            <div class="p">
                                <h3 id="incomeCounter">20000</h3>
                                <cite>+50%同比增长</cite>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg3">
                <section class="layui-card">
                    <div class="layui-card-body countup">
                        <div class="left c">
                            <i class="larry-icon larry-laofangke"></i>
                            <p>今日访客</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangshang2"></i>
                            <div class="p">
                                <h3 id="UVcounter">33568</h3>
                                <cite>+35%环比增长</cite>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-hide-md layui-show-lg-inline-block layui-col-lg3">
                <section class="layui-card">
                    <div class="layui-card-body countup">
                        <div class="left d">
                            <i class="larry-icon larry-zhifumaijia"></i>
                            <p>会员总数</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangshang2"></i>
                            <div class="p">
                                <h3 id="userCounter">3168</h3>
                                <cite>+30%同比增长</cite>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript" src="/plugin/larryms/layui/layui.js"></script>
    <script type="text/javascript">
        layui.config({
            base: '/plugin/larryms/',
        }).extend({
            larry: 'js/base'
        }).use('larry',function(){
            layui.use(['jquery','countup','larryms'], function() {
                var $ = layui.$;
                var countup = layui.countup;
                var larryms = layui.larryms;

                var UVc = new countup('UVcounter', 0, $('#UVcounter').text());
                var incomec = new countup('incomeCounter', 0, $('#incomeCounter').text());
                var orderc = new countup('orderCounter', 0, $('#orderCounter').text());
                var userc = new countup('userCounter', 0, $('#userCounter').text());

                orderc.start();
                incomec.start();
                UVc.start();
                userc.start();
            });
        });
    </script>
@endsection

@push('scripts')

@endpush