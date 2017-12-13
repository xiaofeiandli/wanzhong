var  Nav = function(){

	var $table = $(".navigators");

	// 表单
	var navForm = {
		name:function(){
			return true;
		}
	};

	// 弹框
	var navModal = new Modals();


	// 添加新导航
	var addNav = function(){
		$("#add_nav").on("click",function(){
			var params = {
				url: "/navigator/newnav?r=" + Math.random()
			};

			Action.add(params,navModal,function(){

				var params = {
					url: "/navigator/addnav",
					type: "POST",
					submit: navForm
				};

				Action.submit(params,navModal);

			})
		})
	};

	// 编辑导航
	var edit = function(){

		$table.on("click",".edit",function(){
			var id = $(this).attr("data-id"),
				params = {
					url: "/navigator/newnav",
					type: "POST",
					data: "nid="+id
				};

			Action.add(params,navModal,function(){

				var params = {
					url: "/navigator/addnav",
					type: "POST",
					submit: navForm,
					data: "nid="+id
				};

				Action.submit(params,navModal);
			});

		})

	};

	var del = function(){

		$table.on("click",".delete",function(){
			var _this = this,
				id = $(this).attr("data-id"),
				params = {
					url: "/navigator/navdel",
					type: "POST",
					data: "nid="+id,
					this: _this
				};

			Base.confirm("删除后不可恢复，确定要删除？",function(){
				Action.del(params);
			});

		});
	}

	return {
		init: function(){
			addNav();
			edit();
			del();
		}
	}
}();

$(document).ready(function(){
	Metronic.init();
	Layout.init();
	Nav.init();
});


