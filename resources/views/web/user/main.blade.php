@extends('web.layouts.blog-layout')
@section('content')

<article>
      @include('web.layouts.web-main-left')

      <div class="web-main-right">
            <div class="web-main-breadcrumb">
                 <p><a>会员中心</a> </p>
            </div>
            <div class="web-main-content" style="padding: 10px;">
                  <div style="width: 100%;min-height: 100px;border-radius: 5px;box-shadow: -4px 0px 45px -11px #fe8074;" >
                        <div style="float: left;width: 150px;height: 100%;padding: 15px 5px 5px 0px;text-align: center">
                              <img src="/web/images/touxiao.jpg" style="width:70px;height: 70px;border-radius: 50% 50%;margin-left: 39px;">
                              <p style="padding-left: 5px;color: #9ddbf7;font-weight: 500;cursor: pointer;"><i class="iconfont icon-editor"></i>
                                    <a href="/user-datum" style="color: #9ddbf7;">编辑资料</a></p>
                        </div>
                        <div style="float: left;width: 785px;height: 100%;padding: 15px 5px 5px 10px;">
                              <p>
                                    <span style="color: #CCCCCC;">会员信息卡片</span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">昵称 :</span>
                                    <span style="color:#fe8074;padding-left: 10px;font-size: 16px;">嘿！boy</span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">标签 :</span>
                                    <span style="color:#afadad;padding-left: 10px;">坚持、信念</span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">座右铭:</span>
                                    <span style="color:#afadad;padding-left: 10px;">生活需要梦想、需要坚持。只有不断提高自我，才会得到想要的生活...</span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">园龄时间 :</span>
                                    <span style="color:#afadad;padding-left: 10px;">1年零6个月</span>
                              </p>
                              <p>
                                    <span style="color: #CCCCCC;">我的积分 :</span>
                                    <span style="color:#afadad;padding-left: 10px;"><em style="color:#ed8282;">50</em> (积分)</span>
                              </p>
                        </div>
                        <div class="clear"></div>
                  </div>


                  <p style="margin-top: 50px;border-bottom: 1px solid #ccc;padding-bottom: 5px;font-size: 16px;color: #fc9d9a">关于我的</p>
            </div>
      </div>
</article>

@endsection

@push('scripts')

@endpush