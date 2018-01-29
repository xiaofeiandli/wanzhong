<?php
use yii\web\View;
$this->title = '诗';
?>
	<div class="body bg-color" id="poem" v-cloak>
		<div class="container">
			<div class="poem clearfix"   :style="{height: height+ 'px'}">
				<div class="list-header">
					<span class="list-text">歌词</span>
					<span class="list-text list-text-color">诗</span>
					<span class="list-sort">按上传时间</span>
				</div> 
				<div class="poem-list">
					<template v-if="lists.length>0">
						<div class="poem-item" v-for="item in lists">
							<div class="poem-title one-hidden"><a href="" v-text="item.title" :title="item.title"></a></div>
							<div class="poem-info">
								<span class="poem-watching"><i class="icon"></i>{{ item.count }}</span>
								<span class="poem-time" v-text="item.time"></span>
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