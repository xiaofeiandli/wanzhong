<?php
use yii\web\View;
$this->title = $data['title'].'[万中华艺]';
?>
	<div class="body bg-color">
		<div class="container">
			<div class="article">
				<h1 class="article-title"><?=$data['title']?></h1>
				阅读数：<?=$data['read']?>
				发布时间：<?=$data['created_at']?>
				<div class="article-content">
					<p><?=$data['content']?></p>
				</div>
			</div>
		</div>
	</div>