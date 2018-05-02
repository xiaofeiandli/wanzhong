<?php
use yii\web\View;
$this->title = '首页';
?>

<div class="body" id="index" v-cloak>
	<!--<div class="banners" id="banners">
		<div class="banner-item">
			<img class="banner-image" src="images/banner.png">
		</div>
		<div class="banner-item">
			<img class="banner-image" src="images/banner.png">
		</div>
		<div class="banner-item">
			<img class="banner-image" src="images/banner.png">
		</div>
		<div class="banner-btns" id="banner_btns">
			<span class="banner-btn current"></span>
			<span class="banner-btn"></span>
			<span class="banner-btn"></span>
		</div>
	</div>-->
	<el-carousel :interval="5000" height="564px" id="banners">
      <el-carousel-item v-for="item in 4" :key="item">
		<img class="banner-image" src="/images/banner.png">
      </el-carousel-item>
    </el-carousel>
	<div class="container" :style="{'min-height': height+ 'px'}">
		<div class="index clearfix">
			<div class="index-image">
				<img src="/images/index-picture.png" alt="首页画作描述" title="首页画作描述">
			</div>
			<div class="index-poem">
				<img src="/images/index-poem.png" alt="首页诗歌描述" title="首页诗歌描述">
			</div>
		</div>
	</div>
</div>