/**
 * Created by yxb on 2017/8/18.
 */
(function(){

	var lang = $("#en").get(0) ? "en" : "zh",
		url = lang == "en" ? "/en/" : "/";

	lang == "zh" && $("body").attr("id","zh");


	// 加载框
	function Modals(type){

		var content = {},
			title = {
				zh: "请输入验证码",
				en: "Please enter verification code"
			};

		content.loading = "<div class='sm-modal-content'>" +
								"<img src='/images/loading.gif'>"+
							"</div>";


		content.code = "<div class='sm-modal-content'>"+
							"<div class='verify-container'>"+
								"<h3 class='verify-title'>"+ title[lang] +"</h3>"+
								"<div class='verify-content'>"+
									"<div class='form-item'>"+
										"<input class='form-control verify-code' maxlength='6'>"+
									"</div>"+
									"<img class='verify-image' src>"+
								"</div>"+
							"</div>"+
						"</div>";

		this.$cover = $("<div/>",{class: "modal-cover"}).appendTo("body");

		this.$modal = $("<div/>",{
			class: "modals",
			html: "<div class='sm-modal-dialog'>"+content[type]+"</div>"
		}).appendTo("body");

		if(type == "code"){
			this.$code = this.$modal.find(".verify-code");
			this.$image = this.$modal.find(".verify-image");
		}

	}
	Modals.prototype.show = function(){
		this.$cover.fadeIn();
		this.$modal.css({
			visibility: 'visible'
		}).fadeIn();
	};
	Modals.prototype.hide = function(){
		this.$cover.fadeOut();
		this.$modal.css({
			visibility: 'hidden'
		}).fadeOut();
	};

	var loading = new Modals('loading');

	var Index =  function(){
		var index = 0,
			 n = 0,
			$banners = $("#banners"),
			$banner = $banners.find(".banner-item"),
			len = $banner.length;

		$banners.find(".banner-image").load(function(){
			++n == len && timer();

		}).each(function(){

			this.complete && ++n == len && timer();

		});

		function timer(){
			setInterval(function(){
				$banner.eq(index).animate({
					"left": "-100%"
				},2000,function(){
					$(this).css("left","100%");
					index = index+1 == len ? 0 : index+1
				});

				$banner.eq(index+1 == len ? 0 : index+1).animate({
					"left": "0"
				},2000);
			},5000);
		}

	};

	// 报名信息
	var Apply = function(){

		var type = $("#apply").attr("data-type"),
			$title = $("#apply_title"),
			title = $title.text(),
			$form = $("#apply_form"),
			$info = $("#apply_info"),
			$result = $("#apply_result"),
			right = false,
			datas = {
				type: function(){
					var n = 0;
					if( type == "media"){
						n = 1;
					}else if(type == "company"){
						n = 2;
					}
					return n;
				}()
			};


		$("#company").find("input").on("blur",function(){
			Verify.empty("#company","input","company");
		});

		$("#name").find("input").on("blur",function(){
			Verify.empty("#name","input","name");
		});

		$("#position").find("input").on("blur",function(){
			Verify.empty("#position","input","position");
		});

		$("#cellphone").find("input").on("blur",function(){
			Verify.reg("#cellphone","cellphone");
		});

		$("#telephone").find("input").on("blur",function(){
			Verify.telephone("#telephone");
		});

		$("#email").find("input").on("blur",function(){
			Verify.reg("#email","email");
		});

		$("#address").find("select").on("blur change",function(){
			var name = $(this).attr("name");
			Verify.select("#address",name);
		}).end().find("input").on("blur",function(){
			Verify.empty("#address","input","address");
		});

		$("#area").find("select").on("blur change",function(){
			Verify.select("#area","area")
		});

		$("#classes").find("select").on("blur change",function(){
			Verify.select("#classes","classes")
		});


		// 所有表单
		var Form = {
			company: function(){
				return Verify.empty("#company","input","company",true);
			},
			media: function(){
				return Verify.empty("#company","input","company",true);
			},
			name: function(){
				return Verify.empty("#name","input","name",true);
			},
			certificate_type: function(){
				return $("#id").find("select").val();
			},
			certificate_number: function(){

				return Verify.reg("#id","id",true);
			},
			position: function(){
				return Verify.empty("#position","input","position",true);
			},
			cellphone: function(){
				return Verify.reg("#cellphone","cellphone",true);
			},
			telephone: function(){
				return Verify.telephone("#telephone",true);
			},
			email: function(){
				return Verify.reg("#email","email",true);
			},

			address: function(){

				if( Verify.select("#address","province",true) && Verify.select("#address","city",true) && Verify.empty("#address","input","address",true)){
					return Verify.select("#address","province") + " " + Verify.select("#address","city") + " " +Verify.empty("#address","input","address");
				}
				return false;
			},
			area: function(){
				return Verify.select("#area","area",true);
			},
			classes: function(){
				return Verify.select("#classes","classes",true);
			},
			purpose: function(){
				return $("#purpose").find("textarea").val();
			},
			website: function(){
				return $("#website").find("input").val();
			},
			card: function(){
				return $("#card").val();
			}
		};

		// 验证种类
		var apply = {
			person: ["name","cellphone","certificate_type","certificate_number","email","company","position"],
			media: ["name","cellphone","certificate_type","certificate_number","email","company","position","address","card"],
			company: ["company","name","position","telephone","email","address","website","purpose","area","classes"]
		};

		// 确认信息
		var labels = {
			person: {
				zh: ["姓名","手机","身份证","证件号码","邮箱地址","公司","职位"],
				en: ["NAME","MOBILE PHONE","ID card","ID NO.","EMAIL","COMPANY","POSITION"]
			},
			media: {
				zh: ["姓名","手机","身份证","证件号码","邮箱地址","公司","职位","地址","电子名片"],
				en: ["NAME","MOBILE PHONE","ID card","ID NO.","EMAIL","COMPANY","POSITION","ADDRESS","CARD"]
			},
			company: {
				zh: ["公司名称","联系人","职位","联系电话","邮箱地址","公司地址","公司网站","参展目的","参展面积","参展类型"],
				en: ["COMPANY NAME","CONTACT PERSON","POSITION","TELEPHONE NO.","EMAIL","COMPANY ADDRESS","COMPANY WEBSITE","PURPOSE FOR PARTICIPATION","BOOTH AREA","CATEGORY"]
			}
		};


		// 头部信息
		var titles = {
			confirm: {
				zh: "信息确认",
				en: "CONFORMATION"
			},
			success: {
				zh: "报名成功",
				en: "REGISTRATION COMPLETED"
			}
		};


		// 上传名片
		function card(){

			var $card = $("#card"),
				$select = $("#card_select"),
				$view = $("#card_view");

			$select.change(function(){
				if($(this).val().length <1){
					return;
				}
				$("#card_form").ajaxSubmit({
					url: "/application/putfile",
					type: "POST",
					dataType: "JSON",
					beforeSend: function(){
						loading.show();
					},
					success: function(ret){
						if(ret.code == 0){
							$card.val(ret.data);
							$view.html("<i class='icon remove'></i><img src='"+ ret.data +"'>");
						}else{
							alert(ret['msg']);
						}
					},
					error: function(ret){
						alert(ret.responseText);
					},
					complete: function(){
						loading.hide();
					}
				})
			});

			$view.on("click",function(e){
				var target = $(e.target).get(0),
					remove = $view.find(".remove").get(0);
				if(remove != target){
					$select.click();
				}else{
					$card.val("");
					$view.html("");
				}
			});
		}

		// 媒体报名时调用
		type == "media" && card();

		// 提交验证
		function submit(){

			for( var i = 0; i < apply[type].length; i++){

				var proto = apply[type][i];

				// 非必填
				if(proto == "purpose" || proto == "website" || proto == "card"){
					datas[proto] = Form[proto]();
					continue;
				}

				// 必填
				if(!Form[proto]()){
					right = false;
					return false;
				}

				datas[proto] = Form[proto]();
			}

			right = true;

			return right;
		}

		function table(){

			var label = labels[type][lang],
				str = "";

			for(var i = 0; i < apply[type].length; i++){
				var proto = apply[type][i],
					text = label[i],
					info = "";

				if( proto == "certificate_type"){
					continue;
				}else if( proto == "certificate_number" ){
					info = label[2]+ " " + datas[proto];
				}else if(proto == "purpose"){
					info = "<p>"+ datas[proto]+ "</p>";
				}else if(proto == "card"){
					info = datas[proto] ? "<img src='"+ datas[proto] +"'>" : "";
				}else{
					info = datas[proto];
				}

				str += "<tr><td>"+ text+ "</td><td>"+ info +"</td></tr>";
			}

			$info.find('table').html("<tbody>"+ str +"</tbody>");

		}


		// 滚动到顶部
		function top(){
			$("body").animate({
				scrollTop: 0
			}, 500);
		}

		// 信息确认
		$form.find(".submit").on("click",function(){

			if(submit()){
				$title.text(titles["confirm"][lang]);
				$form.hide();
				$info.show();
				table();
				top();
			}

		});

		// 返回上一页
		$info.find(".back").on("click",function(){
			$title.text(title);
			$form.show();
			$info.hide();
			top();
		});


		// 初始验证码弹框
		var code = new Modals("code");

		// 获取验证码
		function getCode(){
			$.ajax({
				url: "/site/captcha?refresh",
				dataType: "JSON",
				cache: "false",
				success: function(ret){
					code.$image.prop("src",ret.url);
				}
			})
		}

		getCode();

		// 刷新验证码
		code.$image.on("click",function(){
			getCode();
		});

		// 信息提交
		function submitInfo(){

			$.ajax({
				url: url + "application/doapply",
				type: "POST",
				data: datas,
				dataType: "JSON",
				beforeSend: function(){
					loading.show();
				},
				success: function(ret){
					if(ret.code == 0 && ret.status == 200){
						$form.remove();
						$info.remove();
						$result.show();
						$title.text(titles["success"][lang]);
						if(type == "person"){
							$("#code").attr("href",ret.data['qrcode']).html("<img src='"+ ret.data['qrcode'] +"'>");
						}
						top();
						window.onbeforeunload = null;
						// 成功操作
					}else{
						alert(ret['msg']);
					}
				},
				error: function(ret){
					alert(ret.responseText);
				},
				complete: function(){
					loading.hide();
				}
			})
		}

		// 提交验证码
		code.$code.on("keyup",function(){

			code.$code.removeClass("error");

			if(this.value.length == 6){

				// 提交验证
				$.ajax({
					url: "/application/validatecode",
					type: "POST",
					data: "captcha="+this.value,
					success: function(ret){
						if(ret.code == 0  && right){
							code.hide();
							submitInfo();
						}else{
							code.$code.addClass("error");
						}
					}
				})
			}
		});


		$info.find(".submit").on("click",function(){

			// 显示验证码弹框
			code.show();

		});


		window.onbeforeunload = function (event) {

			return (event || window.event).returnValue = "确定要离开";

		};

	};

	//新闻中心
	var News = function(){

		var $container = $("#news_list"),
			$more = $("#add_more"),
			page = $more.attr('data-page'),
			total = $more.attr('data-total'),
			id = $more.attr('data-id'),
			last_id = $more.attr('data-last'),
			type =  $container.hasClass("grid") ? "grid" : "list";

		var texts = {
			zh: {
				normal: "加载更多",
				loading: "加载中...",
				none: "没有更多了"
			},
			en: {
				normal: "Load for more",
				loading: "Loading...",
				none: "End of the page"
			}
		};



		function dot(container){
			// 截取标题
			container.find(".news-item-title").dotdotdot({
				height: 54,
				wrap: 'letter'  //注：中文必须改为letter
			});

			// 截取概要
			container.find('.news-item-summary').dotdotdot({
				height: 100,
				wrap: 'letter'  //注：中文必须改为letter
			});

		}

		if(type == "grid"){
			dot($container);
			// 瀑布流
			$container.masonry({
				itemSelector: '.news-item',
				gutter: 20,
				isAnimated: true
			});
		}

		$more.data("value",true).on("click",function(){

			if(!$more.data("value")){ return; }
			$more.data("value",false).text(texts[lang]['loading']);

			$.ajax({
				url: url+"news/ajaxlist/"+type+'/'+id+'/'+page+'/'+last_id,
				type: "GET",
				dataType: "JSON",
				success: function(ret){

					if(ret.code == 0 && ret.status == 200){
						if(type == "grid"){
							var $news = $("<div/>").append(ret.data.data);

							$news.find(".news-item").each(function(){
								var $item = $(this);
								$container.append($item).masonry("appended",$item);
								dot($item);

							});

						}else{
							$container.append(ret.data.data);
						}

						if( total < page*12){
							$more.data("value",false).text(texts[lang]['none']);
						}else{
							$more.data("value",true).text(texts[lang]['normal']);
							page++;
							last_id = ret.data.last;
						}

					}else{
						$more.data("value",true).text(ret["msg"]);
					}
				}
			})

		});
	};

	//论坛信息
	var Forum = function(){

		var $cover = $("<div/>",{class: "modal-cover"}).appendTo("body"),
			$modal = $("<div/>",{ class: "modals" }).appendTo("body"),
			modalHeight = 490;


		function hidden(){
			var height = $(window).height();
			if(height < 700){

				$modal.find(".modal-dialog").css("margin-top",100)
			}else{

				$modal.find(".modal-dialog").css("margin-top",(height - modalHeight)/2 -50 )
			}
		}

		function detail(btn){
			var id = $(btn).attr("data-id"),
				color = $(btn).attr("data-color");

			$.ajax({
				type: "POST",
				url: url+"forum/detail",
				dataType: "JSON",
				data: "aid="+id,
				beforeSend: function(){
					loading.show();
				},
				success: function (ret) {

					if(ret.code == 0 && ret.status == 200){
						color = color ?  color : "url('/images/modal-bg.jpg') repeat-y";
						//console.log(color)
						$modal.html(ret.data)
							.find(".modal-content")
							.css("background", color)
							.find(".modal-body")
							.perfectScrollbar();

						hidden();
					}
				},
				complete: function(){
					loading.hide();
				}
			});

			$cover.fadeIn();
			$modal.css({
				//top: '0',
				visibility: 'visible'
			}).fadeIn();
		}

		// 查看详情
		$("#forums").on("click",".forum-detail",function(){
			detail(this);
		});

		$("#main_forum").on("click",function(){
			detail(this);
		});

		// 关闭
		$modal.on("click",".close",function(){
			close();
		});

		$(document).on("keydown",function(e){
			var keycode = (e.keyCode ? e.keyCode : e.which);

			keycode == 27 && close();

		});


		function  close(){
			$cover.fadeOut();
			$modal.css({
				//top: '-100%',
				visibility: 'hidden'
			}).fadeOut();
			//$("body").css("overflow",'');
		}
	};

	// 展会信息地图
	var Map = function(id){

		var parms = {
			container: id,
			//poi1:120.245117,
			//poi2:30.237286,
			city: "杭州",
			address: "杭州国际博览中心"
		};

		function bmap(parms){
			var map = new BMap.Map(parms.container);

			map.enableScrollWheelZoom();

			// 创建地址解析器实例
			var myGeo = new BMap.Geocoder();

			// 将地址解析结果显示在地图上,并调整地图视野
			myGeo.getPoint(parms.address, function(poi){
				if (poi) {
					map.centerAndZoom(poi, 14);

					var marker = new BMap.Marker(poi);

					//marker.enableDragging(); //marker可拖拽

					map.addOverlay(marker);
				}
			}, parms.city)
		}

		bmap(parms);
	};

	// 下载页面
	var Download = function(type){

		var $container = $("#"+ type+"s"),
			$files = $container.find("."+type),
			$number = $container.find(".number"),
			$all = $container.find(".all"),
			Max = $container.find("."+type).length,
			num = 0;

		$files.each(function(){
			$(this).data("id",$(this).attr("data-id"));
		});

		$container.on("click","."+type,function(e){
			e.preventDefault();
			var checked = $(this).data("checked");

			if(!checked){
				$(this).data("checked",true).addClass("checked");
				num++;
			}else{
				$(this).data("checked",false).removeClass("checked");
				num--;
				num < 1 && $all.data("checked",false).removeClass("checked");
			}

			$number.text(num);
		});

		$container.on("click",".all",function(e){
			e.preventDefault();
			var checked = $(this).data("checked");

			if(!checked){
				num = Max;
				$(this).data("checked",true).addClass("checked");

				$files.each(function(){
					$(this).data("checked",true).addClass("checked");
				});

			}else{
				num = 0;
				$(this).data("checked",false).removeClass("checked");

				$container.find("."+type).each(function(){
					$(this).data("checked",false).removeClass("checked");
				});
			}
			$number.text(num);
		});

		// 下载
		$container.on("click",".download-btn",function(){
			var files = [];
			for(var i = 0; i < Max; i++){
				var checked = $files.eq(i).data("checked");
				if(checked){
					files.push($files.eq(i).data("id"));
				}
			}

			var types = type == "pdf"? "pdf" : "image";

			if(files.length < 1){ return; }

			$.ajax({
				url: "/resource/download/"+ types + "/"+files.toString(),
				type: "GET",
				dataType: "JSON",
				beforeSend: function(){
					loading.show();
				},
				success: function(ret){

					if(ret.code == 0 && ret.status == 200 ){
						location.href = ret.data['zip_path'];
					}else{
						alert(ret['msg']);
					}
				},
				complete: function(){
					loading.hide();
				}
			})
		});

		return true;
	};

	$(document).ready(function(){

		// 首页轮播图
		$("#index").get(0) && Index();

		//报名
		$("#apply").get(0) && Apply();

		// 新闻中心 瀑布流
		$("#news").get(0) && News();

		// 展会信息
		$("#forums").get(0) && Forum();

		// 下载页
		$("#download_page").get(0) && Download("pdf") && Download("img");

		// 展会信息地图
		$("#map").get(0) && Map("map");

	});

})(jQuery);