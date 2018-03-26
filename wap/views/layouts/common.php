<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
$controllerID = Yii::$app->controller->id;
$actionID = Yii::$app->controller->action->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta content="telephone=no,email=no" name="format-detection">
    <script src="/js/flexible.js" type="text/javascript"></script>
    <link href="/css/m-style.css" rel="stylesheet">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
</head>
<!DOCTYPE html>
<body>
    <header class="header">
        <a href="">
		<img src="/images/logo.png">
	</a>
        <div class="menu">
            <div class="menu-bar" id="menu_btn">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <span class="icon" id="icon"></span>
            <ul class="nav no-style" id="nav">
                <li <?php if($actionID=='index'){?>class="active"<?php }?>>
					<a href="/"><img src="/images/首页.png"></a>
				</li>
				<li <?php if($actionID=='mv'){?>class="active"<?php }?>>
					<a href="/mv"><img style="margin-top:3px;" src="/images/MV.png"></a>
				</li>
				<li <?php if($actionID=='music'){?>class="active"<?php }?>>
					<a href="/music"><img src="/images/音乐.png"></a>
				</li>
				<li <?php if($actionID=='painting'){?>class="active"<?php }?>>
					<a href="/painting"><img src="/images/画作.png"></a>
				</li>
				<li <?php if($actionID=='calligraphy'){?>class="active"<?php }?>>
					<a href="/calligraphy"><img src="/images/书法.png"></a>
				</li>
				<li <?php if($actionID=='poem'){?>class="active"<?php }?>>
					<a href="/poem"><img src="/images/诗歌.png"></a>
				</li>
            </ul>
        </div>
    </header>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
    <footer class="footer">
        <p>京ICP备18002956号</p>
    </footer>
    <script src="/js/vendor/jquery.min.js" type="text/javascript"></script>
	<script src="/js/vendor/vue-2.4.4/vue.min.js" type="text/javascript"></script>
	<script src="/js/m-main.js" type="text/javascript"></script>
    <!-- <script src="/js/vendor/masonry.pkgd.min.js" type="text/javascript"></script> -->
</body>
</html>
<?php $this->endPage() ?>
