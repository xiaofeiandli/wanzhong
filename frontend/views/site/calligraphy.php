<?php
use yii\web\View;
$this->title = '书法';
?>
	<div class="body bg-color" id="lists">
		<div class="container">
			<div class="planting" id="writing" :style="{'min-height': height+ 'px'}">
			<div class="clearfix">
				<div v-for="item in lists" class="planting-item">
					<a class="fancybox" rel='group' :href="item.path" :title="item.name">
					<img :src="item.path" >
					</a>
					<div class="planting-title">
						<span v-text="item.name"></span>
					</div>
				</div>
			</div>
				<div class="page-list clearfix" v-if="total > 0">
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