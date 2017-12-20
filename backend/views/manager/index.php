<?php
use yii\web\View;
$this->title = '用户管理';
?>
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="glyphicon glyphicon-cog"></i> 添加后台用户
        </div>
    </div>
    <div class="portlet-body form">
        <form action="" id="form" class="form-horizontal form-bordered">
            <div class="form-group" id="username" >
                <label class="col-sm-3 control-label">用户名称</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="请输入用户名称"/>
                    </div>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">角色权限</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <div class="icheck-inline">
                            <div class="md-radio-inline">
                                <div class="md-radio">
                                    <input class="icheck" type="radio" value=0 id="normal" name="auth" class="md-radiobtn" checked>
                                    <label for="normal"><span></span><span class="check"></span><span class="box"></span>普通用户</label>
                                </div>
                                <div class="md-radio">
                                    <input class="icheck" type="radio" value=1 id="super" name="auth" class="md-radiobtn">
                                    <label for="super"><span></span><span class="check"></span><span class="box"></span>超级用户</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="help-block">说明：超级用户可增删普通用户账号。</p>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="reset" class="btn default"><i class="fa fa-remove"></i> 取消</button>
                        <button type="button" class="btn green" id="submit"><i class="fa fa-check"></i> 提交</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>后台用户列表
                </div>
            </div>
            <div class="portlet-body">
                <?php if(isset($list[0]['id'])){?>
                <div class="table-scrollable">
                    <table class="table table-hover" id="managers">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>用户账号</th>
                            <th>用户角色</th>
                            <?php if($isOpen!=0){?>
                            <th>操作</th>
                            <?php }?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($list as $k=>$v){?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$v['manager_name']?></td>
                                <td><?php if($v['role']==1){echo '超级用户';}else{echo '普通用户';}?></td>
                                <?php if($isOpen!=0){?>
                                <td>
                                    <?php if($v['role']==0){?>
                                        <span data-id="<?=$v['id']?>" class="btn btn-xs red delete"><i class="fa fa-trash-o"></i> 删除</span>
                                    <?php }?>
                                </td>
                                <?php }?>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
                <?php }else{?>
                    网络异常，请刷新重试。
                <?php }?>
            </div>
        </div>
    </div>
</div>