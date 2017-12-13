<?php
use yii\web\View;
$this->title = \Yii::t('app', '展会信息');
$this->registerCssFile("http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css");
$language = $this->params['language'];
?>
<div class="body">
    <div class="meeting-page">
        <div class="meeting-item">
            <div class="title-item-2">
                <img class="title-icon" src="/images/title_icon.png">
                <hr class="title-line">
                <span class="title-content"><?php echo \Yii::t('app', '参会指南');?></span>
            </div>
            <?php
            if($language=='en'){
                ?>
                <div class="item-content">
                    <div>
                        <div class="label-info clearfix">
                            <span class="label-title">VENUE</span>
                            <div class="label-content">
                                <p>HANGZHOU INTERNATIONAL EXPO CENTER</p>
                            </div>
                        </div>
                        <div class="label-info clearfix">
                            <span class="label-title">LOCATION</span>
                            <div class="label-content">
                                <p>Hangzhou City, Xiaoshan District, Qianjiang City, No. 353 race Avenue</p>
                            </div>
                        </div>
                        <div class="label-info clearfix">
                            <span class="label-title">TRAFFIC</span>
                            <div class="label-content">
                                <p>SUBWAY: Qian Jiang century city Station  by Line 2 </p>
                                <p>TRAIN: 13 km from HANG ZHOU EAST train station, about 15 minutes’ driving</p>
                                <p>AIRPORT: 18 km from HANG ZHOU INTERNATIONAL AIRPORT, about 20 minutes’ driving</p>
                            </div>
                        </div>
                    </div>
                    <div class="map" id="map"></div>
                </div>
                <?php
            }else{
            ?>
            <div class="item-content">
                <div>
                    <div class="label-info clearfix">
                        <span class="label-title">参会地点</span>
                        <div class="label-content">
                            <p>杭州国际博览中心</p>
                        </div>
                    </div>
                    <div class="label-info clearfix">
                        <span class="label-title">参会地址</span>
                        <div class="label-content">
                            <p>杭州市萧山区钱江世纪城奔竞大道353号</p>
                        </div>
                    </div>
                    <div class="label-info clearfix">
                        <span class="label-title">交通信息</span>
                        <div class="label-content">
                            <p>地铁：地铁2号线（钱江世纪城站）</p>
                            <p>火车站：距离杭州东站13公里，约15分钟车程。</p>
                            <p>机场：距离杭州萧山国际机场18公里，20分钟车程。</p>
                        </div>
                    </div>
                </div>
                <div class="map" id="map"></div>
            </div>
            <?php } ?>
        </div>
        <div class="meeting-item">
            <div class="title-item-2">
                <img class="title-icon" src="/images/title_icon.png">
                <hr class="title-line">
                <span class="title-content"><?php echo \Yii::t('app', '周边酒店');?></span>
            </div>
            <div class="item-content">
                <ul class="arounds no-styel">
                    <?php if(isset($perimeter_hotel)&&is_array($perimeter_hotel)&&count($perimeter_hotel)>0){ ?>
                        <?php
                        foreach($perimeter_hotel as $pek=>$pev){
                                ?>
                                <li class="around">
                                    <a class="around-view">
                                        <img src="<?=$perimeter_hotel[$pek]['thumb']?>">
                                        <p><?=$perimeter_hotel[$pek]['title']?></p>
                                    </a>
                                    <div class="around-info">
                                        <?=$perimeter_hotel[$pek]['content']?>
                                    </div>
                                </li>
                            <?php   }} ?>
                </ul>
            </div>
        </div>
        <div class="meeting-item">
            <div class="title-item-2">
                <img class="title-icon" src="/images/title_icon.png">
                <hr class="title-line">
                <span class="title-content"><?php echo \Yii::t('app', '周边景点');?></span>
            </div>
            <div class="item-content">
                <ul class="arounds scenic no-style">
                    <?php if(isset($surrounding_attractions)&&is_array($surrounding_attractions)&&count($surrounding_attractions)>0){ ?>
                        <?php
                        foreach($surrounding_attractions as $sk=>$sv){
                                ?>
                                <li class="around">
                                    <div class="around-view">
                                        <img src="<?=$surrounding_attractions[$sk]['thumb']?>">
                                    </div>
                                    <div class="around-info">
                                        <p><?=$surrounding_attractions[$sk]['title']?></p>
                                    </div>
                                </li>
                            <?php   }} ?>
                </ul>
            </div>
        </div>
    </div>
</div>