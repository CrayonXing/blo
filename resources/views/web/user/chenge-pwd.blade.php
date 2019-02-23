@extends('web.layouts.blog-layout')

@section('content')
<article>
 	  @include('web.layouts.web-main-left')

	  <div class="web-main-right">
	    <div class="web-main-breadcrumb">
	         <p><a>会员中心</a> <span>/</span> <a>修改密码</a></p>
	    </div>
	    <div class="web-main-content" style="padding: 10px;padding-right: 310px;padding-top: 50px;">
	        <form class="am-form am-form-horizontal">
	        	<div class="am-form-group">
			    <div class="am-u-sm-12" style="text-align: right;">
			     	<div id="fr-changepwd-error" style="display: none;width: 289px;height: 25px;margin-right: 1px;background-color: #fcebeb;line-height: 25px;text-align: center;color: #df8644;float: right;">旧密码不能为空</div>
			    </div>
			  </div>
			  <div class="am-form-group">
			    <label  class="am-u-sm-6 am-form-label" style="font-weight: initial;">旧密码</label>
			    <div class="am-u-sm-6">
			      <input type="password"  placeholder="旧密码不能为空" id="fr-changepwd-oldpwd" >
			    </div>
			  </div>

			  <div class="am-form-group">
			    <label  class="am-u-sm-6 am-form-label" style="font-weight: initial;">新密码</label>
			    <div class="am-u-sm-6">
			      <input type="password"  placeholder="新密码不能为空" id="fr-changepwd-newpwd" class="am-input-sm">
			    </div>
			  </div>

			  <div class="am-form-group">
			    <label  class="am-u-sm-6 am-form-label" style="font-weight: initial;">确认密码</label>
			    <div class="am-u-sm-6">
			      <input type="password"  placeholder="确认密码必须与新密码一致"  id="fr-changepwd-newpwd2" class="am-input-sm">
			      <p class="am-form-help">注: 密码格式必须为8~16位字母+数字</p>
			    </div>
			  </div>

			  <div class="am-form-group">
			    <div class="am-u-sm-6 am-u-sm-offset-6">
			      <span  class="theme-btn" onclick="changPwdObj.submit()" >立即修改</span>
			    </div>
			  </div>
			</form>
	    </div>
	  </div>
</article>

@endsection

@push('scripts')
  	<script type="text/javascript">

  		var changPwdObj = {
  			loading:false,
  			showError(text){
  				$('#fr-changepwd-error').text(text).fadeIn().delay(3000).fadeOut();
  			},
  			submit(){
				var data = {
	  				oldpwd:$('#fr-changepwd-oldpwd').val(),
	  				newpwd:$('#fr-changepwd-newpwd').val(),
	  				newpwd2:$('#fr-changepwd-newpwd2').val()
	  			};

	  			if(functions.isEmptyStr(data.oldpwd)){
	  				this.showError('旧密码不能为空');
	  			}else if(functions.isEmptyStr(data.newpwd)){
	  				this.showError('新密码不能为空');
	  			}else if(!functions.checkPassword(data.newpwd)){
	  				this.showError('新密码格式错误');
	  			}else if(data.newpwd != data.newpwd2){
					this.showError('确认密码输出错误');
	  			}else if(this.loading == false){
	  				$.ajax({
	                    url: "/user-edit-pwd",
	                    type: 'post',
	                    data: data,
	                    dataType: 'json',
	                    beforeSend: function () {
	                        changPwdObj.loading = true;
	                    },
	                    success: function (res) {
	                        if(res.code == 200){
	                            $('#fr-changepwd-oldpwd').val(''),
				  				$('#fr-changepwd-newpwd').val(''),
				  				$('#fr-changepwd-newpwd2').val('')
	                        }

                            changPwdObj.showError(res.msg);
	                        changPwdObj.loading = false;
	                    },
	                    error:function(){
	                        changPwdObj.showError('网络繁忙，请稍后再试...');
							 changPwdObj.loading = false;
	                    }
	                });
	  			}
  			}
  		};
  	</script>
@endpush