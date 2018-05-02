<?php
use yii\web\View;
$this->title = '音乐';
?>
	<div class="body bg-color" id="music">
		<div class="container">
			<div class="music" :style="{'min-height': height+ 'px'}">
				<div class="list-header">
					<span class="list-text">音乐</span>

					<span class="list-sort" v-if="orderby == 'created_at'"  @click="sort('read')">按播放量</span>
					<span class="list-sort" v-else @click="sort('created_at')">按上传时间</span>
				</div>
				<div class="music-list" id="music_list">
					<table>
						<tbody>
							<tr v-for='(item,idx) in lists' >
								<td class="music-order" v-text='idx+1'></td>
								<td class="music-title one-hidden" v-text="item.name"></td>
								<td class="music-action"><i class="icon" :class="!item.play ? 'el-icon-fa-play-circle-o' : 'el-icon-fa-pause-circle-o' " @click='play(idx,item.id)'></i></td>
								<td class="music-counts"><span><i class="icon el-icon-fa-eye"></i>{{item.count}}</span></td>
								<td class="music-time">4:03</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="page-list clearfix">
					<el-pagination
				      @current-change="pageChange"
				      :current-page="page"
				      :page-size="limit"
				      layout="total, prev, pager, next, jumper"
				      :total="total">
		    		</el-pagination>
				</div>
			</div>
		</div>
	</div>
	<div>
		<div class="mp" id="music_player">
		    <div class="mp-box">
		        <img src="img/mplayer_error.png" alt="music cover" class="mp-cover">
		        <div class="mp-info">
		            <p class="mp-name">歌名</p>
		            <p class="mp-singer">歌手</p>
		            <p><span class="mp-time-current">00:00</span>/<span class="mp-time-all">00:00</span></p>
		        </div>
		        <div class="mp-btn">
		            <button class="mp-prev" title="上一首"></button>
		            <button class="mp-pause" title="播放"></button>
		            <button class="mp-next" title="下一首"></button>
		            <button class="mp-mode" title="播放模式"></button>
		            <div class="mp-vol">
		                <button class="mp-vol-img" title="静音"></button>
		                <div class="mp-vol-range" data-range_min="0" data-range_max="100" data-cur_min="80">
		                    <div class="mp-vol-current"></div>
		                    <div class="mp-vol-circle"></div>
		                </div>
		            </div>
		        </div>
		        <div class="mp-pro">
		            <div class="mp-pro-current"></div>
		        </div>
		        <div class="mp-menu">
		            <button class="mp-list-toggle"></button>
		            <button class="mp-lrc-toggle"></button>
		        </div>
		    </div>
		    <button class="mp-toggle">
		        <span class="mp-toggle-img"></span>
		    </button>
		    <div class="mp-lrc-box">
		        <ul class="mp-lrc"></ul>
		    </div>
		    <button class="mp-lrc-close"></button>
		    <div class="mp-list-box">
		        <ul class="mp-list-title"></ul>
		        <table class="mp-list-table">
		            <thead>
		                <!--<tr>
		                    <th>歌名</th>
		                    <th>歌手</th>
		                    <th>时长</th>
		                </tr>-->
		            </thead>
		            <tbody class="mp-list"></tbody>
		        </table>
		    </div>
		</div>
	</div>
	<!--<div class="music-players" id="music_player_container">
		<div class="music-hand"></div>
		<div class="music-container" style="background-color: #fff;">
			<audio id="music_player">
				<source src="http://p1ahivkf2.bkt.clouddn.com/在荒芜中丰收地活着_20171228101014.mp3?e=1516528400&token=qIF_R3stoMld2CniwCUrAU6Zb0sgflkAAU-0d1tv:w22HRXu_VJ2OWCF0l8eiSl_N5-Y=" type="audio/mp3">
			</audio>
		</div>
	</div>-->