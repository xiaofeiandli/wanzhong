<?php
use yii\web\View;
$this->title = '文章管理';
$this->registerCssFile("@web/js/plugins/bootstrap-summernote/summernote.css");
$this->registerCssFile("@web/js/plugins/bootstrap-fileinput/bootstrap-fileinput.css");
$this->registerCssFile("@web/js/plugins/icheck/skins/all.css");
$this->registerCssFile("@web/js/plugins/ladda/ladda-themeless.min.css");
?>
<div class="row">
    <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="fa fa-wordpress"></i>
            </div>
            <div class="details">
                <div class="number">
                     <?=$count['lyric']?>
                </div>
                <div class="desc">
                     歌词
                </div>
            </div>
            <a class="more" href="/article/index/1/1">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-hoki">
            <div class="visual">
                <i class="fa fa-file-word-o"></i>
            </div>
            <div class="details">
                <div class="number">
                     <?=$count['poem']?>
                </div>
                <div class="desc">
                     诗
                </div>
            </div>
            <a class="more" href="/article/index/2/1">
            View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box <?php if($type==1){echo 'blue-madison';}elseif($type==2){echo 'blue-hoki';}else{echo 'blue-hoki';}?>">
            <div class="portlet-title" style="padding-right:0;">
                <div class="caption">
                    <i class="icon-layers"></i><?php if($type==1){echo '歌词管理';}elseif($type==2){echo '诗管理';}else{echo '文章管理';}?>
                </div>
                <!-- <span class="btn blue pull-right" style="padding: 10px 14px;" id="new_article"><i class="fa fa-plus"></i> 添加文章</span> -->
            </div>
            <div class="portlet-body">
                <?php if(isset($article_res)&&count($article_res)>0){ ?>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover" id="article" style="white-space: nowrap;">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> 标题 </th>
                            <th> 创建时间 </th>
                            <th> 阅读数 </th>
                            <th> 状态 </th>
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
                                <td> <?=$av['created_at'] ?> </td>
                                <td> <?=$av['read'] ?> </td>
                                <td>
                                    <?php if($av['status']==0){?>
                                        <span class="stopping">未发布</span>
                                    <?php }else{ ?>
                                        <span class="working">已发布</span>
                                    <?php } ?>
                                </td>
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
                    <a href="/article/index/1"><i class="fa fa-angle-double-left"></i></a>
                </li>
                <li class="">
                    <a href="/article/index/<?=$page-1>0?$page-1:1?>"><i class="fa fa-angle-left"></i></a>
                </li>
                <?php
                if(ceil($total/10)==2){
                    if($page==1){
                        ?>
                        <li class="active"><a href="/article/index/1">1</a></li>
                        <li class=""><a href="/article/index/2">2</a></li>
                        <?php
                    }
                    if($page==2){
                        ?>
                        <li class=""><a href="/article/index/1">1</a></li>
                        <li class="active"><a href="/article/index/2">2</a></li>
                        <?php
                    }
                    ?>
                    <?php
                }
                if(ceil($total/10)==3){
                    for($i=1;$i<4;$i++){
                        if($page==$i){
                            ?>
                            <li class="active"><a href="/article/index/<?=$i?>"><?=$i?></a></li>
                            <?php
                        }else{
                            ?>
                            <li class=""><a href="/article/index/<?=$i?>"><?=$i?></a></li>
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
                    <?php if($page>1){?><li class=""><a href="/article/index/<?=$page-1?>"><?=$page-1?></a></li><?php }?>
                    <li class="<?php if(!isset($cur_page)){echo 'active';}?>"><a href="/article/index/<?=$page?>"><?=$page?></a></li>
                    <li class="<?php if(isset($cur_page)){echo 'active';}?>"><a href="/article/index/<?=$page+1?>"><?=$page+1?></a></li>
                    <?php if($page==1){?><li class=""><a href="/article/index/<?=$page+2?>"><?=$page+2?></a></li><?php }?>

                    <?php
                }
                ?>

                <li>
                    <a href="/article/index/<?=$page+1>ceil($total/10)?ceil($total/10):$page+1?>"><i class="fa fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="/article/index/<?=ceil($total/10)?>"><i class="fa fa-angle-double-right"></i></a>
                </li>
            </ul>
        </div>
    <?php } ?>
</div>
<?php } ?>