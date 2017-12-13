<?php
use yii\web\View;
$this->title = \Yii::t('app', '媒体报名');
$language = $this->params['language'];
?>
<div class="body">
	<div class="apply-page" data-type="media" id="apply">
		<div class="apply-header">
			<h2 class="apply-title" id="apply_title"><?php echo \Yii::t('app', '媒体报名');?></h2>
			<div class="title-bar"></div>
		</div>
		<div class="apply-body">
			<div class="apply-form" id="apply_form">
				<form>
					<div class="form-item" id="name">
						<label><?php echo \Yii::t('app', '姓名');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="text" maxlength="40" name="name">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="cellphone">
						<label><?php echo \Yii::t('app', '手机');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="phone" name="phone" maxlength="14">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="id">
						<label><?php echo \Yii::t('app', '证件号码');?><span class="require">*</span></label>
						<div class="form-container">
							<select class="form-control" name="certificate_type">
								<option vlaue="0"><?php echo \Yii::t('app', '身份证');?></option>
							</select>
							<input class="form-control" type="text" name="certificate_number" maxlength="18">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="email">
						<label><?php echo \Yii::t('app', '邮箱地址');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="email" name="email">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="company">
						<label><?php echo \Yii::t('app', '公司');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="text" maxlength="40" name="company">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="position">
						<label><?php echo \Yii::t('app', '职位');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="text" maxlength="40" name="position">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="address">
						<label><?php echo \Yii::t('app', '地址');?><span class="require">*</span></label>
						<div class="form-container" data-toggle="distpicker">
							<select data-province="<?php echo \Yii::t('app', '所在省/直辖市');?>" class="form-control province" name="province"></select>
							<select data-city="<?php echo \Yii::t('app', '所在城市');?>" class="form-control city" name="city"></select>
							<div class="input-container">
								<input class="form-control address" type="text" maxlength="40">
								<span></span>
							</div>
						</div>
						<div class="help-block"></div>
					</div>
					<input id="card" type="hidden" name="card">
				</form>
				<form id="card_form" role="form" enctype="multipart/form-data">
					<div class="form-item">
						<label><?php echo \Yii::t('app', '电子名片');?></label>
						<div class="form-container">
							<div class="preview">
								<label><?php echo \Yii::t('app', '选择图片');?><input id="card_select" type="file" name="card" accept="image/gif,image/jpeg,image/jpg,image/png"></label>
								<div class="card-view" id="card_view"></div>
							</div>
						</div>
					</div>
				</form>
				<div class="apply-action">
					<button class="btn submit" type="button"><?php echo \Yii::t('app', '提交');?></button>
				</div>
			</div>
			<div class="apply-info" id="apply_info">
				<div class="apply-info-detail"></div>
				<div class="apply-action">
					<button class="btn back" type="button"><?php echo \Yii::t('app', '返回修改');?></button>
					<button class="btn submit" type="button"><?php echo \Yii::t('app', '确认提交');?></button>
				</div>
			</div>
			<div class="apply-result" id="apply_result">
				<div class="common">
					<img class="success" src="/images/success.png">
					<p><?php echo \Yii::t('app', '信息已提交。');?><br><?php echo \Yii::t('app', '请等待组委会工作人员与您联系！请保持手机畅通！');?></p>
				</div>
			</div>
		</div>
	</div>
</div>