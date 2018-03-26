<?php
use yii\web\View;
$this->title = '音乐';
?>
    <div class="music" id="mv" v-cloak>
        <div class="body"  :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <span class="list-title">音乐</span>
                <span class="list-sort">按上传时间</span>
            </div>
            <div class="music-list">
                <div class="music-item flex flex-justify flex-align" v-for="item in 8">
                    <div class="music-number">{{ item }}</div>
                    <div>
                        <a class="music-title line-1" href="">这是一个很长的标题这是一个很长的标题</a>
                        <div class="music-info">
                            <span><i class="fa fa-clock-o"></i>6:00</span>
                            <span><i class="fa fa-eye"></i>5678</span>
                        </div>
                    </div>
                    <div class="music-play">
                        <i class="fa fa-play-circle-o"></i>
                    </div>
                </div>
                <div class="loading-text">加载中...</div>
            </div>
		</div>
    </div>