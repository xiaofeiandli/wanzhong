var Base = {
	alert: function(msg,fn){
		bootbox.alert({
			message: msg,
			callback: function(){
				fn && fn();
			}
		});
	},
	confirm: function(msg,fn){
		bootbox.confirm({
			buttons: {
				confirm: {label: '确认', className: 'blue'},
				cancel: {label: '取消', className: 'default'}
			},
			message: msg,
			callback: function(result){
				result && fn && fn();
			}
		})
	},
	success: function(ret){ // ajax请求返回结果正常
		return  ret.code == 0;
	},
	fail: function(ret){ // ajax请求结果与预期不符
		return ret.code == 999 && ret.msg == "您的账号未登录";
	},
	ajax: function(person,common){ // person 个性  common通用
		var that = this,
			l,
			loading;

		if(!person){console.log("ajax缺少必要参数"); return; }

		// 是否显示加载中
		if(person.loading == 'base' || (common && common.loading  == 'base')){ // 浮框加载
			var loadModal = new Loading();
			loading = {
				before: function(){loadModal.show()},
				complete: function(){loadModal.hide()}
			};
		}else if(person.loading == 'ladda'|| (common && common.loading == 'ladda')){ // 按钮加载
			l  = Ladda.create(person.btn ||common.btn );
			loading = {
				before: function(){ l.start(); },
				complete: function(){ l.stop(); }
			};
		}

		// 进行ajax
		$.ajax({
			url: person.url,
			type: person.type || "GET",
			data: person.data || "",
			dataType: person.dataType || "JSON",
			timeout: 5000 || person.timeout,
			beforeSend: function(){
				loading && loading.before();
				return true;
			},
			success: function(ret){ // 接口访问成功
				if(that.success(ret)){ // 结果正常
					common && common.success && common.success(ret);
					person.success && person.success(ret);
				}else if(that.fail(ret)){ // 结果未登录
					that.alert("账号未登录或登录失效,请重新登录",function(){
						location.reload(); // 跳转到登录页
					});
				}else{ // 其他错误结果
					common && common.fail && common.fail(ret);
					person.fail && person.fail(ret);
				}
			},
			error: function(ret){ // 接口访问失败
				if(person.console || (common && common.console)){ // 控制台打印错误
					console.log(ret.statusText);
				}else{ // 需要弹出错误
					that.alert(ret.statusText);
				}
			},
			complete: function(){
				loading && loading.complete();
			}
		})
	},
	icheck: function(container){ // 调用icheck插件
		var $checkbox = container.find("input[type=checkbox]"),
			$radio = container.find("input[type=radio]");
		$checkbox.get(0) && $checkbox.iCheck({ checkboxClass:"icheckbox_minimal-grey" });
		$radio.get(0) && $radio.iCheck({ radioClass:"iradio_minimal" });
	}
};

// 加载框
function Loading(){

	var dialog = "<div class='modal-dialog' style='text-align: center; height: 100%; margin: 0 auto;'>" +
					"<img src='/images/loading.gif' style='vertical-align: middle;'>"+
					"<span style='display: inline-block; height: 100%; vertical-align: middle;'></span>"+
				"</div>";

	this.$modal = $("<div/>",{
		class: "modal fade",
		tabindex: "-1",
		"aria-hidden": true,
		"data-backdrop": "static",
		html: dialog
	}).appendTo("body");

}
Loading.prototype.show = function(){
	this.$modal.modal("show");
};
Loading.prototype.hide = function(){
	var that = this;
	this.$modal.modal("hide");
	setTimeout(function(){
		that.$modal.remove();
	},500)
};

// 模态框
function Modals(params){

	var id = params && params.id || "",
		size = params && params.size || "",
		type = params && params.type || "static";

	this.$modal = $("<div/>",{
		id: id,
		class: "modal fade",
		tabindex: "-1",
		"aria-hidden": true,
		"data-backdrop": type
	}).appendTo("body");

	this.$dialog = $("<div/>",{
		class: size ? "modal-dialog" + " modal-"+size : "modal-dialog"
	}).appendTo(this.$modal);

	var $content = this.$content = $("<div/>",{
		class: "modal-content"
	}).appendTo(this.$dialog);

	this.$modal.on("hidden.bs.modal",function(){
		$content.html("");
	});

}

Modals.prototype.show = function(){
	this.$modal.modal("show");
};

Modals.prototype.add = function(html){
	this.$content.html(html);
	this.show();
};

Modals.prototype.hide = function(){
	this.$modal.modal("hide");
};
Modals.prototype.init = function(){
	this.$modal.modal("hide");
	this.$content.html("");
};
Modals.prototype.size = function(){
	size && this.$dialog.removeClass("modal-"+size);
};

// 图片上传
function Files(params){

	var that = this;

	this.$modal = $("<div/>",{
		class: "modal fade",
		tabindex: "-1",
		//style: "/*background-image: url('/image/public/bg.png')*/",
		"aria-hidden": true,
		"data-backdrop": "static"
	}).appendTo("body").on("hidden.bs.modal",function(){
		$form.find(".rm").click();
	});

	var $dialog = $("<div/>",{
		class: "modal-dialog"
	}).appendTo(this.$modal);


	var $content = $("<div/>",{
		class: "modal-content"
	}).appendTo($dialog);

	$("<div/>",{
		class: "modal-header",
		html: "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button><h4 class='modal-title'>上传图片</h4>"
	}).appendTo($content);

	var $body = $("<div/>",{
		class: "modal-body"
	}).appendTo($content);

	var form = "<div class='form-group margin-top-10'>" +
					"<label class='col-md-3 control-label'>选择图片</label>"+
					"<div class='col-md-7'>" +
						"<div class='fileinput fileinput-new' data-provides='fileinput'>" +
							"<div class='fileinput-preview thumbnail' style='width:315px;height:160px;'></div>"+
							"<div>" +
								"<span class='btn green btn-file' style='margin-right: 10px;'>" +
									"<span class='fileinput-new'>选择图片</span>"+
									"<span class='fileinput-exists'>修改</span>"+
									"<input type='file' class='resource' name='img' accept='image/gif,image/jpeg,image/jpg,image/png'>"+
								"</span>"+
								"<span class='btn red fileinput-exists rm' data-dismiss='fileinput'>移除</span>"+
							"</div>"+
							"<input type='hidden' name='fileurl' value ='"+ params.address +"'>"+
						"</div>"+
						"<div class='help-block'></div>"+
						"<div class='help-block has-error'></div>"+
						"<input type='hidden' name='cut' value='"+params.cut+"'>"+
					"</div>"+
				"</div>";

	var $form = $("<form/>",{
		role: "form",
		class: "form-horizontal",
		enctype: "multipart/form-data",
		html: form
	}).appendTo($body);

	var $footer = $("<div/>",{
		class: "modal-footer",
		html: "<button type='button' class='btn btn-default' data-dismiss='modal'>关闭</button>"
	}).appendTo($content);

	$("<button/>",{
		type: "button",
		class: "btn blue submit mt-ladda-btn ladda-button",
		"data-style": "zoom-in",
		html: "<span class='ladda-label'>提交</span>",
		click: function(){
			// 检测是否有选择图片
			if(!$form.find(".resource").val()){return;}

			var //l = Ladda.create(this),
				option = {
					type: "POST",
					url:  "/upload/putfile",
					dataType: "JSON",
					success: function(ret){
						if(Base.success(ret)){
							that.hide();
							params.callback && params.callback(ret.data);
						}else{
							Base.alert(ret.msg);
						}
					},
					error: function(ret){
						Base.alert(ret.statusText);
					},
					complete: function(){
						//l.stop();
					}
				};

			//l.start();
			$form.ajaxSubmit(option);

		}
	}).appendTo($footer);
}

Files.prototype.show = function(){
	this.$modal.modal("show");
};

Files.prototype.hide = function(){
	this.$modal.modal("hide");
};


// id: 富文本容器
function Summernote(id){

	var that = this;

	this.editor = $(".summernote", "#" + id);

	var picButton = function () {
		var ui = $.summernote.ui;

		// create button
		var button = ui.button({
			contents: '<span data-toggle="modal"><i class="note-icon-picture"/></span> ',
			tooltip: '上传图片',
			click: function(){
				editFile.show();
			}
		});

		return button.render();
	};

	// 编辑器图片上传
	var editFile = new Files({
		cut: 2,
		address: "/portal/editor/content/",
		callback: function(ret){
			that.editor.summernote('insertImage',ret, 'img');
		}
	});

	this.editor.summernote({
		lang: 'zh-CN',
		height: 600,
		disableDragAndDrop: true,
		dialogsInBody: true,
		dialogsFade: true,
		myId: id, //给上传图片添加class
		toolbar: [
			['tag', ['style']],
			['hr',['hr']],
			['style', ['bold','italic', 'underline', 'strikethrough','superscript', 'subscript']],
			['font', ['color','fontsize']],
			['para', ['ul', 'ol','paragraph']],
			['undo',['clear','undo']],
			['media',['link','pic','video','codeview']]
		],
		maximumImageFileSize: 1024 * 1024,  //图片大小不能超过1M
		buttons: {
			pic: picButton
		},
		callbacks: {
			onPaste: function (ne) { //消除粘贴过来的格式
				var bufferText = ((ne.originalEvent || ne).clipboardData || window.clipboardData).getData('text/plain');

				ne.preventDefault ? ne.preventDefault() : (ne.returnValue = false);

				setTimeout(function () {
					document.execCommand("insertText",true,bufferText);
				}, 10);
			}
		}
	});
}
Summernote.prototype.content = function(){
	return this.editor.summernote("code");
};

Summernote.prototype.isEmpty = function(){
	return this.editor.summernote("isEmpty");
};

Summernote.prototype.empty = function(){
	this.editor.summernote("empty");
};

Summernote.prototype.destroy = function(){
	this.editor.summernote("destroy");
};


$(document).ready(function(){

	// 获取昵称
	var params = {
		url: "/manager/getmanagername",
		console: true,
		success: function(ret){
			$("#nickname").html('hi, '+ret.data.name);
		},
		fail: function(ret){
			console.log(ret.msg);
		}
	};
	Base.ajax(params);



	var $datePicker = $("#date_picker");

	$datePicker.get(0) && datePlugin($datePicker);

	function datePlugin($picker){

		var date = new Date(),
			month = date.getMonth()+ 1,
			day = date.getDate();

		month = month < 10 ? "0"+month : month;
		day = day < 10 ? "0"+ day : day;

		$picker.find("input").attr("placeholder", date.getFullYear()+"-"+ month + "-"+ day );

		$picker.datepicker({
			format: "yyyy-mm-dd",
			container: ".page-container",
			autoclose: true
		});
	}

	// 退出登录
	$("#logout").click(function(){
		var params = {
			url: "/manager/signout",
			success: function(){
				location.reload();
			},
			fail: function(ret){
				Base.alert(ret.msg);
			}
		};
		Base.ajax(params);
	});

});
