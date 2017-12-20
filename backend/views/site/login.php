<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8"/>
    <title>万中音乐后台管理系统</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <link href="/css/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet">
    <link href="/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/plugins/components.css" rel="stylesheet">
    <link href="/css/plugins/plugins.css" rel="stylesheet">
    <link href="/css/layout/css/layout.css" rel="stylesheet">
    <link href="/css/layout/css/themes/darkblue.css" rel="stylesheet">
    <link href="/css/layout/css/login-soft.css" type="text/css" rel="stylesheet">
    <link href="/css/layout/css/custom.css" rel="stylesheet">
</head>
<body class="login">
<div class="logo">
    <a href="/">
        <img src="/images/logo-big.png"  style="width: 100px;" alt=""/>
    </a>
</div>
<div class="menu-toggler sidebar-toggler">
</div>
<div class="content">
    <form class="login-form" id="login" action="/user/signin" method="post">
        <h3 class="form-title">管理员登录</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span></span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">用户名</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" id="user" type="text" autocomplete="off" placeholder="用户名" name="username"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">密码</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" id="pwd" type="password" autocomplete="off" placeholder="密码" name="password"/>
            </div>
        </div>
        <div class="form-actions">
            <button id="login_submit" type="button" class="btn blue pull-right">
                登录 <i class="m-icon-swapright m-icon-white"></i>
            </button>
            <br>
        </div>
        <div class="create-account">
            <p>跳转到网站前台&nbsp; <a href="http://wanzhonghuayi.com">wanzhonghuayi.com </a></p>
        </div>
    </form>
</div>
<div class="copyright">
    2017 &copy; 万中音乐后台管理系统v1
</div>

<!--[if lt IE 9]>
<script src="/js/plugins/respond.min.js"></script>
<script src="/js/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- GLOBAL -->
<script src="/js/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/js/plugins/jquery.form.js" type="text/javascript"></script>
<script src="/js/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/js/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/js/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="/js/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/js/layout/metronic.js" type="text/javascript"></script>
<script src="/js/layout/layout.js" type="text/javascript"></script>
<!--BLOBAL END-->
<script src="/js/custom/base.js" type="text/javascript"></script>
<script src="/js/custom/login.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        Metronic.init();
        $.backstretch([
                "/images/bg/1.jpg",
                "/images/bg/2.jpg",
                "/images/bg/3.jpg",
                "/images/bg/4.jpg"
            ], {
                fade: 1000,
                duration: 8000
            }
        );

        $("#login").get(0) && Login();
    });
</script>
</body>
</html>
