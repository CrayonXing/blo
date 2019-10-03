@extends('web.layouts.blog-layout')
@section('content')

<article>
      <style>
            .user-info-table tr{
                  height: 35px;line-height: 35px;
            }

            .user-info-table tr span{
                  color: #CCCCCC;
            }

            .user-info-table tr em{
                  color:#ed8282;font-size: 16px;
            }

            /*box-shadow: 17px 12px 20px 5px #fff2f1;*/
      </style>

      @include('web.layouts.web-main-left')

      <div class="web-main-right">
            <div class="web-main-breadcrumb">
                 <p><a>个人中心</a> </p>
            </div>
            <div class="web-main-content" style="padding: 10px;">
                  <div style="width: 100%;min-height: 100px;border-radius: 5px;box-shadow: -4px 0px 20px -11px #fe8074;" >
                        <div style="float: left;width: 150px;height: 100%;padding: 15px 5px 5px 0px;text-align: center">
                              <img src="{{$userInfo['head']}}" onerror="this.src='/static/web/images/touxiao.jpg'" style="width:70px;height: 70px;border-radius: 50% 50%;margin-left: 39px;">
                              <p style="padding-left: 5px;color: #9ddbf7;font-weight: 500;cursor: pointer;"><i class="iconfont icon-editor"></i>
                              <a href="/user-datum" style="color: #9ddbf7;">编辑资料</a></p>
                        </div>
                        <div style="float: left;width: 785px;height: 100%;padding: 15px 5px 5px 10px;">
                              <p>
                                    <span style="color: #CCCCCC;">登录账号 :</span>
                                    <span style="color:#afadad;padding-left: 10px;">{{$userInfo['mobile']}} <a style="color: #9ddbf7;padding-left: 10px;cursor: pointer">更换</a></span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">昵称 :</span>
                                    <span style="color:#fe8074;padding-left: 10px;font-size: 16px;">{{$userInfo['nickname']}}</span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">标签 :</span>
                                    <span style="color:#afadad;padding-left: 10px;">{{str_replace(',','、',$userInfo['tags'])}}</span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">座右铭:</span>
                                    <span style="color:#afadad;padding-left: 10px;">{{$userInfo['motto']}}</span>
                              </p>
                        </div>
                        <div class="clear"></div>
                  </div>


                  <p style="margin-top: 50px;border-bottom: 1px solid #ccc;padding-bottom: 15px;font-size: 20px;color: #fc9d9a">关于我的</p>

                  <div style="padding-left: 30px;">
                        <table class="user-info-table">
                              <tr >
                                    <td width="300">
                                          <span>我的积分 :</span>
                                          <span><em>50</em> &nbsp;&nbsp;(积分)</span>
                                    </td>
                                    <td width="300" colspan="2">
                                          <span>活跃天数 :</span>
                                          <span><em>50</em> 天 <a style="font-size: 14px;color: #ccc;">(每日首次登录可获得相应的积分奖励)</a></span>
                                    </td>
                              </tr>

                              <tr >
                                    <td width="300">
                                          <span>我的文章 :</span>
                                          <span><em>50</em> 篇 <a href="/user-article" style="color: #9ddbf7">查看</a></span>
                                    </td>
                                    <td width="300">
                                          <span>我的收藏 :</span>
                                          <span><em>50</em> 篇 <a href="/user-article" style="color: #9ddbf7">查看</a></span>
                                    </td>
                                    <td width="300">
                                          <span>我的评论 :</span>
                                          <span><em>50</em> 次 <a href="/user-article" style="color: #9ddbf7">查看</a></span>
                                    </td>
                              </tr>

                              <tr >
                                    <td width="300">
                                          <span>收获点赞 :</span>
                                          <span><em>50</em> 个</span>
                                    </td>
                                    <td width="300">
                                          <span>被收藏 :</span>
                                          <span><em>50</em> 次</span>
                                    </td>
                                    <td width="300">
                                          <span>被评论 :</span>
                                          <span><em>50</em> 次</span>
                                    </td>
                              </tr>
                              <tr >
                                    <td width="300">
                                          <span>累计签到 :</span>
                                          <span><em>50</em> 次 <a href="/user-article" style="color: #9ddbf7">查看</a></span>
                                    </td>
                              </tr>
                        </table>
                  </div>

                  <p style="margin-top: 50px;border-bottom: 1px solid #ccc;padding-bottom: 15px;font-size: 20px;color: #fc9d9a">最新消息</p>


            </div>
      </div>
</article>

@endsection

@push('scripts')

@endpush