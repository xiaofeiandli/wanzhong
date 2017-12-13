<?php
use yii\web\View;
$this->title = \Yii::t('app', '下载专区');
$language = $this->params['language'];
?>
<div class="body">
	<div class="download-page">
		<div class="download-item">
			<div class="title-item-2">
				<img class="title-icon" src="/images/title_icon.png">
				<hr class="title-line">
				<span class="title-content"><?php echo \Yii::t('app', '资料下载');?></span>
			</div>
			<div class="pdfs flex flex-justify flex-wrap">
			<?php if(is_array($pdf)&&count($pdf)>0){ foreach($pdf as $pk=>$pv){ ?>
				<div class="pdf-item"  data-id="<?=$pv['id']?>">
					<a href="<?php if($language=='en'){echo '/en';}?>/download/detail/<?=$pv['id']?>">
						<img src="/images/pdf.png">
						<p class="pdf-name line-1"><?=$pv['name']?></p>
					</a>
				</div>
			<?php }}?>
			</div>
		</div>
		<div class="download-item">
			<div class="title-item-2">
				<img class="title-icon" src="/images/title_icon.png">
				<hr class="title-line">
				<span class="title-content"><?php echo \Yii::t('app', '高清图片');?></span>
			</div>
			<div class="images flex flex-justify flex-wrap">
			<?php if(is_array($pictures)&&count($pictures)>0){ foreach($pictures as $pik=>$piv){?>
				<div class="image-item">
					<a href="<?php if($language=='en'){echo '/en';}?>/download/detail/<?=$piv['id']?>">
						<img src="<?=$piv['thumb']?>">
					</a>
				</div>
			<?php }}?>
			</div>
		</div>
	</div>
</div>
