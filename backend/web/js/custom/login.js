var Login = function(){

	var loading = new Loading();

	$("#login_submit").on("click",function(){

		var user = $("#user").val(),
			pwd = $("#pwd").val(),
			tip = $(".alert","#login");

		if( user.length > 0 && pwd.length > 0 ){

			$.ajax({
				url: "/manager/signin",
				type: "POST",
				data: { username: user , password: pwd},
				dataType: "JSON",
				beforeSend: function(){
					tip.hide();
					loading.show();
				},
				success: function(data){
					if(Base.success(data)){
						location.href = "/";
					}else{
						tip.show().find("span").text(data.msg);
					}
				},
				error: function(ret){
					tip.show().find("span").text(ret.statusText);
				},
				complete: function(){
					loading.hide();
				}
			})
		}else if(user.length == 0){
			tip.show().find("span").text("请输入用户名");
		}else{
			tip.show().find("span").text("请输入密码");
		}
	});

	$(document).on("keypress",function(e){
		var keycode = (e.keyCode ? e.keyCode : e.which);
		if(keycode == 13){
			$("#login_submit").click();
		}
	})
};

var Resetpwd = function(){

	var loading = new Loading();

	var resetForm = {
		oldPwd: function(){
			return Verify.pwd("#old_pwd");
		},
		newPwd: function(){
			return Verify.pwd("#new_pwd");
		},
		rePwd: function(){
			return Verify.repwd("#new_pwd","#re_pwd");
		}
	};

	$("#reset_pwd").on("click",function(){

		if(Verify.submit(resetForm)){
			loading.show();
			$.ajax({
				url:"/manager/newpwd",
				data: $("#reset").serialize(),
				type: "POST",
				dataType: "JSON",
				success: function(ret){
					if (Base.success(ret)) {
						Base.alert("密码修改成功,请重新登录",function(){
							setTimeout(function(){
								location.reload();
							},300);
						})
					}else{
						Base.alert(ret.msg);
					}
				},
				error: function(ret){
					Base.alert(ret.statusText);
				},
				complete: function(){
					loading.hide();
				}
			})
		}
	});
}
