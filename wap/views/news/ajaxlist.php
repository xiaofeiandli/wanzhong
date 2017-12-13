<?php
$language = $this->params['language'];
?>
<?php if(isset($data)&&is_array($data)&&count($data)>0){?>
     <?php foreach($data as $k=>$v){?>
<div class="news-item">
  <?php if(isset($v['thumb'])&&!empty($v['thumb'])){?>
  <div class="news-thumbnail" style="height:<?=$v['thumb_height']?>px">
    <a href="<?php if($language=='en'){echo '/en';}?>/news/detail/<?=$v['id']?>"><img src="<?=$v['thumb']?>"></a>
  </div>
  <?php }?>
  <div class="news-info">
    <a href="<?php if($language=='en'){echo '/en';}?>/news/detail/<?=$v['id']?>"><h2 class="news-title line-2"><?=$v['title']?></h2></a>
    <p class="news-summary line-4"><?=$v['description']?></p>
  </div>
</div>
<?php }?>
<?php }?>