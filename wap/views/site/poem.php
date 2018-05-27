<?php
use yii\web\View;
$this->title = '歌词';
?>
    <div>
        <div class="body" id="lists" v-cloak :style="{'min-height': height+'px'}">
            <input id="type" type="hidden" value="lyric">
            <div class="list-header flex flex-justify flex-align">
                <div>
                    <span class="list-title" @click="toggle('lyric')" :class="{active: type == 'poem'}">歌词</span>
                    <span class="list-title" @click="toggle('poem')" :class="{active: type == 'lyric'}">诗</span>
                </div>
                <span class="list-sort" v-if="orderby == 'created_at'" @click="orderby = 'read'">按上传时间</span>
                <span class="list-sort" v-if="orderby == 'read'" @click="orderby = 'created_at'">按阅读次数</span>
            </div>
            <div class="list article-list" v-for="item in lists">
                <div class="list-item">
                    <a class="list-title line-1" :href="'/detail/'+type+'/'+item.id">{{ item.title }}</a>
                    <div class="list-info">
                        <span><i class="iconfont icon-eye"></i>{{item.read}}</span>
                        <span><i class="iconfont icon-time"></i>{{item.created_at.split(' ')[0]}}</span>
                    </div>
                </div>
            </div>
            <div class="loading-text" v-show="loading">加载中...</div>
            <div class="loading-text" v-show="msg" v-text="msg"></div>
            <div class="loading-text" v-if="error" @click="getList">重新加载</div>
        </div>
    </div>