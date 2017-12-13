
var Application = function (){

	var infoModal = new Modals();

	var detail = function(){
		$("#application").on("click",".read",function(){

			var id = $(this).attr("data-id"),
				type = $(this).attr("data-type");

			Action.add({
				url:"/application/detail/"+id+"/"+type
			},infoModal);
		});
	};

	return {
		init: function(){
			detail();
		}
	}
}();


var Qrcode = function(){

	var loading = new Loading();

    var create_qrcode = function(){
	    $("#create_download_qrcode").on("click",function(){
	    	var qr_num = $("#qrcode_number").val();
	        $("#create_qrcode").ajaxSubmit({
	            url: "/application/createqrcode",
	            type: "POST",
	            data:{number:qr_num},
	            dataType: "JSON",
	            beforeSend: function(){
	            	loading.show();
	            },
	            success: function(ret){
	                if(ret.code==0){
	                	$("#create_download_qrcode").remove();
	                	$("#qrcode_down").append('<a id="down_qrcode_over" href="/application/sceneqrcode/'+ret.data.begin+'/'+qr_num+'" class="btn red">下载</a>');
	                    alert(qr_num+'个现场观众二维码生成成功');
	                }else{
	                    alert(ret.msg);
	                }
	            },
	            error: function(ret){
	                
	            },
	            complete: function(){
	                loading.hide();
	            }
	        });
	    });
	    $("#down_qrcode_over").on("click",function(){
	    	window.location.reload();
	    });
	    $("#close_down_qrcode").on("click",function(){
	    	window.location.reload();
	    });
 	}
 	return {
		init: function(){
			create_qrcode();
		}
	}
}();
$(document).ready(function(){

	Metronic.init();
	Layout.init();
	Application.init();
	Qrcode.init();
});