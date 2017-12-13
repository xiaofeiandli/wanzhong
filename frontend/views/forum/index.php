<?php
use yii\web\View;
$this->title = \Yii::t('app', '论坛信息');
$this->registerCssFile("/js/vendor/perfect-scrollbar/perfect-scrollbar.css");
$language = $this->params['language'];
?>
<div class="forum-page">
    <div class="container">
        <?php if(isset($theme_fornum)&&is_array($theme_fornum)&&count($theme_fornum)>0){ ?>
            <div class="forum-title banner"   style="background-image: url('/images/forum/forum-title.jpg')">
                <h3><?=$theme_fornum[0]['keywords']?></h3>
                <div class="title-line">
                    <img src="/images/forum/title-line.png">
                </div>
                <h2><?=$theme_fornum[0]['title']?></h2>
                <div class="banner-cover">
                    <span class="forum-detail" id="main_forum" data-id=<?=$theme_fornum[0]['id']?>><?php echo \Yii::t('app', '查看详情');?></span>
                </div>
            </div>
        <?php   } ?>
        <ul class="forum-items clearfix no-style" id="forums">
            <?php if(isset($parallel_forum)&&is_array($parallel_forum)&&count($parallel_forum)>0){ ?>
                <?php
                $i=1;
                foreach($parallel_forum as $pk=>$pv){
                    if($i%5==0){
                    ?>
                    <li class="forum-item margin" style="background-image:url('<?=$parallel_forum[$pk]['thumb']?>')">
                        <div class="forum-info">
                            <h4><?=$parallel_forum[$pk]['keywords']?></h4>
                            <div class="forum-line"></div>
                            <h3><?=$parallel_forum[$pk]['title']?></h3>
                        </div>
                        <div class="forum-cover">
                            <span class="forum-detail" data-color="<?=$parallel_forum[$pk]['author']?>" data-id=<?=$parallel_forum[$pk]['id']?>><?php echo \Yii::t('app', '查看详情');?></span>
                        </div>
                    </li>
                    <?php
                         }else{ ?>
                        <li class="forum-item" style="background-image:url('<?=$parallel_forum[$pk]['thumb']?>')">
                            <div class="forum-info">
                                <h4><?=$parallel_forum[$pk]['keywords']?></h4>
                                <div class="forum-line"></div>
                                <h3><?=$parallel_forum[$pk]['title']?></h3>
                            </div>
                            <div class="forum-cover">
                                <span class="forum-detail" data-color="<?=$parallel_forum[$pk]['author']?>" data-id=<?=$parallel_forum[$pk]['id']?>><?php echo \Yii::t('app', '查看详情');?></span>
                            </div>
                        </li>
            <?php   }$i++;}} ?>
        </ul>
    </div>
    <div class="forum-gusets" id="gusets">
        <div class="container">
            <div class="item-title-2">
                <hr>
                <hr class="title-line">
                <h3 class="title-content"><span><?php echo \Yii::t('app', '参会嘉宾');?></span></h3>
            </div>
            <div style="color: #666; padding-top:5px;"><?php echo \Yii::t('app', '（按姓氏拼音首字母排序）');?></div>
            <ul class="guset-items clearfix no-style">
                <?php if(isset($participant)&&is_array($participant)&&count($participant)>0){ ?>
                    <?php
                    $i=1;
                    foreach($participant as $pak=>$pav){
                        if($i%5==0){
                            ?>
                            <li class="guset-item margin">
                                <div class="guset-photo">
                                    <img src="<?=$participant[$pak]['thumb']?>">
                                </div>
                                <div class="guset-info">
                                    <p><b><?=$participant[$pak]['title']?></b></p>
                                    <p><?=$participant[$pak]['content']?></p>
                                </div>
                            </li>
                            <?php
                        }else{ ?>
                            <li class="guset-item">
                                <div class="guset-photo">
                                    <img src="<?=$participant[$pak]['thumb']?>">
                                </div>
                                <div class="guset-info">
                                    <p><b><?=$participant[$pak]['title']?></b></p>
                                    <p><?=$participant[$pak]['content']?></p>
                                </div>
                            </li>

                        <?php   }$i++;}} ?>
            </ul>
        </div>
    </div>
</div>