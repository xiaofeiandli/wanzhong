<?php
use yii\web\View;
$this->title = '详情';
?>
<div id="detail" v-cloak>

	<div class="article">
        <h1>{{title}}</h1>
        <div class="info">
            <span>作者：万中</span>
            <span>发布时间：{{created_at}}</span>
            <span>阅读数：{{read}}</span>
        </div>
        <div class="line"></div>
        <div class="article-content" v-html="content">
            
        </div>
    </div>
</div>