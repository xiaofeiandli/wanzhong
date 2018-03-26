<?php
use yii\web\View;
$this->title = 'MV';
?>
    <div class="mv" id="mv" v-cloak>
        <div class="body"  :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <span class="list-title">MV</span>
                <span class="list-sort">按上传时间</span>
            </div>
            <div class="mv-list">
                <div class="mv-item" v-for="item in 8">
                    <div class="mv-thumb">
                        <a href="javascript:;">
                            <img src="/images/mv-thumb.png">
                        </a>
                    </div>
                    <div class="mv-info">
                        <a class="mv-title" href=""><span class="line-2">这是一个很长的标题这是一个很长的标题</span></a>
                        <div class="mv-watch">
                            <i class="fa fa-eye"></i>5678
                        </div>
                    </div>
                </div>
                <div class="loading-text">加载中...</div>
            </div>
		</div>
    </div>