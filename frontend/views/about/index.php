<?php
use yii\web\View;
$this->title = \Yii::t('app', '关于我们');
$language = $this->params['language'];
?>
<div class="about-page">
    <div class="about-banner banner" style="background-image:url('/images/about/banner-1.jpg')">
        <?php if(isset($conference)&&is_array($conference)&&count($conference)>0){ ?>
                <img src="<?=$conference[0]['thumb']?>">
         <?php   } ?>
    </div>
    <div>
        <div class="container">
            <?php if(isset($conference)&&is_array($conference)&&count($conference)>0){ ?>
                <div class="meeting-intro" id="intro">
                    <div class="meeting-title">
                        <div>
                            <div class="title-cover"></div>
                            <div class="inner-title">
                                 <div class="hide-title"><?=$conference[0]['title']?></div>
                                 <h1><?=$conference[0]['title']?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="meeting-content">
                        <?=$conference[0]['content']?>
                    </div>
                </div>
            <?php   } ?>

            <div class="meeting-units" id="units">
                <ul class="no-style clearfix units-5">
                    <?php
                    if(isset($led_by[0]['content'])&&empty($led_by[0]['content'])==false){ ?>
                        <li class="item-unit">
                            <div class="item-circle">
                                <div class="circle-cover"></div>
                                <i class="item-icon unit-2"></i>
                            </div>
                            <div class="unit-info">
                                <h3><?php echo \Yii::t('app', '指导单位');?></h3>
                                <hr>
                                <?=$led_by[0]['content']?>
                            </div>
                        </li>
                    <?php   } ?>
                    <li class="item-unit">
                        <div class="item-circle">
                            <div class="circle-cover"></div>
                            <i class="item-icon"></i>
                        </div>
                        <div class="unit-info">
                            <h3><?php echo \Yii::t('app', '主办单位');?></h3>
                            <hr>
                            <?php if(isset($sponsor_company)&&is_array($sponsor_company)&&count($sponsor_company)>0){ ?>
                               <?=$sponsor_company[0]['content']?>
                            <?php   } ?>
                        </div>
                    </li>
                    <li class="item-unit">
                        <div class="item-circle">
                            <div class="circle-cover"></div>
                            <i class="item-icon unit-4"></i>
                        </div>
                        <div class="unit-info">
                            <h3><?php echo \Yii::t('app', '承办单位');?></h3>
                            <hr>
                            <?php if(isset($organizer)&&is_array($organizer)&&count($organizer)>0){ ?>
                                <?=$organizer[0]['content']?>
                            <?php   } ?>
                        </div>
                    </li>
                    <li class="item-unit">
                        <div class="item-circle">
                            <div class="circle-cover"></div>
                            <i class="item-icon unit-5"></i>
                        </div>
                        <div class="unit-info">
                            <h3><?php echo \Yii::t('app', '协办单位');?></h3>
                            <hr>
                            <?php if(isset($co_organizer)&&is_array($co_organizer)&&count($co_organizer)>0){ ?>
                                <?=$co_organizer[0]['content']?>
                            <?php   } ?>
                          </div>
                    </li>
                    <li class="item-unit">
                        <div class="item-circle">
                            <div class="circle-cover"></div>
                            <i class="item-icon unit-3"></i>
                        </div>
                        <div class="unit-info">
                            <h3><?php echo \Yii::t('app', '战略支持');?></h3>
                            <hr>
                            <?php if(isset($co_sponsor)&&is_array($co_sponsor)&&count($co_sponsor)>0){ ?>
                                <?=$co_sponsor[0]['content']?>
                            <?php   } ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="abount-info banner" style="background-image:url('/images/about/banner-2.jpg')">
        <div class="container clearfix">
            <?php if(isset($organization)&&is_array($organization)&&count($organization)>0){ ?>
                <?php
                    foreach($organization as $ok=>$ov){
                 ?>
                        <div class="info-item">
                            <div class="info-logo">
                                <img src="<?=$organization[$ok]['thumb']?>">
                            </div>
                            <h2><?=$organization[$ok]['title']?></h2>
                            <h2><?=$organization[$ok]['description']?></h2>
                            <div class="info-detail">
                                <?=$organization[$ok]['content']?>
                            </div>
                        </div>
                <?php
                    }
                ?>
            <?php   } ?>
        </div>
    </div>
    <div class="about-media" id="media">
        <div class="container">
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '鸣谢榜单钻石级');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($acknowledgement_iamond)&&is_array($acknowledgement_iamond)&&count($acknowledgement_iamond)>0){ ?>
                        <?php
                        $i=1;
                        foreach($acknowledgement_iamond as $aik=>$aiv){ ?>
                            <a href="" target="_blank"><img src="<?=$acknowledgement_iamond[$aik]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '鸣谢榜单黄金级');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($acknowledgement_gold)&&is_array($acknowledgement_gold)&&count($acknowledgement_gold)>0){ ?>
                        <?php
                        $i=1;
                        foreach($acknowledgement_gold as $agk=>$agv){ ?>
                            <a href="" target="_blank"><img src="<?=$acknowledgement_gold[$agk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '鸣谢榜单白银级');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($acknowledgement_silver)&&is_array($acknowledgement_silver)&&count($acknowledgement_silver)>0){ ?>
                        <?php
                        $i=1;
                        foreach($acknowledgement_silver as $ask=>$asv){ ?>
                            <a href="" target="_blank"><img src="<?=$acknowledgement_silver[$ask]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '友情支持');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($cooperative_supporter)&&is_array($cooperative_supporter)&&count($cooperative_supporter)>0){ ?>
                        <?php
                        $i=1;
                        foreach($cooperative_supporter as $csk=>$csv){ ?>
                            <a href="" target="_blank"><img src="<?=$cooperative_supporter[$csk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '官方指定出行服务商');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($official_mobility)&&is_array($official_mobility)&&count($official_mobility)>0){ ?>
                        <?php
                        $i=1;
                        foreach($official_mobility as $omk=>$omv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$official_mobility[$omk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '官方指定接待商务车');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($official_shuttle)&&is_array($official_shuttle)&&count($official_shuttle)>0){ ?>
                        <?php
                        $i=1;
                        foreach($official_shuttle as $osk=>$osv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$official_shuttle[$osk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', 'VR独家支持');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($vr_exclusive)&&is_array($vr_exclusive)&&count($vr_exclusive)>0){ ?>
                        <?php
                        $i=1;
                        foreach($vr_exclusive as $vek=>$vev){
                        ?>
                            <a href="" target="_blank"><img src="<?=$vr_exclusive[$vek]['thumb']?>"></a>
                        <?php
                           $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '多媒体互动定制');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($multi_media)&&is_array($multi_media)&&count($multi_media)>0){ ?>
                        <?php
                        $i=1;
                        foreach($multi_media as $mmk=>$mmv){
                        ?>
                             <a href="" target="_blank"><img src="<?=$multi_media[$mmk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '特别报道');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($special_report)&&is_array($special_report)&&count($special_report)>0){ ?>
                        <?php
                        $i=1;
                        foreach($special_report as $spk=>$spv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$special_report[$spk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '官方合作');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($official_partners)&&is_array($official_partners)&&count($official_partners)>0){ ?>
                        <?php
                        $i=1;
                        foreach($official_partners as $ofk=>$ofv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$official_partners[$ofk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '战略合作');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($strategic_partners)&&is_array($strategic_partners)&&count($strategic_partners)>0){ ?>
                        <?php
                        $i=1;
                        foreach($strategic_partners as $stk=>$stv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$strategic_partners[$stk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '独家视频');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($exclusive_video)&&is_array($exclusive_video)&&count($exclusive_video)>0){ ?>
                        <?php
                        $i=1;
                        foreach($exclusive_video as $exk=>$exv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$exclusive_video[$exk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '特邀门户');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($invited_potal)&&is_array($invited_potal)&&count($invited_potal)>0){ ?>
                        <?php
                        $i=1;
                        foreach($invited_potal as $ink=>$inv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$invited_potal[$ink]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '重点支持');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($key_supporter)&&is_array($key_supporter)&&count($key_supporter)>0){ ?>
                        <?php
                        $i=1;
                        foreach($key_supporter as $kek=>$kev){
                        ?>
                            <a href="" target="_blank"><img src="<?=$key_supporter[$kek]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '特邀伙伴');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($invited_partners)&&is_array($invited_partners)&&count($invited_partners)>0){ ?>
                        <?php
                        $i=1;
                        foreach($invited_partners as $ik=>$iv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$invited_partners[$ik]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '深度支持');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($key_partners)&&is_array($key_partners)&&count($key_partners)>0){ ?>
                        <?php
                        $i=1;
                        foreach($key_partners as $kk=>$kv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$key_partners[$kk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
            <div class="media-items">
                <div class="item-title-2">
                    <hr>
                    <hr class="title-line">
                    <h2 class="title-content"><span><?php echo \Yii::t('app', '新媒体矩阵');?></span></h2>
                </div>
                <div class="media-list">
                    <?php if(isset($new_media)&&is_array($new_media)&&count($new_media)>0){ ?>
                        <?php
                        $i=1;
                        foreach($new_media as $nk=>$nv){
                        ?>
                            <a href="" target="_blank"><img src="<?=$new_media[$nk]['thumb']?>"></a>
                        <?php
                            $i++;}
                        ?>
                    <?php   } ?>
                </div>
            </div>
        </div>
    </div>
</div>