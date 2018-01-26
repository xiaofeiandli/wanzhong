<?php
use yii\web\View;
$this->title = '资源管理';
$this->registerCssFile("@web/css/plugins/fancybox/source/jquery.fancybox.css");
$this->registerCssFile("@web/css/plugins/portfolio.css");
$this->registerCssFile("@web/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css");
$this->registerCssFile("@web/js/plugins/uploader/webuploader.css");
?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="fa fa-file-picture-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     <?=$count['calligraphy']?>
                </div>
                <div class="desc">
                     书法
                </div>
            </div>
            <a class="more" href="/resource/index/calligraphy">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-file-picture-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     <?=$count['image']?>
                </div>
                <div class="desc">
                     画
                </div>
            </div>
            <a class="more" href="/resource/index/image">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-hoki">
            <div class="visual">
                <i class="fa fa-file-audio-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     <?=$count['audio']?>
                </div>
                <div class="desc">
                     音频
                </div>
            </div>
            <a class="more" href="/resource/index/audio">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">
                <i class="fa fa-file-video-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     <?=$count['video']?>
                </div>
                <div class="desc">
                     视频
                </div>
            </div>
            <a class="more" href="/resource/index/video">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<?php if($type=='video'){?>
<div class="portlet box <?php if($type=='video'){echo 'purple-plum';}else{echo 'blue-madison';}?>" style="margin-bottom: 0px;">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-file-video-o"></i>视频</div>
    </div>
</div>
<div class="margin-top-10">
    <div class="mix-grid clearfix masonry-container"  id="masonry-container">
        <?php if(isset($video)&&$video&&count($video)>0){ foreach($video as $k=>$v){?>
        <div class="mix item pdf-item">
            <div class="mix-inner">
                <div>
                    <img class="img-responsive" src="/images/video.png">
                    <p class="pdf-name line-clamp-2"><?=$v['name']?></p>
                </div>
                <div class="mix-details">
                    <div class="mix-desc"><?=$v['description']?></div>
                    <a class="mix-link remove" data-id="<?=$v['id']?>"><i class="fa fa-remove"></i></a>
                    <a class="mix-preview" href="<?=$v['path']?>" title=""><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <?php }}?>
    </div>
</div>
<?php }elseif($type=='audio'){?>
<div class="portlet box <?php if($type=='audio'){echo 'blue-hoki';}else{echo 'blue-madison';}?>" style="margin-bottom: 0px;">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-file-audio-o"></i>音频</div>
    </div>
</div>
<div class="margin-top-10">
    <div class="mix-grid clearfix masonry-container"  id="masonry-container">
        <?php if(isset($audio)&&$audio&&count($audio)>0){ foreach($audio as $k=>$v){?>
        <div class="mix item pdf-item">
            <div class="mix-inner">
                <div>
                    <img class="img-responsive" src="/images/audio.png">
                    <p class="pdf-name line-clamp-2"><?=$v['name']?></p>
                </div>
                <div class="mix-details">
                    <div class="mix-desc"><?=$v['description']?></div>
                    <a class="mix-link remove" data-id="<?=$v['id']?>"><i class="fa fa-remove"></i></a>
                    <a class="mix-preview" href="<?=$v['path']?>" title=""><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <?php }}?>
    </div>
</div>
<?php }elseif($type=='calligraphy'){?>
<div class="portlet box  <?php if($type=='calligraphy'){echo 'blue-madison';}else{echo 'blue-madison';}?>" style="margin-bottom: 0px;">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-file-picture-o"></i>书法</div>
    </div>
</div>
<div class="margin-top-10">
    <div class="row mix-grid masonry-container" id="masonry-container">
        <?php if(isset($calligraphy)&&$calligraphy&&count($calligraphy)>0){ foreach($calligraphy as $k=>$v){?>
        <div class="col-md-3 mix item image-item">
            <div class="mix-inner">
                <img class="img-responsive" src="<?=$v['thumb']?>" style="min-height: 100px">
                <div class="mix-details">
                    <div class="mix-desc"><?php if($v['description']){echo $v['description'];}else{echo '该图片的描述为空。';}?></div>
                    <a class="mix-link remove" data-id="<?=$v['id']?>"><i class="fa fa-remove"></i></a>
                    <a class="mix-preview fancybox-button" href="<?=$v['path']?>" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <?php }}?>
    </div>
</div>
<?php }else{?>
<div class="portlet box  <?php if($type=='image'){echo 'red';}else{echo 'red';}?>" style="margin-bottom: 0px;">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-file-picture-o"></i>画</div>
    </div>
</div>
<div class="margin-top-10">
    <div class="row mix-grid masonry-container" id="masonry-container">
        <?php if(isset($image)&&$image&&count($image)>0){ foreach($image as $k=>$v){?>
        <div class="col-md-3 mix item image-item">
            <div class="mix-inner">
                <img class="img-responsive" src="<?=$v['thumb']?>" style="min-height: 100px">
                <div class="mix-details">
                    <div class="mix-desc"><?php if($v['description']){echo $v['description'];}else{echo '该图片的描述为空。';}?></div>
                    <a class="mix-link remove" data-id="<?=$v['id']?>"><i class="fa fa-remove"></i></a>
                    <a class="mix-preview fancybox-button" href="<?=$v['path']?>" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </div>
        <?php }}?>
    </div>
</div>
<?php }?>

