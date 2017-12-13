<?php
use yii\web\View;
$this->title = '导航管理';
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-sitemap"></i>一级导航管理
                </div>
            </div>
            <div class="portlet-body">
                <?php if($res&&count($res)>0){ ?>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover navigators">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>导航名称</th>
                            <th>权重</th>
                            <th>包含二级导航个数</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($res as $ck =>$cv){ ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$cv['name']?></td>
                                <td><?=$cv['weight']?></td>
                                <td><?php if(isset($cv['class_two'])&&intval($cv['class_two'])>0){echo $cv['class_two'];}else{echo 0;}?></td>
                                <td style="white-space: nowrap;">
                                    <span class="edit btn btn-xs purple" data-id="<?=$cv['id']?>"><i class="fa fa-edit"></i>编辑</span>
                                    <span class="delete btn btn-xs red" data-id="<?=$cv['id']?>"><i class="fa fa-trash-o"></i>删除</span>
                                    
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ echo '当前列表数据为空'; } ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-sliders"></i>二级导航管理
                </div>
            </div>
            <div class="portlet-body">
                <?php if($res_two&&count($res_two)>0){ ?>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover navigators">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>二级导航名称</th>
                            <th>所属一级导航</th>
                            <th>权重</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($res_two as $ck =>$cv){ ?>
                            <tr>
                                <td><?=$i++?></td>
                                <td><?=$cv['name']?></td>
                                <td><?=$cv['class_one']?></td>
                                <td><?=$cv['weight']?></td>
                                <td style="white-space: nowrap;">
                                    <a class="edit btn btn-xs purple" data-id="<?=$cv['id']?>" data-toggle="modal" href="#modals"><i class="fa fa-edit"></i>编辑</a>
                                    <span class="delete btn btn-xs red" data-id="<?=$cv['id']?>"  href="javascript:"><i class="fa fa-trash-o"></i>删除</span>
                                    
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php }else{ echo '当前列表数据为空'; } ?>
            </div>
        </div>
    </div>
</div>
