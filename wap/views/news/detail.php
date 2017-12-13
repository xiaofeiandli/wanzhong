<?php
use yii\web\View;
$this->title = isset($detail['title'])?$detail['title'].'_新闻详情':'新闻详情';
$language = $this->params['language'];
?>
<div class="body">
		<div class="news-page">
		<?php if(isset($detail)&&is_array($detail)&&count($detail)>0){?>
			<div class="news-header">
				<h1 class="title"><?php if(isset($detail['title'])){echo $detail['title'];}?></h1>
				<div class="info">
					<span><?php if(isset($detail['created_at'])){echo $detail['created_at'];}?></span>
					<span class="tag"><i class="icon"></i><?php if(isset($detail['category_name'])){echo $detail['category_name'];}?></span>
					<span>
						<?php if(isset($detail['source'])&&!empty($detail['source'])){echo $detail['source'];}?>

						<?php if(isset($detail['source'])&&!empty($detail['source'])&&isset($detail['author'])&&!empty($detail['author'])){echo '/';}?>
						<?php if(isset($detail['author'])&&!empty($detail['author'])){echo $detail['author'];}?>
					
					</span>
				</div>
			</div>
			<div class="content">
				<?php if(isset($detail['content'])){echo $detail['content'];}?>
			</div>

			<!-- JiaThis Button BEGIN -->
			<div class="jiathis_style_32x32" style="float:right;">
				<a class="jiathis_button_weixin"></a>
				<a class="jiathis_button_tsina"></a>
				<!--<a class="jiathis_button_tqq"></a>-->
				<a class="jiathis_button_cqq"></a>
				<a class="jiathis_button_email"></a>
				<!--<a class="jiathis_button_copy"></a>-->
				<!--<a href="http://www.jiathis.com/share?uid=908050" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>-->
				<!--<a class="jiathis_counter_style"></a>-->
			</div>
			<script type="text/javascript">
				var jiathis_config = {data_track_clickback:'true'};
			</script>
			<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=908050" charset="utf-8"></script>
			<!-- JiaThis Button END -->

		<?php }?>
		</div>
	</div>