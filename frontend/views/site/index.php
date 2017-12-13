<?php
use yii\web\View;
$this->title = \Yii::t('app', '首页');
$language = $this->params['language'];
?>
<div class="index-page" id="index">
    <div class="index-banner" id="banners">
        <div class="banner-item banner">
            <?php if(isset($site_banner[0]['id'])){?>
                <img class="banner-image" src="<?=$site_banner[0]['thumb']?>">
            <?php }else{?>
                <img class="banner-image" src="/images/index/banner_1.jpg">
            <?php }?>
        </div>
        <div class="banner-item banner second">
            <?php if(isset($site_banner[1]['id'])){?>
                <img class="banner-image" src="<?=$site_banner[1]['thumb']?>">
            <?php }else{?>
                <img class="banner-image" src="/images/index/banner_2.jpg">
            <?php }?>
        </div>
        <div class="banner-item banner third">
            <?php if(isset($site_banner[2]['id'])){?>
                <img class="banner-image" src="<?=$site_banner[2]['thumb']?>">
            <?php }else{?>
                <img class="banner-image" src="/images/index/banner_3.jpg">
            <?php }?>
        </div>
        <?php if(isset($index_banner[0]['id'])){?>
        <img class="banner-title" src="<?=$index_banner[0]['thumb']?>">
        <?php }else{?>
        <img class="banner-title" src="/images/index/title.png">
        <?php }?>
    </div>
    <div class="container">
        <div class="applications">
            <a class="item-enter company" href="<?php if($language=='en'){echo '/en';}?>/application/company" style="background-image: url('/images/index/company.jpg');">
                <div class="cover">
                <i class="item-icon"></i>
                <?php if(isset($company_entrance[0]['id'])){?>
                <img class="item-text" src="<?=$company_entrance[0]['thumb']?>">
                <?php }?>
                </div>
            </a>
            <a class="item-enter person"  href="<?php if($language=='en'){echo '/en';}?>/application/person" style="background-image: url('/images/index/person.jpg');">
                <div class="cover">
                <i class="item-icon"></i>
                <?php if(isset($person_entrance[0]['id'])){?>
                <img class="item-text" src="<?=$person_entrance[0]['thumb']?>">
                <?php }?>
                </div>
            </a>
            <a class="item-enter media"  href="<?php if($language=='en'){echo '/en';}?>/application/media" style="background-image: url('/images/index/media.jpg');">
                <div  class="cover">
                <i class="item-icon"></i>
                <?php if(isset($media_entrance[0]['id'])){?>
                <img class="item-text" src="<?=$media_entrance[0]['thumb']?>">
                <?php }?>
                </div>
            </a>
        </div>
        <div class="units">
            <div class="item-title-2">
                <hr>
                <hr class="title-line">
                <h3 class="title-content">
                    <span><?php echo \Yii::t('app', '主办单位');?></span>
                </h3>
            </div>
            <div class="unit-list">
                <a class="unit" href="http://www.chinaev100.org/" target="_blank"><img src="/images/index/qc-brh.jpg"></a>
                <a class="unit" href="http://www.chinainfo100.com/" target="_blank"><img src="/images/index/xx-brh.jpg"></a>
            </div>
        </div>
    </div>
</div>