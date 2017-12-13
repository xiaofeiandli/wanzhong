<?php
use yii\web\View;
$this->title = \Yii::t('app', '展会信息');
$this->registerCssFile("http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css");
$language = $this->params['language'];
?>
<div class="meeting-page">
    <div class="container">
        <div class="meeting-info" id="info">
            <div class="item-title">
                <h2><i></i><hr><span><?php echo \Yii::t('app', '参会指南');?></span></h2>
            </div>
            <?php
                if($language=='en'){
            ?>
                    <div class="item-content" style="margin-top: 13px;">
                        <div class="label-info clearfix">
                            <div class="label-title">
                                <span>VENUE</span>
                            </div>
                            <div class="label-content">
                                <p>HANGZHOU INTERNATIONAL EXPO CENTER</p>
                            </div>
                        </div>
                        <div class="label-info clearfix">
                            <div class="label-title">
                                <span>LOCATION </span>
                            </div>
                            <div class="label-content">
                                <p>Hangzhou City, Xiaoshan District, Qianjiang City, No. 353 race Avenue</p>
                            </div>
                        </div>
                        <div class="label-info clearfix">
                            <div class="label-title">
                                <span>TRAFFIC</span>
                            </div>
                            <div class="label-content">
                                <p>SUBWAY: Qian Jiang century city Station  by Line 2 </p>
                                <p>TRAIN: 13 km from HANG ZHOU EAST train station, about 15 minutes’ driving</p>
                                <p>AIRPORT: 18 km from HANG ZHOU INTERNATIONAL AIRPORT, about 20 minutes’ driving
                                </p>
                            </div>
                        </div>
                        <div class="map" id="map"></div>
                    </div>
            <?php
                }else{
            ?>
                    <div class="item-content" style="margin-top: 13px;">
                        <div class="label-info clearfix">
                            <div class="label-title">
                                <span>参会地点</span>
                            </div>
                            <div class="label-content">
                                <p>杭州国际博览中心</p>
                            </div>
                        </div>
                        <div class="label-info clearfix">
                            <div class="label-title">
                                <span>参会地址</span>
                            </div>
                            <div class="label-content">
                                <p>杭州市萧山区钱江世纪城奔竞大道353号</p>
                            </div>
                        </div>
                        <div class="label-info clearfix">
                            <div class="label-title">
                                <span>交通信息</span>
                            </div>
                            <div class="label-content">
                                <p>地铁：地铁2号线（钱江世纪城站）</p>
                                <p>火车站：距离杭州东站13公里，约15分钟车程。</p>
                                <p>机场：距离杭州萧山国际机场18公里，20分钟车程。</p>
                            </div>
                        </div>
                        <div class="map" id="map"></div>
                    </div>
            <?php
                }
            ?>
        </div>
        <div class="meeting-info" id="hotel">
            <div class="item-title">
                <h2><i></i><hr><span><?php echo \Yii::t('app', '周边酒店');?></span></h2>
            </div>
            <div class="item-content">
                <ul class="arounds clearfix no-style">
                    <?php if(isset($perimeter_hotel)&&is_array($perimeter_hotel)&&count($perimeter_hotel)>0){ ?>
                        <?php
                        $i=1;
                        foreach($perimeter_hotel as $pek=>$pev){
                            if($i%3==0){
                                ?>
                                <li class="around margin">
                                    <a class="around-view">
                                        <img src="<?=$perimeter_hotel[$pek]['thumb']?>">
                                        <p><?=$perimeter_hotel[$pek]['title']?></p>
                                    </a>
                                    <div class="around-info">
                                        <?=$perimeter_hotel[$pek]['content']?>
                                    </div>
                                </li>
                                <?php
                            }else{ ?>
                                <li class="around">
                                    <a class="around-view">
                                        <img src="<?=$perimeter_hotel[$pek]['thumb']?>">
                                        <p><?=$perimeter_hotel[$pek]['title']?></p>
                                    </a>
                                    <div class="around-info">
                                        <?=$perimeter_hotel[$pek]['content']?>
                                    </div>
                                </li>

                            <?php   }$i++;}} ?>
                </ul>
            </div>
        </div>
        <div class="meeting-info" id="attractions">
            <div class="item-title">
                <h2><i></i><hr><span><?php echo \Yii::t('app', '周边景点');?></span></h2>
            </div>
            <div class="item-content">
                <ul class="arounds around-scenic clearfix no-style">
                    <?php if(isset($surrounding_attractions)&&is_array($surrounding_attractions)&&count($surrounding_attractions)>0){ ?>
                        <?php
                        $i=1;
                        foreach($surrounding_attractions as $sk=>$sv){
                            if($i%3==0){
                                ?>
                                <li class="around">
                                    <div class="around-view">
                                        <img src="<?=$surrounding_attractions[$sk]['thumb']?>">
                                    </div>
                                    <div class="around-info">
                                        <p><?=$surrounding_attractions[$sk]['title']?></p>
                                    </div>
                                </li>
                                <?php
                            }else{ ?>
                                <li class="around">
                                    <div class="around-view">
                                        <img src="<?=$surrounding_attractions[$sk]['thumb']?>">
                                    </div>
                                    <div class="around-info">
                                        <p><?=$surrounding_attractions[$sk]['title']?></p>
                                    </div>
                                </li>
                            <?php   }$i++;}} ?>
                </ul>
            </div>
        </div>
    </div>
</div>