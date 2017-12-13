<?php
use yii\web\View;
$this->title = '文章管理';
$this->registerCssFile("@web/js/plugins/bootstrap-summernote/summernote.css");
$this->registerCssFile("@web/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css");
$this->registerCssFile("@web/js/plugins/icheck/skins/all.css");
$this->registerCssFile("@web/js/plugins/ladda/ladda-themeless.min.css");
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue-hoki">
            <div class="portlet-title" style="padding-right:0;">
                <div class="caption">
                    <i class="icon-layers"></i>文章管理
                </div>
                <span class="btn blue pull-right" style="padding: 10px 14px;"  data-isnews="1" id="new_article"><i class="fa fa-plus"></i> 添加文章</span>
            </div>
            <div class="portlet-body">
                <form class="form-inline">
                    <div class="form-body">
                        <div class="form-group">
                            <label>标题:</label>
                            <input class="form-control input-sm" placeholder="支持部分查询" name="title" type="text" value="">
                            <input type="hidden" name="issearch" value="yes">
                        </div>
                        <div class="form-group">
                            <label>分类:</label>
                            <select class="bs-select form-control input-sm" name="category">
                                <option value="" >全部</option>
                                <?php if(is_array($category_array)&&count($category_array)>0){ foreach($category_array as $ck=>$cv){ ?>
                                     <option value="<?=$cv['id']?>"><?= $cv['name'] ?></option>
                                <?php }}?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn blue btn-sm"><i class="fa fa-search"></i> 搜索</button>
                        </div>
                    </div>
                </form>
                <?php if(isset($article_res)&&count($article_res)>0){ ?>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover" id="article" style="white-space: nowrap;">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> 标题 </th>
                            <th> 所属分类 </th>
                            <th> 状态 </th>
                            <th> 创建时间 </th>
                            <th> 操作 </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=($page-1)*10+1;
                        foreach($article_res as $ak=>$av){
                            ?>
                            <tr>
                                <td> <?=$i++?> </td>
                                <td><a class="detail" data-id="<?=$av['id']?>" href="javascript:void(0)"><?php if(mb_strlen($av['title'],'utf-8')>13){echo mb_substr($av['title'],0,13,'utf-8').'...';}else{echo  $av['title'];}?></a></td>
                                </td>
                                <td><?php if(isset($av['category_name'])&&mb_strlen($av['category_name'],'utf-8')>13){echo mb_substr($av['category_name'],0,13,'utf-8').'...';}else{echo $av['category_name'];}?></td>
                                <td>
                                    <?php if($av['status']==0){?>
                                        <span class="stopping">未发布</span>
                                    <?php }else{ ?>
                                        <span class="working">已发布</span>
                                    <?php } ?>
                                </td>
                                <td> <?=$av['created_at'] ?> </td>
                                <td>
                                <span class="btn btn-xs blue edit" data-id="<?=$av['id']?>"><i class="fa fa-edit"></i>编辑</span>
                                <?php
                                if($av['status']==1){
                                    ?>
                                    <span class="btn btn-xs grey status" data-id="<?=$av['id']?>" data-status=0><i class="fa fa-remove"></i>停用</span>
                                    <?php
                                }else{
                                    ?>
                                    <span class="btn btn-xs purple status" data-id="<?=$av['id']?>" data-status=1><i class="fa fa-check"></i>发布</span>
                                    <?php
                                }
                                ?>
                                <span class="btn btn-xs red delete" data-id="<?=$av['id']?>" data-recycle=1><i class="fa fa-trash-o"></i>删除</span>
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
<?php if(isset($article_res)&&count($article_res)>0){ ?>
<div class="row">
    <div class="col-md-5 col-sm-12">
        <div class="dataTable-info">
            <?php
            if($page == ceil($total/10)){
                ?>
                第 <b><?=($page-1)*10+1?> - <?=$total?></b> 条数据，共 <b><?=$total?></b> 条数据
                <?php
            }else{
                ?>
                第 <b><?=($page-1)*10+1?> - <?=$page*10?></b> 条数据，共 <b><?=$total?></b> 条数据
                <?php
            }
            ?>

        </div>
    </div>
    <?php if(ceil($total/10)>1){?>
        <div class="col-md-7 col-sm-12">
            <ul class="pagination pull-right">
                <li class="">
                    <a href="/article/index/1<?=$geturl?>"><i class="fa fa-angle-double-left"></i></a>
                </li>
                <li class="">
                    <a href="/article/index/<?=$page-1>0?$page-1:1?><?=$geturl?>"><i class="fa fa-angle-left"></i></a>
                </li>
                <?php
                if(ceil($total/10)==2){
                    if($page==1){
                        ?>
                        <li class="active"><a href="/article/index/1<?=$geturl?>">1</a></li>
                        <li class=""><a href="/article/index/2<?=$geturl?>">2</a></li>
                        <?php
                    }
                    if($page==2){
                        ?>
                        <li class=""><a href="/article/index/1<?=$geturl?>">1</a></li>
                        <li class="active"><a href="/article/index/2<?=$geturl?>">2</a></li>
                        <?php
                    }
                    ?>
                    <?php
                }
                if(ceil($total/10)==3){
                    for($i=1;$i<4;$i++){
                        if($page==$i){
                            ?>
                            <li class="active"><a href="/article/index/<?=$i?><?=$geturl?>"><?=$i?></a></li>
                            <?php
                        }else{
                            ?>
                            <li class=""><a href="/article/index/<?=$i?><?=$geturl?>"><?=$i?></a></li>
                            <?php
                        }
                        ?>
                        <?php
                    }
                }
                if(ceil($total/10)>3){
                    if($page<1){
                        $page=1;
                    }
                    if($page>=ceil($total/10)){
                        $page=ceil($total/10)-1;
                        $cur_page = true;
                    }
                    ?>
                    <?php if($page>1){?><li class=""><a href="/article/index/<?=$page-1?><?=$geturl?>"><?=$page-1?></a></li><?php }?>
                    <li class="<?php if(!isset($cur_page)){echo 'active';}?>"><a href="/article/index/<?=$page?><?=$geturl?>"><?=$page?></a></li>
                    <li class="<?php if(isset($cur_page)){echo 'active';}?>"><a href="/article/index/<?=$page+1?><?=$geturl?>"><?=$page+1?></a></li>
                    <?php if($page==1){?><li class=""><a href="/article/index/<?=$page+2?><?=$geturl?>"><?=$page+2?></a></li><?php }?>

                    <?php
                }
                ?>

                <li>
                    <a href="/article/index/<?=$page+1>ceil($total/10)?ceil($total/10):$page+1?><?=$geturl?>"><i class="fa fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="/article/index/<?=ceil($total/10)?><?=$geturl?>"><i class="fa fa-angle-double-right"></i></a>
                </li>
            </ul>
        </div>
    <?php } ?>
</div>
<?php } ?>