<?php
use yii\web\View;
$this->title = \Yii::t('app', '下载详情');
$language = $this->params['language'];
?>
<div class="body">
	<div class="download-detail-page">
		<div class="resource-view">
			<?php if(isset($res['type'])&&$res['type']=='image'){?>
			<img src="<?php if(isset($res['thumb'])&&!empty($res['thumb'])){echo $res['thumb'];}?>">
			<?php }else{?>
			<img src="/images/pdf.png">
			<?php }?>
			<p class="resource-name"><?php if(isset($res['name'])&&!empty($res['name'])){echo $res['name'];}?></p>
		</div>
		<a class="download-btn" href="<?php if(isset($res['path'])&&!empty($res['path'])){echo $res['path'];}?>" download="<?php if(isset($res['name'])&&!empty($res['name'])){echo $res['name'];}?>"><?php echo \Yii::t('app', '下载');?><span class="resource-size">（<?=$res['size']?>）</span></a>
	</div>
</div>