<?php
use frontend\assets\AppAsset;
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
    <title><?= Html::encode($this->title) ?>_<?php echo \Yii::t('app', '未来出行');?><?=$language?></title>
    <?php if($language == 'en'){?>
    <meta name="keywords" content="future mobility,future mobility forum,future mobility exhibition,GFM,China EV100,New Energy,Intelligent drive"/>
    <meta name="description" content="future mobility,future mobility forum,future mobility exhibition,GFM,China EV100,New Energy,Intelligent drive"/>
    <?php }else{?>
    <meta name="keywords" content="未来出行,未来出行论坛,未来出行展览会,电动汽车百人会,智能网联,新能源,智能交通"/>
    <meta name="description" content="未来出行,未来出行论坛,未来出行展览会,电动汽车百人会,智能网联,新能源,智能交通"/>
    <?php }?>
    <?php $this->head() ?>
    <link href="/css/style.min.css" rel="stylesheet">
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
</head>
<body id="<?=$language?>">
<div class="header">
    <div class="top-info">
        <div class="container">
            <div class="pull-right">
                <div class="top-contact">
                    <span><?php echo \Yii::t('app', '联系我们');?></span>
                    <div class="contact-type">
                        <i class="icon wx-icon"></i>
                        <div class="dialog">
                            <i class="dialog-icon"></i>
                            <div><img src="/images/wx-chart.jpg"></div>
                            <p><?php echo \Yii::t('app', '扫一扫关注未来出行');?></p>
                        </div>
                    </div>
                    <div class="contact-type">
                        <i class="icon email-icon"></i>
                        <div class="dialog">
                            <i class="dialog-icon"></i>
                            <p class="no-wrap"><?php echo \Yii::t('app', '邮箱地址');?>: gfm@fmev100.com</p>
                        </div>
                    </div>
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
            </div>
            <p><?php echo \Yii::t('app', '你好！欢迎参与未来出行高层论坛暨国际展览会');?></p>
        </div>
    </div>
    <div class="top-menu">
        <div class="container clearfix" >
            <a class="logo" href="/<?=$language?>"><img src="/images/logo.png"></a>
            <a class="top-news"  href="<?php if(isset($this->params['wlcxs'])){
                                            $wlcxs = $this->params['wlcxs'];
                                            if(isset($wlcxs['wlcxs'][0]['source'])){
                                                echo $wlcxs['wlcxs'][0]['source'];
                                            }else{
                                                echo '/news/grid/0';
                                            }
                                        }else{
                                            echo '/news/grid/0';
                                        } ?>">
            <img style="max-height: 70px" src="<?php if(isset($this->params['wlcxs'])){
                                                    $wlcxs = $this->params['wlcxs'];
                                                    if(isset($wlcxs['wlcxs'][0]['thumb'])){
                                                        echo $wlcxs['wlcxs'][0]['thumb'];
                                                    }else{
                                                        echo '/images/news-center.png';
                                                    }
                                                }else{
                                                    echo '/images/news-center.png';
                                                    }?>">
            </a>
            <ul class="index-meeting no-style pull-right">
                <li><i class="icon icon-address"></i> <?php echo \Yii::t('app', '中国 · 杭州');?></li>
                <li><i class="icon icon-time"></i> 2017.11.10 - 11.12</li>
            </ul>
            <div class="nav pull-right">
                <ul class="no-style">

                    <?php if(isset($this->params['class_one'])&&is_array($this->params['class_one'])&&count($this->params['class_one'])>0){ foreach($this->params['class_one'] as $key=>$value){?>
                        <li <?php if(isset($value['active'])&&$value['active']==1){echo 'class="active"';}?>>
                            <a href="<?=$value['url']?>"><span><?=$value['name']?></span></a>
                                <?php if(isset($this->params['class_two'])&&is_array($this->params['class_two'])&&count($this->params['class_two'])>0){?>
                                <ul class="no-style">
                                    <?php foreach($this->params['class_two'] as $kk=>$vv){ if($vv['parent_id']==$value['id']){?>
                                    <li <?php if(isset($value['active'])&&$value['active']==1&&isset($vv['active'])&&$vv['active']==1){echo 'class="active"';}?>>
                                        <a href="<?=$vv['url']?>"><?=$vv['name']?></a>
                                    </li>
                                    <?php }}?>
                                </ul>
                                <?php }?>
                        </li>
                    <?php }}?>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php if(isset($this->params['friend_link'])&&is_array($this->params['friend_link'])&&count($this->params['friend_link'])>0){?>
<div class="links">
    <div class="container">
        <span class="links-icon"><i class="icon link-icon"></i>i</span>
        <span class="text"><?php echo \Yii::t('app', '友情链接');?></span>
        <?php foreach($this->params['friend_link'] as $k=>$v){?>
            <a href="<?=$v['source']?>"><?=$v['title']?></a>
        <?php }?>
    </div>
</div>
<?php }?>
<div class="footer banner">
    <div class="container clearfix">
        <div class="footer-wx">
            <img src="/images/wx-chart.jpg">
        </div>
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
        <div class="footer-info pull-right">
            <img src="/images/f-logo.png">
            <p>版权所有 未来出行  Copyright © 2017 All Rights Reserved</p>
            <p>京ICP备13006032号-1</p>
        </div>
    </div>
</div>

<script  src="/js/vendor/jquery.min.js" type="text/javascript"></script>
<?php if(isset($this->params['item'])&&$this->params['item']=='meeting'){?>
    <script src="http://api.map.baidu.com/api?v=2.0&ak=OeXDXYIzPFbSxE9NxXhILHx28nYbd8xE" type="text/javascript"></script>
    <script src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js" type="text/javascript"></script>
<?php } ?>
<?php if(isset($this->params['item'])&&$this->params['item']=='news'){?>
    <script src="/js/vendor/jquery.dotdotdot.min.js" type="text/javascript"></script>
    <script src="/js/vendor/masonry.pkgd.min.js" type="text/javascript"></script>
<?php }?>
<?php if(isset($this->params['item'])&&$this->params['item']=='forum'){?>
    <script src="/js/vendor/perfect-scrollbar/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<?php }?>
    <?php if(isset($this->params['item'])&&$this->params['item']=='application'){?>
    <script src="/js/vendor/distpicker.min.js" type="text/javascript"></script>
    <script src="/js/vendor/jquery.form.js" type="text/javascript"></script>
    <script src="/js/verify.min.js" type="text/javascript"></script>

<?php }?>
    <script  src="/js/main.min.js" type="text/javascript"></script>
</body>
</html>
<?php $this->endPage() ?>
