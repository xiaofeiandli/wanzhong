<?php
use yii\web\View;
$this->title = \Yii::t('app', '页面未找到');
$language = $this->params['language'];
?>
<div class="body">
	<div class="error-page">
		<div class="error-text">404<br><?php echo \Yii::t('app', '您所寻找的页面不存在');?></div>
	</div>
</div>