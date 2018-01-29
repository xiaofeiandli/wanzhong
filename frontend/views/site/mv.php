<?php
use yii\web\View;
$this->title = 'MV';
?>
	<div class="body bg-color" id="video">
		<div class="container">
			<div class="mv"  :style="{height: height+ 'px'}">
				<div class="list-header">
					<span class="list-text">MV</span>
					<span class="list-sort">按上传时间</span>
				</div> 
				<div class="mv-list clearfix">
					<template v-if="lists.length >0">
						<div class="mv-item" v-for="item in lists"> 
							<div class="mv-thumb">
								<a :href="item.path" :title="item.title">
									<img src="item.thumb">
								</a>
							</div>
							<div class="mv-title">
								<a href="item.path" :title="item.title" v-text="item.title"></a>
							</div>
							<div class="mv-info clearfix">
								<span class="mv-watching"><i class="icon"></i> {{item.count}}</span>
								<span class="mv-time" v-text="item.time"></span>
							</div>
						</div>
					</template>
					<template v-else>
						<div class="empty-tip">暂无内容，请稍后访问。</div>
					</template>
				</div>
			</div>
		</div>
	</div>