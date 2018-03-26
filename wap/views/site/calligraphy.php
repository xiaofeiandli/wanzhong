<?php
use yii\web\View;
$this->title = '书法';
?>
    <div class="writing" id="mv" v-cloak>
        <div class="body"  :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <span class="list-title">书法</span>
                <span class="list-sort">按上传时间</span>
            </div>
            <div class="image-list">
                <div class="image-item flex flex-justify flex-align" v-for="item in 8">
                    <div>
                        <img class="image" src="http://p1ahivkf2.bkt.clouddn.com/318234_1488122028KXX8_20180121115729.jpg?e=1520781261&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:_Yy7SCKdfWEbiEwSQ7kR92ojGJ8=">
                    </div>
                    <div class="image-title line-1">书法标题</div>
                </div>
                <div class="loading-text">加载中...</div>
            </div>
		</div>
    </div>