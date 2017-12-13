<?php
use yii\web\View;
$this->title = \Yii::t('app', '关于我们');
$language = $this->params['language'];
?>
<div class="body">
	<div class="about-page">
		<div class="about-banner">
			<?php if(isset($conference)&&is_array($conference)&&count($conference)>0){ ?>
                <img class="about-title"  src="<?=$conference[0]['thumb']?>">
         	<?php   } ?>
		</div>
		<div class="about-intro">
			<?php if(isset($conference)&&is_array($conference)&&count($conference)>0){ ?>
            <h1 class="title"><?=$conference[0]['title']?></h1>
            <div class="content">
                <?=$conference[0]['content']?>
            </div>
            <?php   } ?>
		</div>
		<div class="about-units flex flex-justify flex-wrap">
			<?php if(isset($led_by[0]['content'])&&empty($led_by[0]['content'])==false){ ?>
				<div class="item-unit unit-2">
					<div class="item-circle">
						<div class="circle-cover"></div>
						<i class="unit-icon"></i>
					</div>
					<div class="unit-info">
						<h3><?php echo \Yii::t('app', '指导单位');?></h3>
						<hr>
						<div class="unit-content">
							<?php if(isset($led_by)&&is_array($led_by)&&count($led_by)>0){ ?>
								<?=$led_by[0]['content']?>
							<?php   } ?>
						</div>
					</div>
				</div>
			<?php   } ?>
			<div class="item-unit">
				<div class="item-circle">
					<div class="circle-cover"></div>
					<i class="unit-icon"></i>
				</div>
				<div class="unit-info">
					<h3><?php echo \Yii::t('app', '主办单位');?></h3>
					<hr>
					<div class="unit-content">
					<?php if(isset($sponsor_company)&&is_array($sponsor_company)&&count($sponsor_company)>0){ ?>
                       <?=$sponsor_company[0]['content']?>
                    <?php   } ?>
					</div>
				</div>
			</div>
			<div class="item-unit unit-5">
				<div class="item-circle">
					<div class="circle-cover"></div>
					<i class="unit-icon"></i>
				</div>
				<div class="unit-info">
					<h3><?php echo \Yii::t('app', '承办单位');?></h3>
					<hr>
					<div class="unit-content">
					<?php if(isset($organizer)&&is_array($organizer)&&count($organizer)>0){ ?>
                        <?=$organizer[0]['content']?>
                    <?php   } ?>
                    </div>
				</div>
			</div>
			<div class="item-unit unit-4">
				<div class="item-circle">
					<div class="circle-cover"></div>
					<i class="unit-icon"></i>
				</div>
				<div class="unit-info">
					<h3><?php echo \Yii::t('app', '协办单位');?></h3>
					<hr>
					<div class="unit-content">
						<?php if(isset($co_organizer)&&is_array($co_organizer)&&count($co_organizer)>0){ ?>
							<?=$co_organizer[0]['content']?>
						<?php   } ?>
					</div>
				</div>
			</div>
			<div class="item-unit unit-3">
				<div class="item-circle">
					<div class="circle-cover"></div>
					<i class="unit-icon"></i>
				</div>
				<div class="unit-info">
					<h3><?php echo \Yii::t('app', '战略支持');?></h3>
					<hr>
					<div class="unit-content">
						<?php if(isset($co_sponsor)&&is_array($co_sponsor)&&count($co_sponsor)>0){ ?>
							<?=$co_sponsor[0]['content']?>
						<?php   } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="about-info banner" style="background-image:url('/images/about/about-banner2.jpg')">
			<?php if(isset($organization)&&is_array($organization)&&count($organization)>0){ ?>
                <?php
                    foreach($organization as $ok=>$ov){
                 ?>
                        <div class="info-item">
                            <img class="info-logo" src="<?=$organization[$ok]['thumb']?>">
                            <h2><?=$organization[$ok]['title']?></h2>
                            <h2><?=$organization[$ok]['description']?></h2>
                            <div class="info-detail">
                                <?=$organization[$ok]['content']?>
                            </div>
                        </div>
                <?php
                    }
                ?>
            <?php   } ?>
		</div>
		<div class="about-medias">
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '鸣谢榜单钻石级');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($acknowledgement_iamond)&&is_array($acknowledgement_iamond)&&count($acknowledgement_iamond)>0){ foreach($acknowledgement_iamond as $aik=>$aiv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$acknowledgement_iamond[$aik]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '鸣谢榜单黄金级');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($acknowledgement_gold)&&is_array($acknowledgement_gold)&&count($acknowledgement_gold)>0){ foreach($acknowledgement_gold as $agk=>$agv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$acknowledgement_gold[$agk]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '鸣谢榜单白银级');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($acknowledgement_silver)&&is_array($acknowledgement_silver)&&count($acknowledgement_silver)>0){ foreach($acknowledgement_silver as $ask=>$asv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$acknowledgement_silver[$ask]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '友情支持');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($cooperative_supporter)&&is_array($cooperative_supporter)&&count($cooperative_supporter)>0){ foreach($cooperative_supporter as $csk=>$csv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$cooperative_supporter[$csk]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '官方指定出行服务商');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($official_mobility)&&is_array($official_mobility)&&count($official_mobility)>0){ foreach($official_mobility as $omk=>$omv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$official_mobility[$omk]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '官方指定接待商务车');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($official_shuttle)&&is_array($official_shuttle)&&count($official_shuttle)>0){ foreach($official_shuttle as $osk=>$osv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$official_shuttle[$osk]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', 'VR独家支持');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($vr_exclusive)&&is_array($vr_exclusive)&&count($vr_exclusive)>0){ foreach($vr_exclusive as $vek=>$vev){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$vr_exclusive[$vek]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '多媒体互动定制');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($multi_media)&&is_array($multi_media)&&count($multi_media)>0){ foreach($multi_media as $mmk=>$mmv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$multi_media[$mmk]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '特别报道');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($special_report)&&is_array($special_report)&&count($special_report)>0){ foreach($special_report as $spk=>$spv){?>
                                <a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$special_report[$spk]['thumb']?>"></a>
                    <?php }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '官方合作');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($official_partners)&&is_array($official_partners)&&count($official_partners)>0){ foreach($official_partners as $ofk=>$ofv){?>
                            <a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$official_partners[$ofk]['thumb']?>"></a>
                    <?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '战略合作');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($strategic_partners)&&is_array($strategic_partners)&&count($strategic_partners)>0){ foreach($strategic_partners as $stk=>$stv){?>
                                <a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$strategic_partners[$stk]['thumb']?>"></a>
                    <?php   } }?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '独家视频');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($exclusive_video)&&is_array($exclusive_video)&&count($exclusive_video)>0){ foreach($exclusive_video as $exk=>$exv){?>
                                <a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$exclusive_video[$exk]['thumb']?>"></a>
                    <?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '特邀门户');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($invited_potal)&&is_array($invited_potal)&&count($invited_potal)>0){ foreach($invited_potal as $ink=>$inv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$invited_potal[$ink]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '重点支持');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($key_supporter)&&is_array($key_supporter)&&count($key_supporter)>0){ foreach($key_supporter as $kek=>$kev){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$key_supporter[$kek]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '特邀伙伴');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($invited_partners)&&is_array($invited_partners)&&count($invited_partners)>0){ foreach($invited_partners as $ik=>$iv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$invited_partners[$ik]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
			<div class="media-item">
				<div class="title-item-3">
					<hr class="title-line">
					<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '深度支持');?></span></h3>
				</div>
				<div class="media-content flex flex-center flex-wrap">
					<?php if(isset($key_partners)&&is_array($key_partners)&&count($key_partners)>0){ foreach($key_partners as $kk=>$kv){?>
						<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$key_partners[$ik]['thumb']?>"></a>
					<?php   }} ?>
				</div>
			</div>
		</div>
		<div class="media-item">
			<div class="title-item-3">
				<hr class="title-line">
				<h3 class="title-content"><span class="title-text"><?php echo \Yii::t('app', '新媒体矩阵');?></span></h3>
			</div>
			<div class="media-content flex flex-center flex-wrap">
				<?php if(isset($new_media)&&is_array($new_media)&&count($new_media)>0){ foreach($new_media as $nk=>$nv){?>
					<a href="javascript:void(0);" target="_blank"><img class="media" src="<?=$new_media[$nk]['thumb']?>"></a>
				<?php   }} ?>
			</div>
		</div>
		<div class="contact-us">
			<h2><?php echo \Yii::t('app', '联系方式');?></h2>
			<hr>
			<p><?php echo \Yii::t('app', '全球未来出行高层论坛暨国际展览会 秘书处会展部');?></p>
			<p><?php echo \Yii::t('app', '邮箱');?>: gfm@fmev100.com</p>
			<p><?php echo \Yii::t('app', '地址: 北京市海淀区清华科技园科技大厦 B 座 6 层 601 B');?></p>
		</div>
	</div>
</div>