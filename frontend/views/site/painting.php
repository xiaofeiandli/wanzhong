<?php
use yii\web\View;
$this->title = '画';
?> 
	<div class="body bg-color" id="img" v-cloak>
		<div class="container">
			<div class="planting clearfix">

				<div v-for="item in lists" class="planting-item">
					<a class="fancybox" rel='group' :href="item.path" :title="item.name">
					<img :src="item.path" >
					</a>
					<div class="planting-title">
						<span v-text="item.name"></span>
					</div>
				</div>
			</div>
		</div>
	</div>