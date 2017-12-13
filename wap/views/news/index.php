<?php
use yii\web\View;
$this->title = \Yii::t('app', '新闻中心');
$language = $this->params['language'];
?>
<div class="body">
	<div class="news-center-page">
		<div  class="news-tags flex flex-justify">
			<a <?php if((isset($cate_id_arr)&&!in_array($id, $cate_id_arr))||!isset($cate_id_arr)){?>class="active"<?php }?> href="<?php if($language=='en'){echo '/en';}?>/news/<?=$type?>/0" title="<?php echo \Yii::t('app', '全部');?>">
				<div class="flex flex-center"><?php echo \Yii::t('app', '全部');?></div>
			</a>
           <?php if(isset($cate_id_arr)&&is_array($cate_id_arr)&&count($cate_id_arr)>0){foreach($cate_res as $k=>$v){?>
           <a <?php if($id==$v['id']){?>class="active"<?php }?>  href="<?php if($language=='en'){echo '/en';}?>/news/<?=$type?>/<?=$v['id']?>" title="<?=$v['name']?>">
				<div class="flex flex-center"><?=$v['name']?></div>
			</a>
           <?php }}?>
		</div>
		<div class="news-list flex flex-justify flex-wrap" id="grid" style="min-height: 400px" <?php if(!isset($news_res)||!is_array($news_res)||count($news_res)==0){?>style="min-height: 400px"<?php }?>>
		</div>
		 <?php if(isset($news_res)&&is_array($news_res)&&count($news_res)>0){?>
		 <div class="title-item">
         			<hr>
         			<hr class="title-line">
         			<h3 class="title-content"><span id="add_more" data-last="0" data-page="1" data-id="<?=$id?>" data-total="<?=$news_count?>"><?php echo \Yii::t('app', '加载更多');?></span></h3>
         		</div>
		<?php }?>
	</div>
</div>
