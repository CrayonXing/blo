@extends('web.layouts.blog-layout')

@section('content')
<style type="text/css">
    .web-sigin-box{
        width: 100%;min-height: 150px;box-shadow: 4px 6px 45px -11px #fc9d9a;
    }

    .right-bg {
    	width: 100%;height: 500px;
    	padding-top: 20px;
		  background: -webkit-linear-gradient(#FFC989, #F08300); /* Safari 5.1 - 6.0 */
		  background: -o-linear-gradient(#FFC989, #F08300); /* Opera 11.1 - 12.0 */
		  background: -moz-linear-gradient(#FFC989, #F08300); /* Firefox 3.6 - 15 */
		  background: linear-gradient(#FFC989, #F08300); /* 标准的语法 */
	}

	.calendar-lastMonth{
		position: absolute;top: 0;left: 5px;font-size: 14px;cursor: pointe;
	}

	.calendar-nextMonth{
		position: absolute;top: 0;right: 5px;font-size: 14px;cursor: pointer
	}

	.calendar-lastMonth a,.calendar-nextMonth a{
		color: #fff;
	}

	.calendar-title{
		width: 100%;height: 30px;line-height: 30px;text-align:center;background: #ffc989;font-weight: bold;font-size: 20px;color: #fff;box-shadow: 1px 3px 5px #ffc989;position: relative;
	}
	
	.calendar-body{
		text-align: center;
	}

	
	.calendar-tab-header > div{
		float: left;height: 40px;line-height: 40px;
	}

	.calendar-tab-header > div:nth-child(1){
		width: 14.3%;
	}

	.calendar-tab-header > div:nth-child(2){
		width: 14.3%;
	}
	.calendar-tab-header > div:nth-child(3){
		width: 14.3%;
	}
	.calendar-tab-header > div:nth-child(4){
		width: 14.3%;
	}
	.calendar-tab-header > div:nth-child(5){
		width: 14.2%;
	}
	.calendar-tab-header > div:nth-child(6){
		width: 14.3%;
	}
	.calendar-tab-header > div:nth-child(7){
		width: 14.3%;
	}

	.calendar-tab .calendar-tab-header > div{
		height: 72px;
		line-height: 72px;
		font-size: 18px;
		font-family: "Times New Roman",Georgia,Serif;
	}

	.calendar-signin{
		font-weight: bold;font-size: 30px !important;color: #F59E35 !important;
	}

	.calendar-signin > sub{
		font-size: 12px;
	}

	.calendar-gray{
		color: #ccc;
	}


	.sigin-box{
		width: 90%;min-height: 100px;background: #ffffff;margin: 0 auto;border-radius: 5px;padding-bottom: 20px;
	}

	.sigin-box-title{
		width: 100%;height: 30px;background: #F49D34;border-radius: 5px 5px 0 0;position: relative;
	}

	.sigin-box-title i:nth-child(1){
		position: absolute;top:7px;left: 54px;color: #ece3e3;
	}

	.sigin-box-title i:nth-child(2){
		position: absolute;top:7px;left: 183px;color: #ece3e3;
	}
	

	.sigin-box-btn{
		width: 150px;height: 40px;margin: 0 auto;border-radius:3px;cursor: pointer;line-height: 45px;text-align:center;font-weight: bold;color: #fff;font-size: 18px;box-shadow: 1px 3px 5px #f3a9a9;background: #FFEB42
	}

	.sigin-box-btn-tip{
		font-size: 10px;text-align:center;margin-top:10px;color: #FABF80
	}

	.signin-rule{
		width: 90%;height: 300px;background: #ffffff;margin: 0 auto;border-radius: 5px;margin-top:20px;padding:30px 10px 10px 20px;
	}

	.signin-rule-title{
		color: #F4A742;margin: 0;padding-bottom: 10px;font-weight:bold;
	}

	.signin-rule-list{
		color: #F4A742;display: inline-block;font-size: 10px;padding-bottom: 5px;
	}

	.signin-rule-other p{
		color: #F4A742;margin: 20px 0px 0px 0px;padding-bottom: 10px;font-weight:bold;
	}

	.signin-rule-other span{
		color: #F4A742;display: inline-block;font-size: 10px;
	}

	.signin-sc-box {
		width: 100%;height: 100%;background: rgb(40,40,40,.2);z-index: 99999999999999999999999;position: fixed;top: 0;left: 0;display: none;
	}	

	.signin-sc-box > div{
		width: 300px;height: 150px;background: #fff;border-radius: 3px;position: fixed;top: 35%;left: 0;right: 0;margin: 0 auto;padding: 0 10px 10px 10px;
	}	

	.signin-sc-header{
		height: 30px;width: 100%;border-radius: 3px 3px 0 0;line-height: 30px;text-align: right;
	}

	.signin-sc-header i{
		cursor: pointer;font-size: 20px;
	}

	.signin-sc-body{
		margin-top:20px;
	}

	.signin-sc-body > p{
		font-size: 30px;text-align: center;color: #ffc989;
	}

	.signin-sc-body > div{
		border-bottom: 1px solid #ccc;position: relative;margin-top: 30px;width: 70%;margin: 0 auto;
	}

	.signin-sc-body > div > p{
		position: absolute;height: 20px;line-height: 20px;width: 60%;background: #fff;margin-left: 20%;text-align: center;top: -10px;color: #ccc
	}
</style>

<article>
    @include('web.layouts.web-main-left')
    <div class="web-main-right">
        <div class="web-main-breadcrumb">
            <p><a>会员中心</a> <span>/</span> <a>会员签到</a></p>
        </div>
        <div class="web-main-content" style="padding: 10px;" >
            <div style="width: 98%;min-height: 500px;margin: 0 auto;padding:5px;box-shadow: 1px 3px 5px #f3a9a9;"> 
				<div class="am-g">
				  <div class="am-u-sm-8" style="padding:0;padding-right: 5px;">
						<div style="width:100%;height: 500px;">
							<div class="calendar-title">
								<span>{{$date}}</span>
								<div class="calendar-lastMonth"><a href="{{$lastMonth}}">上一月</a></div>
								<div class="calendar-nextMonth"><a href="{{$nextMonth}}">下一月</a></div>
							</div>
							<div class="calendar-body">
								<?php echo $signinCalendar;?>
							</div>
						</div>
				  </div>

				  <div class="am-u-sm-4" style="padding:0">	
						<div style="" class="right-bg">
							<div class="sigin-box">
								<p style="" class="sigin-box-title">
									<i class="iconfont icon-guanbi"></i><i class="iconfont icon-guanbi"></i>
								</p>
								<div class="sigin-box-btn {{$isSignin?'':'to-sigin'}} ">
									{{$isSignin?'已签到':'今日签到'}}
								</div>
								<div class="sigin-box-btn-tip">今日已领取10个积分,请明日继续签到</div>
							</div>

							<div class="signin-rule" >
								<div>
									<p  class="signin-rule-title">签到规则</p>
									<span class="signin-rule-list">1. 以7天为一个周期，若中途断签或签满一个周期后重新签到，则为新的一个周期；</span>
									<span class="signin-rule-list">2. 每次签到的积分由系统随机抽取，连续签到7天额外获得20积分奖励；</span>
									<span class="signin-rule-list">3. 签到当日获得20积分奖励；</span>
									<span class="signin-rule-list">4. 签到获得的积分可以用来兑换商城里的礼品、礼品会定期更新，定期兑换规则以单个礼品介绍里详细规则为准；</span>
								</div>
								<div class="signin-rule-other">
									<p>其它说明</p>
									<span>签到积分只能用于积分兑换业务</span>
								</div>
							</div>

						</div>
				  </div>
				</div>
            </div>
        </div>
    </div>
</article>

<div class="signin-sc-box">
	<div>
		<div class="signin-sc-header">
			<i class="iconfont icon-guanbi2"></i>
		</div>
		<div class="signin-sc-body">
			<p ><i class="iconfont icon-rili" style="font-size: 30px"></i> 签到成功</p>
			<div><p>已连续签到3天</p></div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
    <script type="text/javascript">
    	let page = {
    		lock:false,
    		sigin(){
    			$('.sigin-box-btn').text('签到中...');
    			$.ajax({
                    url: "/signin",
                    type: 'post',
                    dataType: 'json',
                    beforeSend: function () {
                        page.lock = true;
                    },
                    success: function (res) {
                    	if(res.code == 200){
                    		page.showSuccessBox()
                    		$('.sigin-box-btn').removeClass('to-sigin').text('已签到');
                    	}else{
                    		page.lock = false;
                    		alert('签到失败,请稍后再试...')
                    	}
                    },
                    error:function(){
                    	$('.sigin-box-btn').text('今日签到');
                    	alert('网络繁忙,请稍后再试...')
                    }
                });
    		},
    		showSuccessBox(){
    			$('.signin-sc-box').show();
    		}
    	};

    	$('.to-sigin').on('click',function(){
    		if(!page.lock){
				page.sigin();
    		}
    	});

    	$('.signin-sc-header i').on('click',function(){
    		$('.signin-sc-box').hide();
    	});
    </script>
@endpush