<?php
use wap\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
$controllerID = Yii::$app->controller->id;
$actionID = Yii::$app->controller->action->id;
$language = $this->params['language'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta content="telephone=no,email=no" name="format-detection">
	<script src="/js/vendor/flexible.js" type="text/javascript"></script>
	<link href="/css/style.min.css" rel="stylesheet">
	<!--<script src="http://g.tbcdn.cn/mtb/lib-flexible/0.3.4/??flexible_css.js,flexible.js"></script>-->
	<title><?= Html::encode($this->title) ?>_<?php echo \Yii::t('app', '未来出行');?></title>
	<?php if($language == 'en'){?>
    <meta name="keywords" content="future mobility,future mobility forum,future mobility exhibition,GFM,China EV100,New Energy,Intelligent drive"/>
    <meta name="description" content="future mobility,future mobility forum,future mobility exhibition,GFM,China EV100,New Energy,Intelligent drive"/>
    <?php }else{?>
    <meta name="keywords" content="未来出行,未来出行论坛,未来出行展览会,电动汽车百人会,智能网联,新能源,智能交通"/>
    <meta name="description" content="未来出行,未来出行论坛,未来出行展览会,电动汽车百人会,智能网联,新能源,智能交通"/>
    <?php }?>
	<?php $this->head() ?>
</head>
<!DOCTYPE html>
<body id="<?=$language?>">
<header>
	<a href="/<?php if($language=='en'){echo 'en';}?>">
		<img src="/images/logo_header.png">
	</a>
	<div class="menu">
		<div class="menu-bar" id="menu_btn">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</div>
		<span class="icon" id="icon"></span>
		<ul class="nav no-style" id="nav">
			<?php if(isset($this->params['class_one'])&&is_array($this->params['class_one'])&&count($this->params['class_one'])>0){ foreach($this->params['class_one'] as $key=>$value){?>
                <li <?php if(isset($value['active'])&&$value['active']==1){echo 'class="active"';}?>>
                    <a href="<?=$value['url']?>"><?=$value['name']?></a>
                </li>
            <?php }}?>
		</ul>
	</div>
	<div class="langs">
		<a href="
        <?php if(isset($this->params['cur_url'])&&!empty($this->params['cur_url'])){
            echo $this->params['cur_url'];
        }else{
            echo 'javascript:;';
        }
        ?>" class="zh <?php if($language==''){echo 'active';}?>">中</a>
        <a href="<?php if(isset($this->params['cur_en_url'])&&!empty($this->params['cur_en_url'])){echo $this->params['cur_en_url'];}else{echo 'javascript:;';}?>" class="en <?php if($language=='en'){echo 'active';}?>">EN</a>
	</div>
</header>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>	
<footer>
	<div class="footer-info clearfix">
		<img class="wx-code" src="/images/wx_code.png">
		<div class="contact">
			<?php if(isset($this->params['footer_join'])&&is_array($this->params['footer_join'])&&count($this->params['footer_join'])>0){ $footer_join=$this->params['footer_join'];?>
	            <div class="contact-item">
		            <img src="<?=$this->params['footer_join']['thumb']?>">
	            </div>
	        <?php }?>
	         <?php if(isset($this->params['footer_media'])&&is_array($this->params['footer_media'])&&count($this->params['footer_media'])>0){ $footer_media=$this->params['footer_media'];?>
				<div class="contact-item">
					<img src="<?=$this->params['footer_media']['thumb']?>">
				</div>
	        <?php }?>
	         <?php if(isset($this->params['footer_business'])&&is_array($this->params['footer_business'])&&count($this->params['footer_business'])>0){ $footer_business=$this->params['footer_business'];?>
				<div class="contact-item">
					<img src="<?=$this->params['footer_business']['thumb']?>">
				</div>
	        <?php }?>
		</div>
	</div>
	<div class="copy-info">
		<img src="/images/logo_footer.png">
		<p>版权所有 未来出行</p>
		<p>Copyright © 2017 All Rights Reserved 京ICP备13006032号-1</p>
	</div>
</footer>

<script src="/js/vendor/jquery.min.js" type="text/javascript"></script>
<?php if(isset($this->params['item'])&&$this->params['item']=='news'){?>
    <script src="/js/vendor/masonry.pkgd.min.js" type="text/javascript"></script>
<?php }?>
<?php if(isset($this->params['item'])&&$this->params['item']=='meeting'){?>
	<script src="http://api.map.baidu.com/api?v=2.0&ak=OeXDXYIzPFbSxE9NxXhILHx28nYbd8xE" type="text/javascript"></script>
	<script src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js" type="text/javascript"></script>
<?php } ?>
<?php if(isset($this->params['item'])&&$this->params['item']=='application'){?>
	<script src="/js/vendor/distpicker.min.js" type="text/javascript"></script>
	<script src="/js/vendor/jquery.form.js" type="text/javascript"></script>
	<script src="/js/verify.min.js" type="text/javascript"></script>
<?php }?>
<script src="/js/main.min.js" type="text/javascript"></script>
</body>
</html>
<?php $this->endPage() ?>
