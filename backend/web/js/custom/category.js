
	var Category = function(){

		var $table = $("#categories");

		var cateModal = new Modals();


		var cateForm = {
			name: function(){
				return true;
			}
		};

		// 添加新栏目
		var addCate = function(){

			$("#add_cate").on("click", function(){
				var params = {
					url: "/category/newcate?r=" + Math.random(),
					icheck: true
				};
				Action.add(params,cateModal,function(){

					var params = {
						type: "POST",
						url: "/category/addcate",
						submit: cateForm
					}

					Action.submit(params,cateModal);
				})
			})
		};

		// 发布、取消栏目
		var publish = function(){
			$table.on("click",".publish",function(){
				var _this = this,
					id = $(this).attr("data-id"),
					status = $(this).attr("data-status"),
					params = {
						btn: _this,
						status: status,
						type: "POST",
						data: "cid="+id + "&status="+status,
						url: "/category/editstatus?r=" + Math.random()
					};

				Base.confirm(status == 1 ? "确定要发布此栏目？" : "确定要下架此栏目？", function () {
					Action.publish(params);
				});
			})
		};

		// 编辑栏目
		var edit = function(){
			$table.on("click",".edit",function(){
				var id = $(this).attr("data-id"),
					params = {
						url: "/category/newcate",
						type: "POST",
						data: "cid="+id,
						icheck: true
					}

				Action.add(params,cateModal,function(){
					var params = {
						url: "/category/addcate",
						type: "POST",
						data: "cid="+id,
						submit: cateForm
					};

					Action.submit(params,cateModal);
				})
			})
		};

		// 删除栏目
		var del = function(){

			$table.on("click",'.delete',function(){

				var that = this,
					id = $(this).attr("data-id"),
					params = {
						this: that,
						type: "POST",
						url: "/category/catedel",
						data: "cid="+id
					};

				Base.confirm("删除不可恢复，确定要删除吗？",function(){
					Action.del(params);
				});

			})
		}
		return {
			init: function(){
				addCate();
				publish();
				edit();
				del();
			}
		}
	}()


	$(document).ready(function() {
		Metronic.init();
		Layout.init();
		Category.init();

	})


