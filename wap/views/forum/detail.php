<?php
use yii\web\View;
$this->title = \Yii::t('app', '论坛详情');
$language = $this->params['language'];
?>
<div class="body">
    <div class="forum-detail-page">
        <div class="forum-detail">
            <?php if(isset($detail)&&is_array($detail)&&count($detail)>0){ ?>
                <div class="forum-title">
                    <p><?=$detail['keywords']?></p>
                    <h2><?=$detail['title']?></h2>
                </div>
                <div class="forum-content">
                    <?=$detail['content']?>
                </div>
            <?php   } ?>
        </div>
    </div>
</div>
