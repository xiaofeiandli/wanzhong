<?php
use yii\web\View;
$this->title = 'MV';
?>
    <div class="mv" id="mv">
        <div class="body" id="lists" v-cloak  :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <span class="list-title">MV</span>
                <span class="list-sort" v-if="orderby == 'created_at'" @click="orderby = 'read'">按上传时间</span>
                <span class="list-sort" v-if="orderby == 'read'" @click="orderby = 'created_at'">按查看次数</span>
            </div>
            <div class="mv-list">
                <div class="mv-item" v-for="item in lists">
                    <div class="mv-thumb">
                        <a href="javascript:;">
                            <img src="/images/mv-thumb.png">
                        </a>
                    </div>
                    <div class="mv-info">
                        <a class="mv-title" :href="'/mv/play#'+item.id"><span class="line-2">{{item.name}}</span></a>
                        <div class="mv-watch">
                            <i class="iconfont icon-eye"></i>{{item.count}}
                        </div>
                    </div>
                </div>
                <div class="loading-text" v-show="loading">加载中...</div>
                <div class="loading-text" v-show="msg" v-text="msg"></div>
                <div class="loading-text" v-if="error" @click="getList">重新加载</div>
            </div>
		</div>
    </div>