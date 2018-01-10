<?php
use yii\web\View;
$this->title = '登录管理';
?>
<div class="portlet box blue-hoki" style="width: 100%; margin: 0 auto;">
    <div class="portlet-title">
        <div class="caption"><i class="glyphicon glyphicon-cog"></i> 修改密码
        </div>
    </div>
    <div class="portlet-body form">
        <form id="reset" role="form" method="post">
            <div class="form-body">
                <div class="form-group" id="old_pwd">
                    <label class="control-label">原密码</label>
                    <input type="password" name="opwd" class="form-control"  maxlength="16">
                    <div class="help-block"></div>
                </div>
                <div class="form-group" id="new_pwd">
                    <label class="control-label">新密码</label>
                    <input type="password" name="npwd" class="form-control">
                    <div class="help-block"></div>
                </div>
                <div class="form-group" id="re_pwd">
                    <label class="control-label">确认密码</label>
                    <input type="password" name="rpwd" class="form-control">
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="form-actions right">
                <button type="button" id="reset_pwd" class="btn green" ><i class="fa fa-check"></i> 提交</button>
            </div>
        </form>
    </div>
</div>