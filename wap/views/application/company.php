<?php
use yii\web\View;
$this->title = \Yii::t('app', '展商报名');
$language = $this->params['language'];
?>
<div class="body">
	<div class="apply-page" data-type="company" id="apply">
		<div class="apply-header">
			<h2 class="apply-title" id="apply_title"><?php echo \Yii::t('app', '展商报名');?></h2>
			<div class="title-bar"></div>
		</div>
		<div class="apply-body">
			<div class="apply-form" id="apply_form">
				<form>
					<div class="form-item" id="company">
						<label><?php echo \Yii::t('app', '公司名称（请填写完整的公司名称）');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="text" maxlength="40" name="company">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="name">
						<label><?php echo \Yii::t('app', '联系人');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="text" maxlength="30" name="name">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="position">
						<label><?php echo \Yii::t('app', '职位');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="text" maxlength="30">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="telephone">
						<label><?php echo \Yii::t('app', '联系电话');?><span class="require">*</span></label>
						<div class="form-container">
							<input class="form-control" type="text" name="telephone">
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
					<div class="form-item" id="address">
						<label><?php echo \Yii::t('app', '公司地址');?><span class="require">*</span></label>
						<div class="form-container " data-toggle="distpicker">
							<select data-province="<?php echo \Yii::t('app', '选择省份/直辖市');?>" class="form-control province" name="province"></select>
							<select data-city="<?php echo \Yii::t('app', '选择城市');?>" class="form-control city" name="city"></select>
							<div class="input-container">
								<input class="form-control" type="text" maxlength="40" name="address">
								<span></span>
							</div>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="website">
						<label><?php echo \Yii::t('app', '公司网站（可选）');?></label>
						<div class="form-container">
							<input class="form-control" type="text" maxlength="40" name="website">
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="purpose">
						<label><?php echo \Yii::t('app', '参展目的（不少于300字）');?></label>
						<div class="form-container">
							<textarea class="form-control text" name="purpose"></textarea>
							<span></span>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="area">
						<label><?php echo \Yii::t('app', '参展面积');?><span class="require">*</span></label>
						<div class="form-container">
							<select class="form-control area" name="area">
								<option value><?php echo \Yii::t('app', '选择面积');?></option>
								<option value="100㎡">100㎡</option>
								<option value="200㎡">200㎡</option>
								<option value="400㎡">400㎡</option>
								<option value="600㎡">600㎡</option>
								<option value="<?php echo \Yii::t('app', '其他');?>"><?php echo \Yii::t('app', '其他');?></option>
							</select>
						</div>
						<div class="help-block"></div>
					</div>
					<div class="form-item" id="classes">
						<label><?php echo \Yii::t('app', '参展类别');?><span class="require">*</span></label>
						<div class="form-container">
							<select class="form-control classes" name="classes">
								<option value><?php echo \Yii::t('app', '选择类别');?></option>
								<option value="<?php echo \Yii::t('app', '整车');?>"><?php echo \Yii::t('app', '整车');?></option>
								<option value="<?php echo \Yii::t('app', '零部件');?>"><?php echo \Yii::t('app', '零部件');?></option>
								<option value="<?php echo \Yii::t('app', '充电设施');?>"><?php echo \Yii::t('app', '充电设施');?></option>
								<option value="<?php echo \Yii::t('app', '智能');?>"><?php echo \Yii::t('app', '智能');?></option>
								<option value="<?php echo \Yii::t('app', '车联网');?>"><?php echo \Yii::t('app', '车联网');?></option>
								<option value="<?php echo \Yii::t('app', '其他');?>"><?php echo \Yii::t('app', '其他');?></option>
							</select>
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
					<img class="success" src="/images/success.png">
					<p><?php echo \Yii::t('app', '信息已提交。');?><br><?php echo \Yii::t('app', '请等待组委会工作人员与您联系！请保持手机畅通！');?></p>
				</div>
			</div>
		</div>
	</div>
</div>