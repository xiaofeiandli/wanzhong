<?php
use yii\web\View;
$this->title = '诗';
?>
	<div class="body bg-color"  id="lists" v-cloak>
		<div class="container">
			<div class="poem clearfix" :style="{'min-height': height+ 'px'}">
				<div class="list-header">
					<span class="list-text" @click="toggle('lyric')" :class="{'active': type == 'poem'}">歌词</span>
					<span class="list-text" @click="toggle('poem')" :class="{'active': type == 'lyric'}">诗</span>
                	<span class="list-sort" v-if="orderby == 'created_at'" @click="orderby = 'read'">按上传时间</span>
                	<span class="list-sort" v-if="orderby == 'read'" @click="orderby = 'created_at'">按阅读次数</span>
				</div> 
				<div class="poem-list">
					<input id="type" type="hidden" value="lyric">

					<div class="poem-item" v-for="item in lists">
						<div class="poem-title one-hidden"><a :href="'/detail/'+type+'/'+item.id" target="_blank" v-text="item.title" :title="item.title"></a></div>
						<div class="poem-info">
							<span class="poem-watching"><i class="iconfont icon-eye"></i>{{ item.read }}</span>
							<span class="poem-time" v-text="item.created_at.split(' ')[0]"></span>
						</div>
					</div>
				</div>
				<div class="empty-tip" v-show="loading">加载中...</div>
            	<div class="empty-tip" v-show="msg" v-text="msg"></div>
            	<div class="empty-tip" v-if="error" @click="getList">重新加载</div>
            	<div class="page-list clearfix" v-if="total > 0">
					<el-pagination
				      @current-change="pageChange"
				      :current-page="page"
				      :page-size="limit"
				      layout="total, prev, pager, next, jumper"
				      :total="total">
		    		</el-pagination>
	    		</el-pagination>
				</div>
			</div>
		</div>
	</div>