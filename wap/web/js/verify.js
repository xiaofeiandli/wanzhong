// 验证
var Verify = function(){

	//正则验证
	var regs = {
		telephone:/^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/,
		cellphone: /^(1[3|4|5|7|8])\d{9}$/,
		email: /^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,5})+$/,
		id: /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|[X|x])$/
	};

	var tips = {
		zh:{
			empty: "内容不能为空",
			company: "请填写公司名称",
			name: "请填写姓名",
			position: "请填写职位",
			area: "请选择参展面积",
			classes: "请选择参展种类",
			email: "请填写正确的邮箱地址",
			province: "请选择省份/直辖市",
			city: "请选择城市",
			address: "请填写详细地址",
			cellphone: "请填写正确的手机号",
			special: "含有非法字符",
			id: "请填写正确的身份证号码"
		},
		en:{
			empty: "Details required",
			company: "Please enter company name",
			name: "Please enter full name",
			position: "Please enter job title",
			area: "Please choose exhibition area",
			classes: "Please choose business field",
			email: "Please enter correct E-mail address",
			province: "Please choose province",
			city: "Please choose city",
			address: "Please enter address",
			cellphone: "Please enter mobile phone",
			telephone: "Please enter telephone number",
			special: "Contain illegal character",
			id: " Please enter correct ID NO."
		}
	}

	$(document).ready(function(){
		var lang = $("#en").get(0) ? "en" : "zh";
		tips =  tips[lang];
	});

	return {
		/**
		 * id 输入框id
		 * type  输入框类型 input textarea
		 * name 验证类型
		 */
		empty: function(id,type,name,foucus){
			var $container = $(id),  // 容器
				$help = $container.find(".help-block"),
				$edit = $container.find(type), // 输入框
				val = $edit.val(); // 输入值

			// 提示框置空
			$help.text("");
			// 去除 error
			$container.removeClass("has-error");

			if( val == "" ){ // 若为空
				foucus && $edit.focus(); // 获取焦点
				$help.text(tips[name]); // 提示语
				$container.addClass("has-error");
				return false;
			}
			return val;
		},
		/*
		 * id 容器id
		 * name  验证类型
		 */
		reg: function(id,name,foucus){
			var $container = $(id),
				$help = $container.find(".help-block"),
				$input = $container.find("input"),
				val = $input.val();

			if(regs[name].test(val)){ // 验证通过
				$help.text("");
				$container.removeClass("has-error");
				return val;
			}else{
				foucus && $input.focus();
				$help.text(tips[name]);
				$container.addClass("has-error");
				return false;
			}
		},
		/**
		 * id 选择框容器
		 * name 验证类型
		 */
		select: function(id,name,foucus){
			var $container = $(id),
				$help = $container.find(".help-block"),
				$select = $container.find("."+name),
				val = $select.val();

			if(val){
				$help.text("");
				$container.removeClass("has-error");
				return val;
			}else{
				$help.text(tips[name]);
				foucus && $select.focus()
				$container.addClass("has-error");
				return false;
			}
		}
	}
}();