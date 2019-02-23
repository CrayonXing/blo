var userLogin = {
	showBox:function(name){
		var index = (name == 'register') ?1:0;

		$('.login-box-body-tab > li').eq(index).addClass('login-box-body-tab-current').siblings().removeClass('login-box-body-tab-current');
		$('.login-box-body-from').find('fieldset').eq(index).show().siblings().hide();

		$('#web-login-container').show();
	},
	hideBox:function(){
		$('#web-login-container').fadeOut();
	},
	loginLoading:false,
	regLoading:false,
	login:function(){
		var data = {
			mobile:$('#loginbox-login-mobile').val(),
			pwd:$('#loginbox-login-pwd').val()
		};

		if(!functions.checkMobile(data.mobile)){
			this.showError('登录手机号格式错误...');return;
		}else if(functions.isEmptyStr(data.pwd)){
			this.showError('登录密码不能为空...');return;
		}else if(this.loginLoading == false){
			var _this = this;
			$.ajax({
                url: "/user-login",
                type: 'post',
                data: data,
                dataType: 'json',
                beforeSend: function () {
					_this.loginLoading = true;
                    $('.login-box-btn-login').html('<i class="am-icon-spinner am-icon-pulse"></i>登录中...');
                },
                success: function (res) {
                	console.log(res);
                    if(res.code == 200){
						$('.login-box-btn-login').html(' 登录成功<i class="am-icon-check"></i>');
						window.location.reload();
					}else{
						_this.loginLoading = false;
						$('.login-box-btn-login').html('登 录');
						_this.showError('登录密码填写错误...');return;
					}
                },
                error:function(){
					_this.loginLoading = false;
					$('.login-box-btn-login').html('登 录');
                }
            });
		}
	},
	register:function(){
		var data = {
			mobile:$('#loginbox-reg-mobile').val(),
			smscode:$('#loginbox-reg-smscode').val(),
			pwd:$('#login-box-body-from-set-pwd').val()
		};

		console.log(data);

		if(!functions.checkMobile(data.mobile)){
			this.showError('手机号格式错误...');return;
		}else if(this.regLoading == false){
			var _this = this;
			$.ajax({
	            url: "/user-register",
	            type: 'post',
	            data: data,
	            dataType: 'json',
	            beforeSend: function () {
					_this.regLoading = true;
	                $('.login-box-btn-register').html('<i class="am-icon-spinner am-icon-pulse"></i>注册中...');
	            },
	            success: function (res) {
	                if(res.code == 200){
						$('.login-box-btn-register').html(' 注册成功<i class="am-icon-check"></i>');

						setTimeout(function(){
							_this.showBox('login');
							_this.regLoading = false;
						},2000);
					}else{
						_this.regLoading = false;
						$('.login-box-btn-register').html('立即注册');
						_this.showError(res.msg);return;
					}
	            },
	            error:function(){
					_this.regLoading = false;
					$('.login-box-btn-register').html('立即注册');
	            }
	        });
		}
	},
	sendSms:function(){

	},
	showError:function(msg){
		$('.login-box-error').text(msg).fadeIn().delay(3000).fadeOut();
	}
};

$(document).on('click','.login-box-btn-login',function(){
	userLogin.login();
});

$(document).on('click','.login-box-btn-register',function(){
	userLogin.register();
});

$(document).on('click','.login-box-body-tab > li',function(){
	$(this).addClass('login-box-body-tab-current').siblings().removeClass('login-box-body-tab-current');
	$('.login-box-body-from').find('fieldset').eq($(this).index()).show().siblings().hide();
});

$(document).on('click','#login-box-body-from-eye',function(){
	if($(this).hasClass('icon-yanjing_bi')){
		$('#login-box-body-from-set-pwd').attr('type','text');
		$(this).removeClass('icon-yanjing_bi').addClass('icon-yanjing_kai');
	}else{
		$('#login-box-body-from-set-pwd').attr('type','password');
		$(this).addClass('icon-yanjing_bi').removeClass('icon-yanjing_kai');
	}
});