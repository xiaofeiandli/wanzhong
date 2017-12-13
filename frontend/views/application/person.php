<?php
use yii\web\View;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = \Yii::t('app', '个人报名');
$language = $this->params['language'];
?>
    <div class="apply-page">
        <div class="container" data-type="person" id="apply">
            <div class="apply-header">
                <h2 class="apply-title" id="apply_title"><?php echo \Yii::t('app', '个人报名');?></h2>
            </div>
            <div class="apply-body">
                <div class="apply-form" id="apply_form">
                    <form>
                        <div class="form-inline clearfix">
                            <div class="form-item" id="name">
                                <label><?php echo \Yii::t('app', '姓名');?><span class="require">*</span></label>
                                <div class="form-container">
                                    <input class="form-control" type="text" name="name">
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-item" id="cellphone">
                                <label><?php echo \Yii::t('app', '手机');?><span class="require">*</span></label>
                                <div class="form-container">
                                    <input class="form-control" name="cellphone" type="text">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-inline clearfix">
                            <div class="form-item inline" id="id">
                                <label><?php echo \Yii::t('app', '证件号码');?><span class="require">*</span></label>
                                <div class="form-container clearfix">
                                    <select name="certificate_type">
                                        <option value="0"><?php echo \Yii::t('app', '身份证');?></option>
                                    </select>
                                    <div class="input-container">
                                        <input class="form-control" name="certificate_number" type="text">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item" id="email">
                                <label><?php echo \Yii::t('app', '邮箱地址');?><?php echo \Yii::t('app', '（将用于发送电子二维码门票）');?><span class="require">*</span></label>
                                <div class="form-container">
                                    <input class="form-control" name="email" type="text">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-inline clearfix">
                            <div class="form-item" id="company">
                                <label><?php echo \Yii::t('app', '公司');?><span class="require">*</span></label>
                                <div class="form-container">
                                    <input class="form-control" name="company" type="text">
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-item" id="position">
                                <label><?php echo \Yii::t('app', '职位');?><span class="require">*</span></label>
                                <div class="form-container">
                                    <input class="form-control" name="position" type="text">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="help-block">
                        <p id="help_block"></p>
                    </div>
                    <div class="apply-action">
                        <span class="btn submit" role="button"><?php echo \Yii::t('app', '提交信息');?></span>
                    </div>
                </div>
                <div class="apply-info" id="apply_info">
                    <table></table>
                    <div class="apply-action">
                        <span class="btn back"><?php echo \Yii::t('app', '返回修改');?></span>
                        <span class="btn submit"><?php echo \Yii::t('app', '确认提交');?></span>
                    </div>
                </div>
                <div class="apply-result" id="apply_result">
                    <div class="common person">
                        <a id="code" href="" download="chart-code"></a>
                        <p><?php echo \Yii::t('app', '恭喜您已经报名成功，请下载并保存二维码');?><br><?php echo \Yii::t('app', '二维码已发至邮箱，请注意查收');?><br><?php echo \Yii::t('app', '届时请携带二维码及个人有效证件至活动现场，由工作人员核对无误后方可进场参观');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
</script>