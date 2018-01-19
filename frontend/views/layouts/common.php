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
				<li <?php if($actionID=='planting'){?>class="active"<?php }?>>
					<a href="/planting"><img src="/images/画作.png"></a>
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
			<!-- <div style="margin-bottom: 52px;"><span class="footer-margin">Copyright © 2003-2018 万忠华艺 版权所有</span></div> -->
			<div><span class="footer-margin">京ICP备18002956号</span></div>
		</div>
	</div>
</html>
<?php $this->endPage() ?>
