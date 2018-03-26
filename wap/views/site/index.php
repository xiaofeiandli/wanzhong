<?php
use yii\web\View;
$this->title = '首页';
?>
    <div class="index" id="index" v-cloak>
        <div class="banners" id="banners">
            <div class="banner-item">
                <img class="banner-image" src="/images/banner.png">
            </div>
            <div class="banner-item">
                <img class="banner-image" src="/images/banner.png">
            </div>
            <div class="banner-item">
                <img class="banner-image" src="/images/banner.png">
            </div>
            <div class="banner-btns" id="banner_btns">
                <span class="banner-btn current"></span>
                <span class="banner-btn"></span>
                <span class="banner-btn"></span>
            </div>
        </div>
        <div class="index-body flex flex-justify flex-align"  :style="{'min-height': height+'px'}">
			<img class="index-image" src="/images/index-picture.png" alt="首页画作描述" title="首页画作描述">
			<img class="index-poem" src="/images/index-poem.png" alt="首页诗歌描述" title="首页诗歌描述">
		</div>
    </div>