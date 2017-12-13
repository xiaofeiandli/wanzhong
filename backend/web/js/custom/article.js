// 文章页面
var Article = function(){

	// 列表 ID
	var $table = $("#article"),
		$addNews = $("#new_article"),
		isNews = $addNews.attr("data-isnews");

	// 生成文章模态框
	var articleModal = new Modals({
		size: "lg",
		id: "article_modal"
	});

	// 中文缩略图
	var thumbFile = new Files({
		cut: 1,
		callback: function(ret){
			var $view = $("#thumb");
			$view.find('.thumb').html('<img height="150" width="200" src="'+ ret +'">');
			$view.find(".thumb_h").val(ret);
			thumbFile.hide();
		}
	});

	// 英文缩略图
	var enthumbFile = new Files({
		cut: 1,
		callback: function(ret){
			var $view = $("#thumb_en");
			$view.find('.thumb').html('<img height="150" width="200" src="'+ ret +'">');
			$view.find(".thumb_h").val(ret);
			enthumbFile.hide();
		}
	});

	// 文章验证
	var articleForm = {

	};


	function articleAction(thumb){
		var $thumb = $(thumb),
			$thumb_en = $(thumb+"_en");

		// 显示缩略图上传框
		$thumb.find(".thumb-btn").on("click",function(){
			thumbFile.show();
		});
		$thumb_en.find(".thumb-btn").on("click",function(){
			enthumbFile.show();
		});

		// 删除缩略图
		$thumb.find(".del").on("click",function(){
			$thumb.find(".thumb").html("");
			$thumb.find(".thumb_h").val("");
		});
		$thumb_en.find(".del").on("click",function(){
			$thumb.find(".thumb").html("");
			$thumb.find(".thumb_h").val("");
		});

		// 调用富文本
		new Summernote("content");

		new Summernote("content_en");

		// 调用时间插件
		/*articleModal.$content.find(".datetime-picker").datetimepicker({
			format: "yyyy-mm-dd HH:ii:ss",
			container: "#article_modal",
			autoclose: true
		});*/
	}

	// 添加新文章
	var addArticle = function(){


		$addNews.on("click",function() {

			var params = {
				url: "/article/newarticle",
				type: "POST",
				icheck: true,
				data: "isnews=" + isNews
			};

			Action.add(params, articleModal, function () {

				var params = {
						url: "/article/addarticle",
						data: "isnews=" + isNews,
						form: articleForm,
						edit: "content",
						type: "POST",
						success: function () {
							articleModal.hide();
							Base.alert("文章添加成功", function () {
								location.reload();
							});
						}
					};

				articleAction("#thumb");

				Action.submit(params, articleModal);
			})
		});
	};

	// 查看文章详情
	var detailArticle = function(){
		$table.on("click",".detail",function(){
			var id = $(this).attr("data-id"),
					params = {
						url: "/article/articledetail",
						type: "POST",
						data: "aid="+id
					};

			Action.add(params,articleModal);
		})
	};

	// 编辑文章
	var editArticle = function(){

		$table.on("click",".edit",function(){
			var id = $(this).attr("data-id"),
				params = {
					url: "/article/newarticle",
					data: "aid="+id+"&isnews="+isNews,
					type: "POST",
					icheck: true
				};

			Action.add(params,articleModal,function(){

				var params = {
						url: "/article/editarticle",
						type: "POST",
						data: "aid="+id+"&isnews="+isNews,
						edit: "content",
						form: articleForm,
						success: function(){
							articleModal.hide();
							Base.alert("修改成功",function(){
								location.reload();
							})
						}
				};

				articleAction("#thumb");

				Action.submit(params,articleModal);
			})
		})
	};


	//文章启用/停用
	var toggleArticle = function(){

		$table.on("click",".status",function(){
			var id = $(this).attr("data-id"),
					status = $(this).attr("data-status"),
					params = {
						url: "/article/changeartst",
						type: "POST",
						data: "aid="+id+ "&status="+status
					};

			Action.status(params);
		})
	};

	// 删除文章
	var delArticle = function(){
		$table.on("click",".delete",function(){
			var _this = this,
				id = $(this).attr("data-id"),
				params = {
					url: "/article/delarticle",
					type: "POST",
					this: _this,
					data: "aid="+id
				};

			Base.confirm("确定要删除？",function(){
				Action.del(params);
				location.reload();
			})
		})
	};


	return {
		init: function(){
			addArticle();
			detailArticle();
			editArticle();
			toggleArticle();
			delArticle();
		}
	}
}();

$(document).ready(function(){

	Metronic.init();
	Layout.init();
	Article.init();
});