@extends('admin.layouts.layout')

@section('left-sidebar')

@endsection

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


@section('content')
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
                        <div class="left c">
                            <i class="larry-icon larry-laofangke"></i>
                            <p>访客流量</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangshang2"></i>
                            <div class="p">
                                <h3 id="UVcounter">33568</h3>
                                <cite>+35 (今日新增)</cite>
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
                                <cite>+30 (今日新增)</cite>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg3">
                <section class="layui-card">
                    <div class="layui-card-body countup">
                        <div class="left a">
                            <i class="larry-icon larry-gouwucheman"></i>
                            <p>文章数量</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangshang2"></i>
                            <div class="p">
                                <h3 id="orderCounter">666</h3>
                                <cite>+18 (今日新增)</cite>
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
                            <p>管理员</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangshang2"></i>
                            <div class="p">
                                <h3 id="incomeCounter">20000</h3>
                                <cite>+0 (今日新增)</cite>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="layui-row  layui-col-space15 larryms-echarts">
            <div class="layui-col-lg6 layui-col-md6 layui-col-sm12 layui-col-xs12">
                <section class="layui-card">
                    <div class="larryms-card-head">最新文章</div>
                    <div class="layui-card-body" style="height: 350px;">
                        <table class="layui-table new-article" lay-skin="nob">
                            <thead><tr><th>昵称</th><th>文章分类</th><th>发布时间</th><th>文章标题</th></tr></thead>
                            <tbody>
                                @foreach ($newArticle as $article)
                                    <tr>
                                        <td>{{$article->nickname}}</td>
                                        <td>{{$article->category_name}}</td>
                                        <td>{{$article->created_time}}</td>
                                        <td><a href="/article/details/aid/{{$article->id}}" style="color: #7dc5f1" target="_blank">{{$article->title}}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="layui-col-lg6 layui-col-md6 layui-col-sm12 layui-col-xs12">
                <section class="layui-card">
                    <div class="layui-card-header">文章分类统计</div>
                    <div class="layui-card-body">
                        <div class="larryms-charts-box" id="demo8" _echarts_instance_="ec_1557562003248"
                             style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative; background: rgba(0, 0, 0, 0);">
                            <div style="position: relative; overflow: hidden; width: 963px; height: 330px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                <canvas data-zr-dom-id="zr_0" width="1203" height="412"  style="position: absolute; left: 0px; top: 0px; width: 963px; height: 330px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="layui-row layui-col-space15">
            <div class="layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12">
                <section class="layui-card" data-position="right">
                    <div class="layui-card-header header-title library-tit">
                        <h1 style="text-align: left;font-size: 16px;"  >服务器及PHP信息</h1>
                    </div>
                    <div class="layui-card-body library-body" >
                        <table cellspacing="1" cellpadding="3" style="overflow: auto">
                            <tbody><tr>
                                <th width="12%">服务器操作系统:</th>
                                <td width="21%">{{$PHP_OS}}</td>
                                <th width="12%">Web 服务器:</th>
                                <td width="21%">{{$server_software}}</td>
                                <th width="12%">PHP 版本:</th>
                                <td width="21%">{{$PHP_VERSION}}</td>
                            </tr>
                            <tr>
                                <th>MySQL 版本:</th>
                                <td>{{$mysql_version}}</td>
                                <th>Laravel 版本:</th>
                                <td>5.7</td>
                                
                                <th>文件上传限制:</th>
                                <td>{{$upload_max_filesize}}</td>
                            </tr>
                            <tr>
                                <th>时区设置:</th>
                                <td>{{$timezone}}</td>
                                <th></th>
                                <td></td>
                                <th></th>
                                <td></td>
                            </tr>
                            </tbody></table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
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

            layui.use('echarts', function() {
                var echarts = layui.echarts;

                var echartsOptions = {
                    tooltip: {
                        trigger: 'axis'
                    },
                    toolbox: {
                        show: true,
                        y: 'bottom',
                        feature: {
                            mark: {
                                show: true
                            },
                            dataView: {
                                show: true,
                                readOnly: false
                            },
                            magicType: {
                                show: true,
                                type: ['line', 'bar', 'stack', 'tiled']
                            },
                            restore: {
                                show: true
                            },
                            saveAsImage: {
                                show: true
                            }
                        }
                    },
                    calculable: true,
                    legend: {data: []},
                    xAxis: [{
                        type: 'category',
                        splitLine: {show: false},
                        data: []
                    }],
                    yAxis: [{
                        type: 'value',
                        position: 'right'
                    }],
                    series: []
                };

                $.get("/admin/index-articlec-census", function(result){
                    echartsOptions.xAxis[0].data = result.data.xAxis;

                    console.log(result.data.series);
                    echartsOptions.series = result.data.series;
                    echartsOptions.legend.data = result.data.legend;
                    var echartsOptionsObj = echarts.init(document.getElementById('demo8'), layui.echartStyle('larry'));
                    echartsOptionsObj.setOption(echartsOptions);
                },'json');

            });
        });
    </script>
@endpush