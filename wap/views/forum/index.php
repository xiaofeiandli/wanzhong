<?php
use yii\web\View;
$this->title = \Yii::t('app', '论坛信息');
$language = $this->params['language'];
?>
<div class="body">
    <div class="forum-page">
        <div class="main-forum">
            <?php if(isset($theme_fornum)&&is_array($theme_fornum)&&count($theme_fornum)>0){ ?>
                <a href="<?php if($language=='en'){echo '/en';}?>/forum/detail/<?=$theme_fornum[0]['id']?>">
                    <h3><?=$theme_fornum[0]['keywords']?></h3>
                    <h2><?=$theme_fornum[0]['title']?></h2>
                </a>
            <?php   } ?>
        </div>
        <div class="forum-list flex flex-justify flex-wrap">
            <?php if(isset($parallel_forum)&&is_array($parallel_forum)&&count($parallel_forum)>0){ ?>
                <?php
                foreach($parallel_forum as $pk=>$pv){
                        ?>
                    <div class="forum-item" style="background-image: url('<?=$parallel_forum[$pk]['thumb']?>')">
                        <a class="forum-info" href="<?php if($language=='en'){echo '/en';}?>/forum/detail/<?=$parallel_forum[$pk]['id']?>">
                            <h4 class="forum-title"><?=$parallel_forum[$pk]['keywords']?></h4>
                            <div class="forum-line"></div>
                            <h3  class="forum-title-text line-4"><?=$parallel_forum[$pk]['title']?></h3>
                        </a>
                    </div>
                    <?php   }} ?>
            <div class="empty-forum"></div>
            <div class="empty-forum"></div>
        </div>
        <div class="forum-gusets">
            <div class="title-item">
                <hr>
                <hr class="title-line">
                <h2 class="title-content">
                    <span><?php echo \Yii::t('app', '参会嘉宾');?></span><br>
                    <span style="font-size: .25rem;"><?php echo \Yii::t('app', '（按姓氏拼音首字母排序）');?></span>
                </h2>
            </div>
            <div class="gusets-list flex flex-justify flex-wrap">
                <?php if(isset($participant)&&is_array($participant)&&count($participant)>0){ ?>
                    <?php
                    foreach($participant as $pak=>$pav){
                            ?>
                        <div class="guset-item">
                            <div class="guset-photo">
                                <img src="<?=$participant[$pak]['thumb']?>">
                            </div>
                            <div class="guset-info">
                                <p class="name"><?=$participant[$pak]['title']?></p>
                                <div class="intro"><?=$participant[$pak]['content']?></div>
                            </div>
                        </div>
                        <?php   }} ?>
                <div class="empty-guset"></div>
                <div class="empty-guset"></div>
            </div>
        </div>
    </div>
</div>