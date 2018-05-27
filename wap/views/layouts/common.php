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
    <link href="/css/icon/iconfont.css" rel="stylesheet">
    <?php if($actionID=='music'){?>
    <link rel="stylesheet" type="text/css" href="/js/vendor/APlayer/APlayer.min.css">
    <?php }?>
    <?php if($actionID=='video'){?>
    <link rel="stylesheet" type="text/css" href="/js/vendor/mediaelement/mediaelementplayer.min.css"></link>
    <?php }?>

    <link href="/css/m-style.css" rel="stylesheet">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
</head>
<!DOCTYPE html>
<body>
    <header class="header">
        <a href="/">
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
					<a href="/">首页</a>
				</li>
				<li <?php if($actionID=='mv'){?>class="active"<?php }?>>
					<a href="/mv">MV</a>
				</li>
				<li <?php if($actionID=='music'){?>class="active"<?php }?>>
					<a href="/music">音乐</a>
				</li>
				<li <?php if($actionID=='painting'){?>class="active"<?php }?>>
					<a href="/painting">画作</a>
				</li>
				<li <?php if($actionID=='calligraphy'){?>class="active"<?php }?>>
					<a href="/calligraphy">书法</a>
				</li>
				<li <?php if($actionID=='poem'){?>class="active"<?php }?>>
					<a href="/poem">诗歌</a>
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
<?php if($actionID=='music'){?>
    <script src="/js/vendor/APlayer/APlayer.min.js" type="text/javascript"></script>
<?php }?>
<?php if($actionID=='video'){?>
    <script src="/js/vendor/mediaelement/mediaelement-and-player.min.js" type="text/javascript"></script>

<?php }?>

	<script src="/js/m-main.js" type="text/javascript"></script>
</body>
</html>
<?php $this->endPage() ?>
