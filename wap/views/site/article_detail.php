<?php
use yii\web\View;
$this->title = '详情';
?>
<div id="detail" v-cloak>

	<div class="article">
		<?php if($res){?>
        <h1><?=$res['title']?></h1>
        <div class="info">
            <span>作者：<?=$res['author']?></span>
            <span>发布时间：<?=$res['created_at']?></span>
            <span>阅读数：<?=$res['read']?></span>
        </div>
        <div class="line"></div>
        <div class="article-content">
            <?=$res['content']?>
        </div>
        <?php }//else{echo 'false';}?>
    </div>
</div>