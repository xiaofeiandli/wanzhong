<?php
use yii\web\View;
$this->title = '画作';
?>
    <div class="painting" id="mv" v-cloak>
        <div class="body"  :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <span class="list-title">画作</span>
                <span class="list-sort">按上传时间</span>
            </div>
            <div class="image-list">
                <div class="image-item flex flex-justify flex-align" v-for="item in 8">
                    <div>
                        <img class="image" src="http://p1ahivkf2.bkt.clouddn.com/a4_20171228100315.jpg?e=1520779751&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:PlWUou8rTTWp3p367Y22Oa3_ux4=">
                    </div>
                    <div class="image-title line-1">画作标题</div>
                </div>
                <div class="loading-text">加载中...</div>
            </div>
		</div>
    </div>