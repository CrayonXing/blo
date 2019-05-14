@extends('admin.layouts.layout')

@section('left-sidebar')

@endsection


@section('content')
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
        <div class="layui-row  layui-col-space15 larryms-echarts">
            <div class="layui-col-lg6 layui-col-md6 layui-col-sm12 layui-col-xs12">
                <section class="layui-card">
                    <div class="larryms-card-head">最新文章</div>
                    <div class="layui-card-body" style="height: 350px;">
                        <table class="layui-table new-article" lay-skin="nob">
                            <thead>
                            <tr>
                                <th >昵称</th>
                                <th >分类</th>
                                <th>标题</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>吕**</td>
                                <td>PHP</td>
                                <td >Mysql中MVCC的使用及原理详解</td>
                            </tr>
                            <tr>
                                <td>吕**</td>
                                <td>MySQL</td>
                                <td>mysql-基础-视图，存储过程，触发器</td>
                            </tr>
                            <tr>
                                <td>吕**</td>
                                <td>MySQL</td>
                                <td>使用Nginx来代理运行于Swoole上的Laravel</td>
                            </tr>
                            <tr>
                                <td>吕**</td>
                                <td>MySQL</td>
                                <td>iWatch</td>
                            </tr>
                            <tr>
                                <td>吕**</td>
                                <td>MySQL</td>
                                <td>使用Nginx来代理运行于Swoole上的Laravel</td>
                            </tr>
                            <tr>
                                <td>吕**</td>
                                <td>MySQL</td>
                                <td>iWatch</td>
                            </tr>
                            <tr>
                                <td>吕**</td>
                                <td>MySQL</td>
                                <td>使用Nginx来代理运行于Swoole上的Laravel</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="layui-col-lg6 layui-col-md6 layui-col-sm12 layui-col-xs12">
                <section class="layui-card">
                    <div class="layui-card-header">
                        文章分类统计
                    </div>
                    <div class="layui-card-body">
                        <div class="larryms-charts-box" id="demo8" _echarts_instance_="ec_1557562003248"
                             style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative; background: rgba(0, 0, 0, 0);">
                            <div style="position: relative; overflow: hidden; width: 963px; height: 330px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                                <canvas data-zr-dom-id="zr_0" width="1203" height="412"
                                        style="position: absolute; left: 0px; top: 0px; width: 963px; height: 330px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                            </div>
                            <div style="position: absolute; display: none; border-style: solid; white-space: nowrap; z-index: 9999999; transition: left 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s, top 0.4s cubic-bezier(0.23, 1, 0.32, 1) 0s; background-color: rgba(50, 50, 50, 0.7); border-width: 0px; border-color: rgb(51, 51, 51); border-radius: 4px; color: rgb(255, 255, 255); font: 14px/21px &quot;Microsoft YaHei&quot;; padding: 5px; left: 150px; top: 140px;">
                                搜索引擎细分 <br>谷歌 : 251 (16.21%)
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="layui-row layui-col-space15">
            <div class="layui-col-lg12 layui-col-md12 layui-col-sm12 layui-col-xs12">
                <section class="layui-card" data-step="4" data-intro="使用如此简单，当然这个仅仅是基本演示，如页面跳转，制作介绍教程比较实用" data-position="right">
                    <div class="layui-card-header header-title library-tit">
                        <h1 style="text-align: left;font-size: 16px;"  >服务器及PHP信息</h1>
                    </div>
                    <div class="layui-card-body library-body" data-step="6" data-intro="好了，基本演示就到这里，丰富的示例请在框架开发者文档中查看,点击完成结束分步介绍！">
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

                var options_demo8 = {
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
                    legend: {
                        data: ['PHP', 'Swoole', 'Web', 'Python', 'Linux', 'IT趣闻', 'Mysql', '其它']
                    },
                    xAxis: [{
                        type: 'category',
                        splitLine: {
                            show: false
                        },
                        data: ['5/05', '5/06', '5/07', '5/08', '5/09', '5/10', '5/11']
                    }],
                    yAxis: [{
                        type: 'value',
                        position: 'right'
                    }],
                    series: [{
                        name: 'PHP',
                        type: 'bar',
                        data: [320, 332, 301, 334, 390, 330, 320]
                    }, {
                        name: 'Swoole',
                        type: 'bar',
                        tooltip: {
                            trigger: 'item'
                        },
                        stack: '广告',
                        data: [120, 132, 101, 134, 90, 230, 210]
                    }, {
                        name: 'Web',
                        type: 'bar',
                        tooltip: {
                            trigger: 'item'
                        },
                        stack: '广告',
                        data: [220, 182, 191, 234, 290, 330, 310]
                    }, {
                        name: 'Python',
                        type: 'bar',
                        tooltip: {
                            trigger: 'item'
                        },
                        stack: '广告',
                        data: [150, 232, 201, 154, 190, 330, 410]
                    }, {
                        name: 'Linux',
                        type: 'bar',
                        tooltip: {
                            trigger: 'item'
                        },
                        stack: '广告',
                        data: [150, 232, 201, 154, 190, 330, 410]
                    },
                        {
                            name: 'IT趣闻',
                            type: 'bar',
                            tooltip: {
                                trigger: 'item'
                            },
                            stack: '广告',
                            data: [150, 232, 201, 154, 190, 330, 410]
                        },
                        {
                            name: 'Mysql',
                            type: 'bar',
                            tooltip: {
                                trigger: 'item'
                            },
                            stack: '广告',
                            data: [150, 232, 201, 154, 190, 330, 410]
                        },
                        {
                            name: '其它',
                            type: 'bar',
                            tooltip: {
                                trigger: 'item'
                            },
                            stack: '广告',
                            data: [150, 232, 201, 154, 190, 330, 410]
                        }
                    ]
                };

                var demo8 = echarts.init(document.getElementById('demo8'), layui.echartStyle('larry'));

                setTimeout(function() {
                    demo8.setOption(options_demo8);
                }, 350);
            });
        });
    </script>
@endsection

@push('scripts')

@endpush