<?php
use yii\web\View;
$this->title = '下载管理';
$this->registerCssFile("@web/css/plugins/fancybox/source/jquery.fancybox.css");
$this->registerCssFile("@web/css/plugins/portfolio.css");
$this->registerCssFile("@web/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css");
$this->registerCssFile("@web/js/plugins/uploader/webuploader.css");
?>
<div class="portlet box blue-hoki" style="margin-bottom: 0px;">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-file-pdf-o"></i>文档</div>
    </div>
</div>
<div class="margin-top-10">
    <div class="mix-grid clearfix">
        <?php if(isset($pdf)&&$pdf&&count($pdf)>0){ foreach($pdf as $k=>$v){?>
        <div class="mix item pdf-item">
            <div class="mix-inner">
                <div>
                    <img class="img-responsive" src="/images/pdf.png">
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
<div class="portlet box blue-hoki" style="margin-bottom: 0px;">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-file-picture-o"></i>图片</div>
    </div>
</div>
<div class="margin-top-10">
    <div class="row mix-grid masonry-container" id="masonry-container">
        <?php if(isset($pictures)&&$pictures&&count($pictures)>0){ foreach($pictures as $k=>$v){?>
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
<div>

</div>

