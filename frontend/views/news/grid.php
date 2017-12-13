<?php
use yii\web\View;
$this->title = \Yii::t('app', '新闻中心');
$language = $this->params['language'];
?>
<div class="news-center" id="news">
    <div class="container">
       <div class="news-nav clearfix">
           <div class="news-type pull-right">
               <a id='grid-list'  class="active" href="<?php if($language=='en'){echo '/en';}?>/news/grid/<?=$id?>" title="<?php echo \Yii::t('app', '瀑布流模式');?>"><i class="icon icon-grid"></i></a>
               <a id="normal-list" href="<?php if($language=='en'){echo '/en';}?>/news/list/<?=$id?>" title="<?php echo \Yii::t('app', '列表模式');?>"><i class="icon icon-list"></i></a>
           </div>
           <div  class="news-tags">
               <a <?php if((isset($cate_id_arr)&&!in_array($id, $cate_id_arr))||!isset($cate_id_arr)){?>class="active"<?php }?> href="<?php if($language=='en'){echo '/en';}?>/news/<?=$type?>/0" title="<?php echo \Yii::t('app', '全部');?>"><?php echo \Yii::t('app', '全部');?></a>
               <?php if(isset($cate_id_arr)&&is_array($cate_id_arr)&&count($cate_id_arr)>0){foreach($cate_res as $k=>$v){?>
               <a <?php if($id==$v['id']){?>class="active"<?php }?>  href="<?php if($language=='en'){echo '/en';}?>/news/<?=$type?>/<?=$v['id']?>" title="<?=$v['name']?>"><?=$v['name']?></a>
               <?php }}?>
           </div>
       </div>
		<div class="news-list clearfix grid" id="news_list" <?php if(!isset($news_res)||!is_array($news_res)||count($news_res)==0){?>style="min-height: 400px"<?php }?>>
       <?php if(isset($news_res)&&is_array($news_res)&&count($news_res)>0){?>
			<?php foreach($news_res as $k=>$v){?>
			<div class="news-item">
			<?php if(isset($v['thumb'])&&!empty($v['thumb'])){?>
			   <div class="news-thumbnail" style=" <?php if(isset($v['thumb_height'])&&$v['thumb_height']>0){ $height = $v['thumb_height'];
			             echo 'height:'.$height.'px';}?>">
			       <a href="<?php if($language=='en'){echo '/en';}?>/news/detail/<?=$v['id']?>">
			            <img src="<?=$v['thumb']?>">
			        </a>
			   </div>
			   <?php }?>
			   <div class="news-info">
			       <a href="<?php if($language=='en'){echo '/en';}?>/news/detail/<?=$v['id']?>"><h2 class="news-item-title"><?=$v['title']?></h2></a>
			       <p class="news-item-summary"><?=$v['description']?></p>
			       <div class="news-label">
			           <span><?=$v['created_at']?></span>
			       </div>
			   </div>
			</div>
			<?php }?>
		</div>
		<?php } if(isset($news_res)&&is_array($news_res)&&count($news_res)>0){?>
		<?php if($news_count>$page*12){?>
		<div class="item-title-2">
            <hr>
            <hr class="title-line">
            <h3 class="title-content"><span id="add_more" data-last="<?=$last_id?>" data-page="<?=$page+1?>" data-id="<?=$id?>" data-total="<?=$news_count?>"><?php echo \Yii::t('app', '加载更多');?></span></h3>
        </div>
        <?php }}?>
    </div>
</div>