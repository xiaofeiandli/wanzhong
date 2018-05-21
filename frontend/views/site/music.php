<?php
use yii\web\View;
$this->title = '音乐';
?>
	<div class="body bg-color" id="lists" v-cloak>
		<div class="container">
			<div class="music" id="music" :style="{'min-height': height+ 'px'}">
				<div class="list-header">
					<span class="list-text">音乐</span>
					<span class="list-sort" v-if="orderby == 'created_at'" @click="orderby = 'read'">按上传时间</span>
                	<span class="list-sort" v-if="orderby == 'read'" @click="orderby = 'created_at'">按播放热度</span>
				</div>
				<div class="music-list">
					<table>
						<tbody>
							<tr v-for='(item,idx) in lists' >
								<td class="music-order" v-text='(page-1)*limit+idx+1'></td>
								<td class="music-title one-hidden" v-text="item.name"></td>
								<td class="music-action">
									<i v-if="!item.play" class="iconfont icon-play" @click="playMusic(idx)"></i>
                            		<i v-else class="iconfont icon-stop" @click="stopMusic(idx)"></i>
								</td>
								<td class="music-counts"><span><i class="iconfont icon-eye"></i>{{item.count}}</span></td>
								<td class="music-time">{{item.created_at.split(' ')[0]}}</td>
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
        <div class="music-player" id="music_player"></div>
	</div>