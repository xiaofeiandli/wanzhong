<?php
use yii\web\View;
$this->title = '播放';
?>
	<div class="body bg-color" id="video_page">
		<div class="container">
			<div class="play">
				<div class="list-header">
					<span class="list-text"><strong><?=$data['name']?></strong></span>
				</div> 
				<div class="play-content">
					<div class="player">
						<video id="player" class="video" controls>
							<source src="<?=$data['path']?>">
						</video>
					</div>
					<div class="play-list">
						<?php foreach($list as $k=>$v){?>
						<div class="play-item">
							<div class="play-thumb">
								<a href="/detail/<?=$v['type']?>/<?=$v['id']?>" title="<?=$v['name']?>"><img src="/images/mv-thumb.png" alt="<?=$v['name']?>"></a>
							</div>
							<div class="play-info">
								<div class="play-title"><a href="/detail/<?=$v['type']?>/<?=$v['id']?>"><?=$v['name']?></a></div>
								<div class="play-counts"><span class="my-icon"><i class="iconfont icon-eye"></i><?=$v['count']?></span></div>
							</div>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>