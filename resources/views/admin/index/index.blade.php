@extends('admin.layouts.layout')

@section('left-sidebar')

@endsection


@section('content')

    <link rel="stylesheet" type="text/css" href="/plugin/larryms/larry/css/larry.css" media="all">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/plugin/larryms/css/admin/console.css">
    <link rel="stylesheet" type="text/css" href="http://at.alicdn.com/t/font_477590_n82storgbj.css">
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
                                <h3 id="incomeCounter">20,000</h3>
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
                                <h3 id="UVcounter">33,568</h3>
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
                            <p>会员</p>
                        </div>
                        <div class="right">
                            <i class="larry-icon larry-xiangshang2"></i>
                            <div class="p">
                                <h3 id="userCounter">3,168</h3>
                                <cite>+30%同比增长</cite>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="larryms-card layui-row layui-col-space15 larryms-products">
            <!-- 常用板块 -->
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
                <section class="layui-card">
                    <div class="layui-card-body ui-a" larry-tab="iframe" data-url='../html/uidemo/basics/larrymsbutton.html' data-icon="larry-anniu" data-font="larry-icon" data-id="153" data-group="2">
                        <i class="larry-icon larry-jiemiansheji"></i>
                        <cite class="layui-hide">LarryMS按钮</cite>
                        <p>UI范例</p>
                        <div class="label-content">
                            <span class="label label-default label-outline">larry组件</span>
                            <span class="label label-default label-outline">layui组件</span>
                            <span class="label label-default label-outline">基本</span>
                            <span class="label label-default label-outline">进阶</span>
                            <span class="label label-default label-outline">布局</span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
                <section class="layui-card">
                    <div class="layui-card-body ui-b" larry-tab="iframe" data-url='../html/library/charts/ani.html' data-icon="larry-donghua" data-font="larry-icon" data-id="78" data-group="1">
                        <i class="larry-icon larry-js1"></i>
                        <cite class="layui-hide">aniJS动画库</cite>
                        <p>JS组件库</p>
                        <div class="label-content">
                            <span class="label label-default label-outline">动画库</span>
                            <span class="label label-default label-outline">120+JS库</span>
                            <span class="label label-default label-outline">编辑器</span>
                            <span class="label label-default label-outline">2000+图标库</span>
                            <span class="label label-default label-outline">用户自定义组件</span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
                <section class="layui-card">
                    <div class="layui-card-body ui-c"  larry-tab="iframe" data-url='../html/use/notice.html' data-icon="larry-info" data-font="larry-icon" data-id="89" data-group="0">
                        <i class="larry-icon larry-gailan"></i>
                        <cite class="layui-hide">消息推送功能</cite>
                        <p>框架基础功能示例</p>
                        <div class="label-content">
                            <span class="label label-default label-outline">消息通知</span>
                            <span class="label label-default label-outline">分步表单</span>
                            <span class="label label-default label-outline">tree</span>
                            <span class="label label-default label-outline">表单生成器</span>
                            <span class="label label-default label-outline">treeTable</span>
                            <span class="label label-default label-outline">示例持续更新</span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
                <section class="layui-card">
                    <div class="layui-card-body ui-f"   larry-tab="iframe" data-url='../html/larrycms/content/list.html' data-icon="larry-neirongguanli2" data-font="larry-icon" data-id="26" data-group="3">
                        <i class="larry-icon larry-msnui-sys-report"></i>
                        <cite class="layui-hide">所有文章列表</cite>
                        <p>系统行业模板</p>
                        <div class="label-content">
                            <span class="label label-default label-outline">权限</span>
                            <span class="label label-default label-outline">菜单</span>
                            <span class="label label-default label-outline">CMS</span>
                            <span class="label label-default label-outline">CRM</span>
                            <span class="label label-default label-outline">OA</span>
                            <span class="label label-default label-outline">微信公众</span>
                            <span class="label label-default label-outline">200+模板页</span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
                <section class="layui-card">
                    <div class="layui-card-body ui-e"  larry-tab="iframe" data-url='../html/library/charts/echarts.html' data-icon="larry-moxing" data-font="larry-icon" data-id="75" data-group="1">
                        <i class="larry-icon larry-tubiao-zhuzhuangtu"></i>
                        <cite class="layui-hide">百度Echarts</cite>
                        <p>图表动画</p>
                        <div class="label-content">
                            <span class="label label-default label-outline">Echarts</span>
                            <span class="label label-default label-outline">仪表盘</span>
                            <span class="label label-default label-outline">svg动画</span>
                            <span class="label label-default label-outline">scrolla动画</span>
                            <span class="label label-default label-outline">炫酷CSS3</span>
                        </div>
                    </div>
                </section>
            </div>
            <div class="layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
                <section class="layui-card">
                    <div class="layui-card-body ui-d" larry-tab="iframe" data-url='../html/general/scene/4041.html' data-icon="larry-lianxiren" data-font="larry-icon" data-id="171" data-group="3">
                        <i class="larry-icon larry-changyongshili"></i>
                        <cite class="layui-hide">404.1</cite>
                        <p>页面示例</p>
                        <div class="label-content">
                            <span class="label label-default label-outline">相册</span>
                            <span class="label label-default label-outline">400系列</span>
                            <span class="label label-default label-outline">注册登录</span>
                            <span class="label label-default label-outline">联系人</span>
                            <span class="label label-default label-outline">H5场景</span>
                            <span class="label label-default label-outline">60+常用页</span>
                        </div>
                    </div>
                </section>
            </div>

        </div>
        <div class="layui-row layui-col-space15">
            <!-- 升级购买 -->
            <div class="layui-col-xs12 layui-col-sm12 layui-col-md12 layui-col-lg-12">
                <section class="larryms-buy larry-bg-white larry-panel">
                    <div class="larry-panel-header">
                        <h3 class="larry-panel-title">LarryMS/LarryCMS获取授权流程</h3>
                        <i class="larry-icon larry-guanbi1 close"></i>
                    </div>
                    <div class="larry-panel-body">
                        <div class="buy-content clearfix">
                            <div class="layui-col-xs-12 layui-col-sm6 layui-col-md3 layui-col-lg3 buy-step step1">
                                <div class="em nums">1</div>
                                <div class="text">
                                    <cite>购买</cite>
                                    <span class="explain">选择您需要购买的产品及服务</span>
                                </div>
                            </div>
                            <div class="layui-col-xs-12 layui-col-sm6 layui-col-md3 layui-col-lg3 buy-step step2 larry-bg-green">
                                <div class="em nums">2</div>
                                <div class="text">
                                    <cite>付款</cite>
                                    <span class="explain">官网在线支付费用</span>
                                </div>
                            </div>
                            <div class="layui-col-xs-12 layui-col-sm6 layui-col-md3 layui-col-lg3 buy-step step3">
                                <div class="em nums">3</div>
                                <div class="text">
                                    <cite>完成</cite>
                                    <span class="explain">下载源码、索取发票</span>
                                </div>
                            </div>
                            <div class="layui-col-xs-12 layui-col-sm6 layui-col-md3 layui-col-lg3 buy-step step4">
                                <div class="em nums">4</div>
                                <div class="text">
                                    <cite>售后</cite>
                                    <span class="explain">在线反馈、售后服务、加群交流</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/plugin/larryms/layui/layui.js"></script>

@endsection

@push('scripts')

@endpush