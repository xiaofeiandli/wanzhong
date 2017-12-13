(function(){

	// 当前语言
	var lang = $("#en").get(0) ? "en" : "zh",
		url = lang == "en" ? "/en/" : "/";

	lang == "zh" && $("body").attr("id","zh");

	// 当前根字体大小
	var rem = document.documentElement.clientWidth / 10;


	// 加载框
	function Modal(type,src){
		var content = {},
			title = {
				zh: "请输入验证码",
				en: "Please enter verification code"
			};

		content.loading = "<div style='text-align: center;'>" +
			            "<img src='/images/loading.gif'>"+
					 "</div>";

		content.code = "<div class='modal-content'>"+
					"<div class='verify-content'>"+
						"<h2 class='verify-title'>"+title[lang]+"</h2>"+
						"<div class='flex'>"+
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
			html: "<div class='modal-dialog'>"+content[type]+ "</div>"
		}).appendTo("body");

		if(type == "code"){
			this.$code = this.$modal.find(".verify-code");
			this.$image = this.$modal.find(".verify-image");
		}
	}
	Modal.prototype.show = function(){
		this.$cover.fadeIn();
		this.$modal.fadeIn();
	};
	Modal.prototype.hide = function(){
		this.$cover.fadeOut();
		this.$modal.fadeOut();
	};
	Modal.prototype.destroy = function(){
		this.$cover.remove();
		this.$modal.remove();
	};

	var loading = new Modal('loading');


	// 导航栏
	var Nav = function(){

		var $bar = $("#menu_btn").data("value",true),
			$icon = $("#icon"),
			$nav = $("#nav");

		$bar.on("click",function(){
			var val = $(this).data("value");
			if(val){
				$icon.show();
				$nav.slideDown();
			}else{
				$nav.slideUp(function(){
					$icon.hide();
				});
			}
			$(this).data("value",!val);
		});

		$(document).on("click",function(e){
			var target = $(e.target).get(0),
				bar = $bar.get(0);

			if( !$bar.data("value") && target !== bar && !$.contains(bar,target)){

				$bar.data("value",true);
				$nav.slideUp(function(){
					$icon.hide();
				});
			}
		})

	};

    //新闻中心
    var News = function(){

        var $container = $("#grid"),
            $more = $("#add_more").data("value",true),
            page = $more.attr('data-page'),
            total = $more.attr('data-total'),
            id = $more.attr('data-id'),
            last_id = $more.attr('data-last'),
            type =  "grid";

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



	    function ajaxList(first){

		    if(!type || !id || !page || !last_id){
			    return;
		    }

		    $.ajax({
			    url: url +"news/ajaxlist/"+type+'/'+id+'/'+page+'/'+last_id + '/'+ 4.5333*rem,
			    dataType: "JSON",
			    beforeSend: function(){
				    first && loading.show();
			    },
			    success: function(ret){

				    if(ret.code == 0 && ret.status == 200){
						if(!first){
							var $news = $("<div/>").append(ret.data.data);

							$news.find(".news-item").each(function(){
								var $item = $(this);
								$container.append($item).masonry("appended",$item);
							});
						}else{
							$container.append(ret.data.data);

							// 瀑布流
							$container.masonry({
								itemSelector: '.news-item',
								gutter: .3473 * rem,
								isAnimated: true
							});
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
			    },
			    error: function(XMLHttpRequest, textStatus, errorThrown){
				   alert(XMLHttpRequest.status + " " + errorThrown);
			    },
			    complete: function(){
				    first && loading.hide();
			    }
		    })
	    }

		ajaxList(true);
		$(window).scroll(function(){
            var dtop=  $more.offset().top,
                wtop = $(document).scrollTop(),
                height = $(window).height();

            if( $more.data("value") && wtop + height + 50 >= dtop){
                $more.data("value",false).text(texts[lang]['loading']);

	            ajaxList();
                //$.ajax({
                //    url: "/news/ajaxlist/"+type+'/'+id+'/'+page+'/'+last_id + '/'+ 4.5333*rem ,
	             //   //data: "width="+ ,
                //    type: "GET",
                //    dataType: "JSON",
                //    success: function(ret){
                //
                //        if(ret.code == 0 && ret.status == 200){
                //
					//		var $news = $("<div/>").append(ret.data.data);
                //
					//		$news.find(".news-item").each(function(i){
					//			$container.append(this);
                //
					//			$container.masonry("appended",$(this));
					//		});
                //
                //            if( total < page*12){
                //                $more.data("value",false).text(texts[lang]['none']);
                //            }else{
                //                $more.data("value",true).text(texts[lang]['normal']);
                //                page++;
                //                last_id = ret.data.last;
                //            }
                //
                //        }else{
                //            $more.data("value",true).text(ret["msg"]);
                //        }
                //    },
	             //   error: function(error){
		         //       console.log(error.error())
		         //       //$more.data("value",true).text(statusText);
	             //   }
                //})
            }
		});
    };

	// 展会信息地图
	var Map = function(id){

		var parms = {
			container: id,
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

	// 报名页面
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
					var n = 0; // 个人
					if( type == "media"){
						n = 1; // 媒体
					}else if(type == "company"){
						n = 2; // 公司
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
							$view.html("<i class='remove'></i><img src='"+ ret.data +"'>");
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

		// 确认信息
		function info(){

			var label = labels[type][lang],
				str = "";

			for(var i = 0; i < apply[type].length; i++){
				var proto = apply[type][i],
					text = label[i],
					info = "";

				if( proto == "certificate_type"){
					continue;
				}else if( proto == "certificate_number" ){
					info = datas['certificate_type']+ " " + datas[proto];
				}else if(proto == "card"){
					info = datas[proto] ? "<img src='"+ datas[proto] +"'>" : "";
				}else{
					info = datas[proto];
				}
				str += "<div class='info-item'><label class='info-label'>"+ text+ "</label><p class='info-detail'>"+ info +"</p></div>";
			}
			$info.find(".apply-info-detail").html(str);
		}

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
				// 显示填写信息
				info();
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

		// 初始化验证码框
		var code = new Modal("code");

		// 初始调用
		getCode();

		// 刷新验证码
		code.$image.on("click",function(){
			getCode();
		});

		// 提交信息
		function submitInfo(){

			$.ajax({
				url: url+ "application/doapply",
				type: "POST",
				data: datas,
				dataType: "JSON",
				beforeSend: function(){
					loading.show();
				},
				success: function(ret){
					if(ret.code == 0){
						$form.remove();
						$info.remove();
						$result.show();
						$title.text(titles["success"][lang]);
						if(type === "person"){
							$("#ret_chart").attr("href",ret.data['qrcode']).html("<img class='ret-chart' src='"+ ret.data['qrcode'] +"'>");
						}
						top();
						window.onbeforeunload = null;
						// 成功操作
					}else{
						alert(ret['msg']);
					}
				},
				error: function(ret){
					console.log(ret);
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
						if(ret.code == 0 ){
							if(right){
								code.hide();
								submitInfo();
							}

						}else{
							code.$code.addClass("error");
						}
					}
				})
			}
		});


		// 确认提交
		$info.find(".submit").on("click",function(){

			// 显示验证码弹框
			code.show();
		});

		// 离开提示
		window.onbeforeunload = function (event) {
			return (event || window.event).returnValue = "确定要离开?";
		}
	};

	$(document).ready(function(){
		// 导航
		Nav();

		// 新闻中心
		$("#grid").get(0) && News();

		// 展会信息
		$("#map").get(0) && Map("map");

		// 报名页面
		$("#apply").get(0) && Apply();

	});
})(jQuery);