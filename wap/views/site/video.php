<?php
use yii\web\View;
$this->title = 'MV详情';
?>
<div id="video">
	<div class="video">
        <div class="video-container">
            <video class="video-player" id="video_player" style="max-width:100%;" preload="none"  controls controlslist="nodownload" playsinline webkit-playsinline>
                <source src="">
            </video>
        </div>
        <div class="article">
            <h1>MV视频标题</h1>
            <div class="line"></div>
        </div>
        <div class="video-list flex flex-wrap flex-justify">
            
            <div class="video-item">
                <a href="">
                <img class="video-thumb" src="/images/mv-thumb.png">
                <p class="video-title line-2">下面的视频列表</p>
                </a>
            </div>
            <div class="video-item">
                <a href="">
                <img class="video-thumb" src="/images/mv-thumb.png">
                <p class="video-title line-2">下面的视频列表</p>
                </a>
            </div>
            <div class="video-item">
                <a href="">
                <img class="video-thumb" src="/images/mv-thumb.png">
                <p class="video-title line-2">下面的视频列表</p>
                </a>
            </div>
        </div>
    </div>
</div>