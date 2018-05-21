<?php
use yii\web\View;
$this->title = '画';
?> 
	<div class="body bg-color" id="lists" v-cloak>
		<div class="container planting">
			<div class="clearfix" id="img" :style="{'min-height': height+ 'px'}">
				<template v-if="lists.length > 0">
					<div v-for="item in lists" class="planting-item">
						<a class="fancybox" rel='group' :href="item.path" :title="item.name">
						<img :src="item.path" >
						</a>
						<div class="planting-title">
							<span v-text="item.name"></span>
						</div>
					</div>
				</template>
				<template v-else>
					<div class="empty-tip">暂无内容，请稍后访问。</div>
				</template>
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