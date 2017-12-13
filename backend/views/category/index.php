<?php
use yii\web\View;
$this->title = '栏目管理';
$this->registerCssFile("@web/js/plugins/icheck/skins/all.css");
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa  fa-bars"></i>栏目管理
                </div>
            </div>
            <div class="portlet-body">
                <?php if($res&&count($res)>0){ ?>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover" id="categories">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>栏目名称</th>
                            <th>栏目标记</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($res as $ck =>$cv){ ?>
                            <tr class="has_cate" id="cate<?=$cv['id']?>">
                                <td><?=$i++?></td>
                                <td><?=$cv['name']?></td>
                                <td><?=$cv['flag']?></td>
                                <td>
                                    <?php
                                    if($cv['status']==0){
                                        ?>
                                        <span class="btn btn-xs yellow tooltips publish" data-status="1" data-original-title="点击发布" data-id="<?=$cv['id']?>">未发布</span>
                                        <?php
                                    }else{
                                        ?>
                                        <span class="btn btn-xs green tooltips publish" data-status="0" data-original-title="点击取消发布"  data-id="<?=$cv['id']?>">已发布</span>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td style="white-space: nowrap;">
                                    <span class="edit btn btn-xs purple" data-id="<?=$cv['id']?>"><i class="fa fa-edit"></i> 编辑</span>
                                    <span class="delete btn btn-xs red" data-id="<?=$cv['id']?>"><i class="fa fa-trash-o"></i> 删除</span>
                                </td>
                            </tr><?php }?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ echo '当前列表数据为空'; } ?>
            </div>
        </div>
    </div>
</div>
