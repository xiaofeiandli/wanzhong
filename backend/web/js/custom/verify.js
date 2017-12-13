// 验证
var Verify = function(){

	//正则验证

	var regs = {
		special: /[`~!@#$%^&*_\+\-=\[\]{}\\|\/]/,
		pwd:  /^(?![^a-zA-Z]+$)(?!\D+$).{6,16}$/,
		email: /^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,5})+$/
	};

	var tips = {
		empty: "内容不能为空",
		email: "请输入正确的邮箱地址",
		file: "文件不能为空",
		special: "含有非法字符",
		pwd: "密码必须同时包含数字和字母且长度在6-16位之间",
		repwd: "两次输入的密码不一致"
	};

	return {
		empty: function(id,type){
			var container = $(id),
				input = container.find(type),
				val = $.trim(input.val()),
				help = container.find(".help-block");

			help.text("");
			container.removeClass("has-error");

			if( val == "" ){
				input.focus();
				help.text(tips.empty);
				container.addClass("has-error");
				return false;
			}
			return true;
		},
		email: function(id){
			var container = $(id),
				val = container.find("input").val(),
				help = container.find(".help-block");

			help.text("");
			container.removeClass("has-error");

			if(regs.email.test(val)){
				help.text("");
				container.removeClass("has-error");
				return true;
			}else{
				help.text(tips.email);
				container.addClass("has-error");
				return false;
			}
		},
		pwd: function(id){
			var container = $(id),
				input = container.find("input"),
				val = $.trim(input.val()),
				help = container.find(".help-block");


			if(regs.pwd.test(val)){
				help.text("");
				container.removeClass("has-error");
				return true;
			}else{
				help.text(tips.pwd);
				input.focus();
				container.addClass("has-error");
				return false;
			}
		},
		repwd: function(id1,id2){
			var pwd = $("input",id1).val(),
				re_pwd = $("input",id2).val();
			if(pwd != re_pwd){
				$(id2).addClass("has-error").find(".help-block").text(tips.repwd);
				$("input",id2).focus();
				return false;
			}
			$(id2).removeClass("has-error").find(".help-block").text("");
			return true;
		},
		file: function(id){
			var $con = $(id),
				val = $con.find("input").val(),
				$help = $con.find(".help-block");

			if(val && val.length > 0){
				$con.removeClass("has-error");
				$help.text("");
				return true;
			}else{
				$con.addClass("has-error");
				$help.text(tips.file);
				return false;
			}
		},
		edit: function(id){
			var container = $(id),
				note = container.find(".summernote");

			container.removeClass("has-error").find(".help-block").text("");

			if(note.summernote("isEmpty")){
				note.summernote("focus");
				container.addClass("has-error").find(".help-block").text(tips.empty);
				return false;
			}
			return true;
		},
		submit: function(obj){  //提交前验证

			if(obj){
				for(var i in obj){
					if(obj.hasOwnProperty(i) && !obj[i]() ){
						return false;
					}
				}
				return true;
			}

		}
	}
}();


// 列表页操作
var Action = function(){

	// 将参数类型转为对象
	function splitData(str,obj){
		var param = obj || {},
			datas = str.split("&");

		if(str.length<1){return;}

		for(var i = 0; i < datas.length; i++){
			var data = datas[i].split("=");
			if(data.length == 2){
				param[data[0]] = data[1];
			}else{
				console.log(datas[i] + ": 类型错误");
			}
		}
		return param;
	}

	return {
		// modal框添加添加内容
		add: function(params,modal,fn){   // params 为个性参数，modal 为模态框 ,fn为后续操作

			var common = {
				loading: "base",
				success: function(ret){

					// 模态框添加内容，并显示
					modal.add(ret.data);

					// 若有选框，调用icheck
					params.icheck && Base.icheck(modal.$content);

					// 回调函数
					fn && fn(ret);
				},
				fail: function(ret){
					Base.alert(ret.msg);
				}
			};
			Base.ajax(params,common);
		},
		submit: function(params,modal){  // modal提交表单

			if(params.data){
				var obj = splitData(params.data);
			}

			modal.$content.find(".submit").on("click",function () {
				var _this = this,
					data = modal.$content.find("form").serialize(),
					common = {
						btn: _this,
						loading: "base",
						success: function(){
							modal.hide();
							setTimeout(function(){
								location.reload();
							},300)

						},
						fail: function(ret){
							params.data = "";
							Base.alert(ret.msg);
						}
					};
				data = data.replace(/\+/g," ");   // g表示对整个字符串中符合条件的都进行替换
				data = decodeURIComponent(data);
				obj = splitData(data,obj);

				if(params.checkbox){ // 若有复选框
					var arr = [];
					modal.$content.find("."+params.checkbox).each(function(){
						arr.push(this.value);
					});
					obj[params.checkbox] = arr.toString();
				}

				if(params.edit){ // 若有富文本编辑器
					obj[params.edit] = $(".summernote","#"+params.edit).summernote("code");
					obj["en_"+params.edit] = $(".summernote","#"+params.edit+ "_en").summernote("code");
				}

				params.data = obj;

				//console.log(params.data);

				if (params.submit || Verify.submit(params.form)) {
					Base.ajax(params,common);
				}else{
					//params.data = "";
				}
			})
		},
		status: function(params){
			var action = {
				loading: "base",
				console: true,
				success: function(){
					location.reload();
				},
				fail: function(ret){
					Base.alert(ret.msg);
				}
			};

			Base.ajax(params,action);

		},
		publish: function(params){

			var action = {
				loading: "base",
				success: function(){
					if (params.status == 1) {

						$(params.btn).text("已发布").removeClass("yellow").addClass("green").attr({
							"data-status": 0,
							"data-original-title": "点击取消发布"
						});
					} else {

						$(params.btn).text("未发布").removeClass("green").addClass("yellow").attr({
							"data-status": 1,
							"data-original-title": "点击发布"
						});
					}
				},
				fail: function(ret){
					Base.alert(ret.msg);
				}
			};
			Base.ajax(params,action);
		},
		del: function(params){  //删除操作
			var common = {
				loading: "base",
				success: function(){
					$(params.this).closest("tr").remove();
				}
			};
			Base.ajax(params,common);
		},
		checkAll: function(){

			$(".group-checkable").change(function(){
				var parent = $(this).attr("data-set"),
					isCheck = $(this).is(":checked");

				$(".group-checkable").prop("checked",isCheck);
				$(parent).find(".checkboxes").prop("checked",isCheck);
			})
		},
		checkParent: function(){

			$(".child-checkbox").on("ifChanged",function(){
				var $container = $(this).closest(".input-group"),
					$parent = $container.find(".parent-checkbox"),
					$siblings = $container.find(".child-checkbox"),
					checkNum = 0,
					check;

				for(var i = 0; i< $siblings.length; i++){

					if($siblings.eq(i).is(":checked")){
						checkNum++;
					}
				}
				check = checkNum > 0? "check" : "uncheck";

				$parent.iCheck(check);
			});

			$(".parent-checkbox").on("ifClicked",function(){
				var $container = $(this).closest(".input-group"),
					$children = $container.find(".child-checkbox"),
					isCheck = !$(this).is(":checked"),
					check;

				check = isCheck ? "check" : "uncheck";
				for(var i = 0; i< $children.length; i++){
					$children.eq(i).iCheck(check);
				}
			});
		}
	}
}();