<?php
use yii\web\View;
$this->title = 'MV';
?>
<div class="body bg-color" id="video">
	<div class="container">
		<div class="mv" id="lists"  :style="{'min-height': height+ 'px'}">
			<div class="list-header">
				<span class="list-text">MV</span>
				<span class="list-sort" v-if="orderby == 'created_at'" @click="orderby = 'read'">按上传时间</span>
                <span class="list-sort" v-if="orderby == 'read'" @click="orderby = 'created_at'">按查看次数</span>
			</div> 
			<div class="mv-list clearfix">
				<template v-if="lists.length >0">
					<div class="mv-item" v-for="item in lists"> 
						<div class="mv-thumb">
							<a href="" :title="item.title">
								<img src="/images/mv-thumb.png">
							</a>
						</div>
						<div class="mv-title">
							<a href="" :title="item.name" v-text="item.name.length> 15 ? item.name.slice(0,13)+'...' : item.name"></a>
						</div>
						<div class="mv-info clearfix">
							<span class="mv-watching"><i class="icon"></i> {{item.count}}</span>
							<span class="mv-time">{{item.created_at.split(' ')[0]}}</span>
						</div>
					</div>
				</template>
				<template v-else>
					<div class="empty-tip">暂无内容，请稍后访问。</div>
				</template>
			</div>
			<div class="empty-tip" v-show="loading">加载中...</div>
            <div class="empty-tip" v-show="msg" v-text="msg"></div>
            <div class="empty-tip" v-if="error" @click="getList">重新加载</div>
		</div>
	</div>
</div>