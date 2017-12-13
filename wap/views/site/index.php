<?php
use yii\web\View;
$this->title = \Yii::t('app', '首页');
$language = $this->params['language'];
?>
<div class="body">
	<div class="index-banner">
		<ul class="banner-list">
			<li class="banner-item">
				<img src="/images/index/banner.jpg">
			</li>
		</ul>
		<div class="banner-content">
			<?php if(isset($index_banner[0]['id'])){?>
	        <img src="<?=$index_banner[0]['thumb']?>">
	        <?php }else{?>
			<img src="/images/index/banner_title.png">
	        <?php }?>
			<div class="banner-text">
				<div><span class="time">2017.11.10 - 2017.11.12</span></div>
				<div><span class="address"><?php echo \Yii::t('app', '杭州国际展览中心 （G20场馆）');?></span></div>
			</div>
		</div>
	</div>
	<div class="application">
		<div class="enters flex flex-center">

			<div class="enter-item company">
				<img src="/images/index/company.png">
				<a class="enter-cover" href="<?php if(isset($company_entrance[0]['source'])&&!empty($company_entrance[0]['source'])){echo $company_entrance[0]['source'];}else{if($language=='en'){echo '/en';}echo '/application/company';}?>">
					<div class="enter-icon">
						<img src="/images/index/company_icon.png">
					</div>
					<div class="enter-text">
						<?php if(isset($company_entrance[0]['id'])){?>
						<img src="<?=$company_entrance[0]['thumb']?>">
						<?php }?>
					</div>
				</a>
			</div>
			<div class="enter-item person">
				<img src="/images/index/person.png">
				<a class="enter-cover" href="<?php if(isset($person_entrance[0]['source'])&&!empty($person_entrance[0]['source'])){echo $person_entrance[0]['source'];}else{if($language=='en'){echo '/en';}echo '/application/person';}?>">
					<div class="enter-icon">
						<img src="/images/index/person_icon.png">
					</div>
					<div class="enter-text">
						<?php if(isset($person_entrance[0]['id'])){?>
						<img src="<?=$person_entrance[0]['thumb']?>">
						<?php }?>
					</div>
				</a>
			</div>
			<div class="enter-item media">
				<img src="/images/index/media.png">
				<a class="enter-cover" href="<?php if(isset($media_entrance[0]['source'])&&!empty($media_entrance[0]['source'])){echo $media_entrance[0]['source'];}else{if($language=='en'){echo '/en';}echo '/application/media';}?>">
					<div class="enter-icon">
						<img src="/images/index/media_icon.png">
					</div>
					<div class="enter-text">
						<?php if(isset($media_entrance[0]['id'])){?>
						<img src="<?=$media_entrance[0]['thumb']?>">
						<?php }?>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="units">
		<div class="title-item">
			<hr>
			<hr class="title-line">
			<h2 class="title-content"><span><?php echo \Yii::t('app', '主办单位');?></span></h2>
		</div>
		<ul>
			<li><a href=""><?php echo \Yii::t('app', '中国电动汽车百人会');?></a></li>
			<li><a href=""><?php echo \Yii::t('app', '中国信息化百人会');?></a></li>
		</ul>
	</div>
</div>