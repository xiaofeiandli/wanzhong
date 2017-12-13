var Manager = function(){

    var $table = $("#managers");

    var form = {
        username: function(){
            return Verify.empty("#username","input");
        },
        email: function(){
            return Verify.email("#email");
        }
    };

    // 创建新用户
    var create = function (){

        $("#submit").on("click",function(){

            if(!Verify.submit(form)){
                return;
            }
            var params = {
                url: "/manager/add",
                type: "POST",
                loading: "base",
                data: $("#form").serialize(),
                success: function(ret){
                    Base.alert(ret.msg,function(){
                        setTimeout(function(){
                            location.reload();
                        },300);
                    });
                },
                fail: function(ret){
                    Base.alert(ret.msg);
                }
            };
            Base.ajax(params);
        })

    };

    // 删除
    var del = function(){
        $table.on("click",".delete",function(){
            var _this = this,
                id = $(this).attr("data-id"),
                params = {
                    url: "/manager/del",
                    type: "POST",
                    data: "id="+id,
                    this: _this
                 };

            Base.confirm("删除后不可恢复，确定要删除？",function(){
                Action.del(params);
            });

        });
    };
    return {
        init: function(){
            create();
            del();
        }
    }
}();


$(document).ready(function(){
    Metronic.init();
    Layout.init();
    Manager.init();
    $("#reset").get(0) && Resetpwd();
});


