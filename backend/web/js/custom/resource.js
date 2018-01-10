var Resource = function(){

	var loading = new Loading();


	var layout = function(){
		//瀑布流容器
		var $container = $('#masonry-container');

		// 等待图片加载完
		$container.imagesLoaded( function () {
			$container.masonry({
				itemSelector: '.item'
			});
		});

		// 浮层
		$('.mix-grid').mixitup().on("click",".remove",function(e){
			var _this = this,
				id = $(this).attr("data-id");

			Base.confirm("确定要删除文件？",function(){

				var params = {
					url: "/resource/delete",
					type: "POST",
					data: "id="+id,
					loading: "base",
					success: function(){
						location.reload();
						/*$container.masonry( 'remove', $(_this).closest(".item").get(0))
							.masonry('layout');*/

					},
					fail: function(ret){
						Base.alert(ret.msg);
					}
				};

				Base.ajax(params);
			})
		});
	};

	// 上传pdf
	var pdf = function(){
		var $modal = $("#pdf_modal"),
			$submit = $modal.find(".submit");

		var form = {
			file: function(){
				return Verify.file("#file");
			},
			name: function(){
				return Verify.empty("#name","input");
			}
		};

		$submit.on("click",function(){
			if(!Verify.submit(form)){ return;}

			var params = {
				url: "/resource/upload",
				type: "POST",
				dataType: "JSON",
				beforeSend: function(){
					loading.show();
				},
				success: function(ret){
					if(Base.success(ret)){
						location.reload();
					}else{
						Base.alert(ret.msg);
					}
				},
				complete: function(){
					loading.hide();
				}
			};

			$modal.find("form").ajaxSubmit(params);

		})
	};

	// 上传图片
	var uploader = function(){

		var $list = $("#file_list"),
			$action = $("#up_action");

		// 初始化
		var uploader = WebUploader.create({

			// swf文件路径
			swf:  "/js/public/plugin/uploader/Uploader.swf",

			// 文件接收服务端。
			server: "/resource/upload",

			// 选择文件的按钮。可选。
			// 内部根据当前运行是创建，可能是input元素，也可能是flash.
			pick: '#picker',

			// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
			resize: true,

			// 开起分片上传。
			chunked: true,
			// 允许同时最大上传进程数
			threads: 3,
			// 文件域名
			fileVal: "file",
			// 文件上传总数
			fileNumLimit: "10",
			// 文件总大小
			//fileSizeLimit: "",
			// 文件过滤
			accept: {
				title: 'Images',
				extensions: 'gif,jpg,jpeg,png',
				mimeTypes: 'image/gif,image/jpeg,image/jpg,image/png'
			}
		});

		// 选择文件
		uploader.on( 'fileQueued', function( file ) {

			var $li = $('<div id="' + file.id + '" class="file-item thumbnail">' +
							'<img>' +
							'<div class="info">' + file.name + '</div>' +
							'<span class="file-remove"><i class="fa fa-remove"></i></span>'+
						'</div>'),
				$img = $li.find('img');

			// 点击名称 删除
			$li.on('click', '.file-remove', function() {
				uploader.removeFile( file,true);
				$li.remove();
				// 删空
				if($list.find(".file-item").length <1){
					$action.removeClass("has-files has-fail");
				}
			});

			// $list为容器jQuery实例
			$list.append( $li );

			if(!$action.hasClass("has-files")){
				$action.addClass("has-files");
			}

			// 创建缩略图
			// 如果为非图片文件，可以不用调用此方法。
			// thumbnailWidth x thumbnailHeight 为 100 x 100
			uploader.makeThumb( file, function( error, src ) {
				if ( error ) {
					$img.replaceWith('<span>不能预览</span>');
					return;
				}

				$img.attr( 'src', src );
			}, 170, 90 );
		});

		// 修改上传参数
		uploader.on("uploadBeforeSend",function(object,data){
			data["type_name"] = "image";
		});

		// 文件上传过程中创建进度条实时显示。
		uploader.on( 'uploadProgress', function( file, percentage ) {
			var $li = $( '#'+file.id ),
				$percent = $li.find('.progress .progress-bar');

			// 避免重复创建
			if ( !$percent.length ) {
				$percent = $('<div class="progress progress-striped active">' +
								'<div class="progress-bar" role="progressbar" style="width: 0%"></div>' +
							'</div>').appendTo( $li ).find('.progress-bar');
			}

			$percent.css( 'width', percentage * 100 + '%' );
		});

		// 文件上传成功，给item添加成功class, 用样式标记上传成功。
		uploader.on( 'uploadSuccess', function( file ) {
			$( '#'+file.id ).addClass('upload-state-success')
				.append("<span class='file-success'><i class='fa fa-check-circle'></i></span>")
				.find(".file-remove").remove()
		});

		// 文件上传失败，显示上传出错。
		uploader.on( 'uploadError', function( file ) {
			var $li = $( '#'+file.id ),
				$error = $li.find('div.error');

			// 避免重复创建
			if ( !$error.length ) {
				$error = $('<div class="error"></div>').appendTo( $li );
			}

			$error.text('上传失败');
		});

		// 完成上传完了，成功或者失败，先删除进度条。
		uploader.on( 'uploadComplete', function( file ) {
			$( '#'+file.id ).find('.progress').remove();

			var infos = uploader.getStats();

			console.log(infos);
			// 队列已传完 并有上传失败的
			if(infos['progressNum'] == 0 && infos['queueNum'] == 0 && infos['uploadFailNum'] > 0){
				$action.removeClass("has-files").addClass("has-fail");
			}else if(infos['progressNum'] == 0 && infos['queueNum'] == 0 && infos['uploadFailNum'] == 0){

				bootbox.confirm({
					buttons: {
						confirm: {label: '是', className: 'blue'},
						cancel: {label: '否', className: 'default'}
					},
					message: "已全部上传成功，是否继续上传？",
					callback: function(result){
						if(result){
							$action.removeClass("has-fail has-files");
							// 重置队列
							uploader.reset();
							$list.html("");
						}else{
							$("#image_modal").modal("hide").on("hidden.bs.modal",function(){
								location.reload();
							});
						}
					}
				})
			}
		});

		// 开始上传
		$("#upload").on("click",function(){
			uploader.upload();
		});

		// 重新上传
		$("#reload").on("click",function(){
			uploader.retry();
		});

		return uploader;
	}

	var images = function(){
		var $modal = $("#image_modal"),
			webuploader = null;

		$("#images").on("click",function(){
			$modal.modal("show");
		});

		$modal.on("shown.bs.modal",function(){
			webuploader = uploader();
		});

		$modal.on("hidden.bs.modal",function(){
			webuploader.destroy();
			webuploader = null;
		});
	}








	return {
		init:function(){
			layout();
			pdf();
			images();
		}

	}
}();


$(document).ready(function(){
	Metronic.init();
	Layout.init();
	Resource.init();
});

