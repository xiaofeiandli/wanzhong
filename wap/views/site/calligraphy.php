<?php
use yii\web\View;
$this->title = '书法';
?>
    <div class="writing" id="writing">
        <div class="body" id="lists" v-cloak :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <span class="list-title">书法</span>
                <span class="list-sort" v-if="orderby == 'created_at'" @click="orderby = 'read'">按上传时间</span>
                <span class="list-sort" v-if="orderby == 'read'" @click="orderby = 'created_at'">按查看次数</span>
            </div>
            <div class="image-list">
                <div class="image-item flex flex-justify flex-align" v-for="item in lists">
                    <div>
                        <img class="image" :src="item.path">
                    </div>
                    <div class="image-title line-1">{{item.name}}</div>
                </div>
                <div class="loading-text" v-show="loading">加载中...</div>
                <div class="loading-text" v-show="msg" v-text="msg"></div>
                <div class="loading-text" v-if="error" @click="getList">重新加载</div>
            </div>
		</div>
    </div>