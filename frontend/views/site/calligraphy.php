<?php
use yii\web\View;
$this->title = '书法';
?>
	<div class="body bg-color" id="writing">
		<div class="container">
			<div class="planting clearfix" :style="{height: height+ 'px'}">
				<template v-if='lists.length>0'>
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
		</div>
	</div>