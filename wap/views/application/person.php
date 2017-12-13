<?php
use yii\web\View;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = \Yii::t('app', '个人报名');
$language = $this->params['language'];
?>
<div class="body">
	<div class="apply-page" data-type="person" id="apply">
		<div class="apply-header">
			<h2 class="apply-title"><?php echo \Yii::t('app', '个人报名');?></h2>
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
					<a id="ret_chart" href="" download=""><img  class="ret-chart"></a>
					<p><?php echo \Yii::t('app', '恭喜您已经报名成功，请下载并保存二维码');?></p>
					<p><?php echo \Yii::t('app', '二维码已发至邮箱，请注意查收');?></p>
					<p><?php echo \Yii::t('app', '届时请携带二维码及个人有效证件至活动现场，由工作人员核对无误后方可进场参观。');?></p>
				</div>
			</div>
		</div>
	</div>
</div>