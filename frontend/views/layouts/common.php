<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
$controllerID = Yii::$app->controller->id;
$actionID = Yii::$app->controller->action->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8" />
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/js/vendor/mplayer/css/mplayer.css">
    <link rel="stylesheet" type="text/css" href="/js/vendor/mediaelement/mediaelementplayer.min.css">
    <link rel="stylesheet" type="text/css" href="/js/vendor/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
	<div class="header">
		<div class="container clearfix">
			<a class="header-logo" href="/">
				<img src="/images/logo.png">
			</a>
			<ul class="nav-bar">
				<li <?php if($actionID=='index'){?>class="active"<?php }?>>
					<a href="/"><img src="/images/首页.png"></a>
				</li>
				<li <?php if($actionID=='mv'){?>class="active"<?php }?>>
					<a href="/mv"><img style="margin-top:3px;" src="/images/MV.png"></a>
				</li>
				<li <?php if($actionID=='music'){?>class="active"<?php }?>>
					<a href="/music"><img src="/images/音乐.png"></a>
				</li>
				<li <?php if($actionID=='picture1'){?>class="active"<?php }?>>
					<a href="/picture1"><img src="/images/画作.png"></a>
				</li>
				<li <?php if($actionID=='calligraphy'){?>class="active"<?php }?>>
					<a href="/calligraphy"><img src="/images/书法.png"></a>
				</li>
				<li <?php if($actionID=='poem'){?>class="active"<?php }?>>
					<a href="/poem"><img src="/images/诗歌.png"></a>
				</li>
			</ul>
		</div>
	</div>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>

	<div class="footer">
		<div class="container">
			<div style="margin-bottom: 52px;"><span class="footer-margin">copyright © 2003-2018 68design.net.all rights reserved</span><span>站长统计</span>️</div>
			<div><span class="footer-margin">京ICP备18002956号</span><span>皖公网备案34010402700146号</span></div>
		</div>
	</div>
	<script type="text/javascript" src="/js/vendor/jquery.min.js"></script>
	<script type="text/javascript" src="/js/vendor/jquery-migrate.min.js"></script>
	<!--img start-->
	<script type="text/javascript" src="/js/vendor/fancybox/jquery.fancybox.pack.js"></script>
	<!--img start-->
	<!--music start-->
	<script type="text/javascript" src="/js/vendor/mplayer/js/mplayer.js"></script>
	<script type="text/javascript" src="/js/vendor/mplayer/js/jquery.nstSlider.js"></script>
	<script type="text/javascript" src="/js/vendor/mplayer/js/mplayer-list.js"></script>
	<script type="text/javascript" src="/js/vendor/mplayer/js/mplayer-functions.js"></script>
	<!--music end-->
	<!--mv start-->
	<script type="text/javascript" src="/js/vendor/mediaelement/mediaelement-and-player.min.js"></script>
	<!--mv end-->
	<script type="text/javascript" src="/js/main.js"></script>
</html>
<?php $this->endPage() ?>
