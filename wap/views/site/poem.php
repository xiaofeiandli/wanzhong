<?php
use yii\web\View;
$this->title = '歌词';
?>
    <div class="writing" id="mv" v-cloak>
        <div class="body" :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <div>
                    <span class="list-title">歌词</span>
                    <span class="list-title active">诗</span>
                </div>
                <span class="list-sort">按上传时间</span>
            </div>
            <div class="list article-list" v-for="item in 8">
                <div class="list-item">
                    <a class="list-title line-1" href="">这是一个很长的标题这是一个很长的标题</a>
                    <div class="list-info">
                        <span><i class="fa fa-eye"></i>5678</span>
                        <span>2018-01-01</span>
                    </div>
                </div>
            </div>
            <div class="loading-text">加载中...</div>
        </div>
    </div>