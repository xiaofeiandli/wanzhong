<?php
use yii\web\View;
$this->title = '后台总览';
?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual">
				<i class="fa fa-file-video-o"></i>
			</div>
			<div class="details">
				<div class="number">
					 <?=$count['video']?>
				</div>
				<div class="desc">
					 视频
				</div>
			</div>
			<a class="more" href="/resource/index/video">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-hoki">
			<div class="visual">
				<i class="fa fa-file-audio-o"></i>
			</div>
			<div class="details">
				<div class="number">
					 <?=$count['audio']?>
				</div>
				<div class="desc">
					 音频
				</div>
			</div>
			<a class="more" href="/resource/index/audio">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat purple-plum">
			<div class="visual">
				<i class="fa fa-file-picture-o"></i>
			</div>
			<div class="details">
				<div class="number">
					 <?=$count['pic']?>
				</div>
				<div class="desc">
					 图像
				</div>
			</div>
			<a class="more" href="/resource/index/image">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat green-haze">
			<div class="visual">
				<i class="fa fa-wordpress"></i>
			</div>
			<div class="details">
				<div class="number">
					 <?=$count['poem']?>
				</div>
				<div class="desc">
					 诗
				</div>
			</div>
			<a class="more" href="/article/index/2/1">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat yellow">
			<div class="visual">
				<i class="fa fa-file-word-o"></i>
			</div>
			<div class="details">
				<div class="number">
					 <?=$count['lyric']?>
				</div>
				<div class="desc">
					 歌词
				</div>
			</div>
			<a class="more" href="/article/index/1/1">
			View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
</div>