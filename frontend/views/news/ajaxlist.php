
<?php if($type=='list'){?>
<?php foreach($data as $k=>$v){?>
<div class="news-item">
    <?php if(isset($v['thumb'])&&!empty($v['thumb'])){?>
   <div class="news-thumbnail">
       <a href="<?php if($language=='en'){echo '/en';}?>/news/detail/<?=$v['id']?>"><img src="<?=$v['thumb']?>"></a>
   </div>
   <?php }?>
   <div class="news-info">
       <a href="<?php if($language=='en'){echo '/en';}?>/news/detail/<?=$v['id']?>"><h2 class="over-hidden"><?=$v['title']?></h2></a>
       <p><?=$v['description']?></p>
       <div class="news-label">
           <span><?=$v['created_at']?></span>
           <span class="news-tag"><i class="icon"></i><?=$v['category_name']?></span>
       </div>
   </div>
</div>
<?php }?> 	
<?php }else{?>
<?php foreach($data as $k=>$v){?>
<div class="news-item">
<?php if(isset($v['thumb'])&&!empty($v['thumb'])){?>
   <div class="news-thumbnail">
       <a href="<?php if($language=='en'){echo '/en';}?>/news/detail/<?=$v['id']?>"><img <?php if(isset($v['thumb_height'])&&$v['thumb_height']>0){ $height = $v['thumb_height'];
                   echo "height=".$height;}?>  src="<?=$v['thumb']?>"></a>
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
<?php }?>