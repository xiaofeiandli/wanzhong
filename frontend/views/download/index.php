<?php
use yii\web\View;
$this->title = \Yii::t('app', '下载专区');
$language = $this->params['language'];
?>
<div class="download-page" id="download_page">
    <div class="container">
        <div class="download-item">
            <div class="item-title">
                <h2><i></i><hr><span><?php echo \Yii::t('app', '资料下载');?></span></h2>
            </div>
            <div class="item-content" id="pdfs">
                <ul class="resource clearfix no-style">
                    <?php if(is_array($pdf)&&count($pdf)>0){?>
                    <?php
                        $i=1;
                        foreach($pdf as $pk=>$pv){
                            if($i%4==0){
                    ?>
                        <li class="pdf margin" data-id="<?=$pv['id']?>">
                            <i class="icon"></i>
                            <img src="/images/pdf.png">
                            <p class="pdf-name over-hidden"><?=$pv['name']?></p>
                        </li>
                    <?php }else{?>
                        <li class="pdf" data-id="<?=$pv['id']?>">
                            <i class="icon"></i>
                            <img src="/images/pdf.png">
                            <p class="pdf-name over-hidden"><?=$pv['name']?></p>
                        </li>
                    <?php }
                        $i++;
                        }} ?>
                </ul>
                <div class="download-action clearfix">
                    <div class="download-number">
                        <span class="all"><i class="icon"></i>.</span>
                        <span><?php echo \Yii::t('app', '已选中');?><span class="number">0</span><?php echo \Yii::t('app', '个文件');?></span>
                    </div>
                    <button class="download-btn" type="button"><i class="icon"></i><?php echo \Yii::t('app', '批量下载');?></button>
                </div>
            </div>
        </div>
        <div class="download-item">
            <div class="item-title">
                <h2><i></i><hr><span><?php echo \Yii::t('app', '高清图片');?></span></h2>
            </div>
            <div class="item-content" id="imgs">
                <ul class="resource clearfix no-style">
                    <?php if(is_array($pictures)&&count($pictures)>0){?>
                        <?php
                        $i=1;
                        foreach($pictures as $pik=>$piv){
                            if($i%3==0){
                                ?>
                                <li class="img margin" data-id="<?=$piv['id']?>">
                                    <i class="icon"></i>
                                    <img src="<?=$piv['thumb']?>">
                                    <div class="cover"></div>
                                </li>
                            <?php }else{?>
                                <li class="img" data-id="<?=$piv['id']?>">
                                    <i class="icon"></i>
                                    <img src="<?=$piv['thumb']?>">
                                    <div class="cover"></div>
                                </li>
                            <?php }
                            $i++;
                        }} ?>
                </ul>
                <div class="download-action clearfix">
                    <div class="download-number">
                        <span class="all"><i class="icon"></i>.</span>
                        <span><?php echo \Yii::t('app', '已选中');?><span class="number">0</span><?php echo \Yii::t('app', '个文件');?></span>
                    </div>
                    <button class="download-btn" type="button"><i class="icon"></i><?php echo \Yii::t('app', '批量下载');?></button>
                </div>
            </div>
        </div>
    </div>
</div>