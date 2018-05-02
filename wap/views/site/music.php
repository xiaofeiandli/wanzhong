<?php
use yii\web\View;
$this->title = '音乐';
?>
    <div class="music" id="music">
        <div class="body" id="lists" v-cloak :style="{'min-height': height+'px'}">
            <div class="list-header flex flex-justify flex-align">
                <span class="list-title">音乐</span>
                <span class="list-sort" v-if="orderby == 'created_at'" @click="orderby = 'read'">按上传时间</span>
                <span class="list-sort" v-if="orderby == 'read'" @click="orderby = 'created_at'">按播放热度</span>
            </div>
            <div class="music-list">
                <div class="music-item flex flex-justify flex-align" v-for="(item,idx) in lists">
                    <div class="music-number">{{ idx+1 }}</div>
                    <div>
                        <a class="music-title line-1" href="">{{item.name}}</a>
                        <div class="music-info">
                            <span><i class="iconfont icon-time"></i>6:00</span>
                            <span><i class="iconfont icon-eye"></i>{{item.count}}</span>
                        </div>
                    </div>
                    <div class="music-play">
                        <template>
                            <i v-if="!item.play" class="iconfont icon-play" @click="playMusic(idx)"></i>
                            <i v-else class="iconfont icon-stop" @click="stopMusic(idx)"></i>
                        </template>
                    </div>
                </div>
                <div class="loading-text" v-show="loading">加载中...</div>
                <div class="loading-text" v-show="msg" v-text="msg"></div>
                <div class="loading-text" v-if="error" @click="getList">重新加载</div>
            </div>
		</div>
        <div class="music-player" id="music_player"></div>
    </div>