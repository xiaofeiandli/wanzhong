<?php
use yii\web\View;
$this->title = \Yii::t('app', '媒体报名');
$language = $this->params['language'];
?>
    <div class="apply-page">
        <div class="container" data-type="media" id="apply">
            <div class="apply-header">
                <h2 class="apply-title" id="apply_title"><?php echo \Yii::t('app', '媒体报名');?></h2>
            </div>
            <div class="apply-body">
                <div class="apply-form" id="apply_form">
                    <form>
                        <div class="form-inline clearfix">
                            <div class="form-item" id="name">
                                <label><?php echo \Yii::t('app', '姓名');?><span class="require">*</span></label>
                                <div class="form-container">
                                    <input class="form-control" name="name" type="text">
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
                                    <input class="form-control"  name="position" type="text">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-item inline" id="address">
                            <label><?php echo \Yii::t('app', '地址');?><span class="require">*</span></label>
                            <div class="form-container clearfix">
                                <div class="pull-left" data-toggle="distpicker">
                                    <select class="province" name="province" data-province="<?php echo \Yii::t('app', '所在省/直辖市');?>"></select>
                                    <select class="city" name="city" data-city="<?php echo \Yii::t('app', '所在城市');?>"></select>
                                </div>
                                <div class="input-container">
                                    <input class="form-control address" type="text">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <input id="card" type="hidden" name="card">
                    </form>
                    <form id="card_form" role="form" enctype="multipart/form-data">
                        <div class="form-item">
                            <label><?php echo \Yii::t('app', '电子名片');?></label>
                            <div class="preview">
                                <label><?php echo \Yii::t('app', '选择图片');?><input id="card_select" type="file" name="card" accept="image/gif,image/jpeg,image/jpg,image/png"></label>
                                <div class="card-view" id="card_view"></div>
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
                    <div class="common media">
                        <img src="/images/success.png">
                        <p><?php echo \Yii::t('app', '信息已提交。');?><br><?php echo \Yii::t('app', '请等待组委会工作人员与您联系！请保持手机畅通！');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>