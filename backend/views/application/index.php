<?php
use yii\web\View;
$this->title = '报名管理';
?>
<div class="row" id="rall">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-hoki">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number"><?=$counts[0]?></div>
                <div class="desc">个人报名</div>
            </div>
            <a class="more" href="/application/index/0/1">View more <i class="m-icon-swapright m-icon-white"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number"><?=$counts[1]?></div>
                <div class="desc">媒体报名</div>
            </div>
            <a class="more" href="/application/index/1/1">View more <i class="m-icon-swapright m-icon-white"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number"><?=$counts[2]?></div>
                <div class="desc">展商报名</div>
            </div>
            <a class="more" href="/application/index/2/1">View more <i class="m-icon-swapright m-icon-white"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple-plum">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number"><?=$counts[3]?></div>
                <div class="desc">现场报名</div>
            </div>
            <a class="more" href="/application/index/3/1">View more <i class="m-icon-swapright m-icon-white"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <?php
        if($type==0){
    ?>
            <div class="col-md-12">
                <div class="portlet box blue-hoki">
                    <div class="portlet-title"  style="min-height: 36px;padding: 0 0 0 10px">
                        <div class="caption">
                            <i class="fa fa-puzzle-piece"></i>个人报名列表
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form class="form-inline">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>姓名:</label>
                                    <input class="form-control input-sm" placeholder="支持部分查询" name="name" type="text" value="">
                                    <input type="hidden" name="issearch" value="yes">
                                </div>
                                <div class="form-group">
                                    <label>手机号:</label>
                                    <input class="form-control input-sm" placeholder="支持部分查询" name="cellphone" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <label>签到状态:</label>
                                    <select class="bs-select form-control input-sm" name="signin_at">
                                        <option value="">全部</option>
                                        <option value=0>未签到</option>
                                        <option value=1>已签到</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn blue btn-sm"><i class="fa fa-search"></i> 搜索</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if(isset($application[0]['id'])){
                            $i=($page-1)*10+1;
                            ?>
                            <div class="table-scrollable">
                                <table class="table table-hover" id="application">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>姓名</th>
                                        <th>公司</th>
                                        <th>手机号码</th>
                                        <th>邮箱</th>
                                        <th>签到状态</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($application as $ak=>$av){
                                        ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$av['name']?></td>
                                            <td><?=$av['company']?></td>
                                            <td><?=$av['cellphone']?></td>
                                            <td><?=$av['email']?></td>
                                            <td>
                                                <?php if($av['signin_at']==0){?>
                                                    <span class="stopping">未签到</span>
                                                <?php }else{ ?>
                                                    <span class="working">已签到</span>
                                                <?php } ?>
                                            </td>
                                            <td><span class="btn btn-xs blue read"  data-id="<?=$av['id']?>" data-type="<?=$type?>"><i class="fa fa-book"></i> 详情</span></td>
                                        </tr>
                                        <?php  $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{?>
                            当前列表数据为空
                        <?php }?>
                    </div>
                </div>
            </div>
    <?php
        }elseif($type==1){
    ?>
            <div class="col-md-12">
                <div class="portlet box yellow">
                    <div class="portlet-title" style="min-height: 36px;padding: 0 0 0 10px">
                        <div class="caption">
                            <i class="fa fa-puzzle-piece"></i>媒体报名列表
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php
                        if(isset($application[0]['id'])){
                            $i=($page-1)*10+1;
                            ?>
                            <div class="table-scrollable">
                                <table class="table table-hover" id="application">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            姓名
                                        </th>
                                        <th>
                                            手机
                                        </th>
                                        <th>
                                            证件类型
                                        </th>
                                        <th>
                                            证件号码
                                        </th>
                                        <th>
                                            邮箱地址
                                        </th>
                                        <th>
                                            公司
                                        </th>
                                        <th>
                                            操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($application as $ak=>$av){
                                        ?>
                                        <tr>
                                            <td>
                                                <?=$i?>
                                            </td>
                                            <td>
                                                <?=$av['name']?>
                                            </td>
                                            <td>
                                                <?=$av['cellphone']?>
                                            </td>
                                            <td>
                                                <?=$av['certificate_type']?>
                                            </td>
                                            <td>
                                                <?=$av['certificate_number']?>
                                            </td>
                                            <td>
                                                <?=$av['email']?>
                                            </td>
                                            <td>
                                                <?=$av['company']?>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs green read" data-id="<?=$av['id']?>" data-type="<?=$type?>"><i class="fa fa-book"></i>详情</a>
                                            </td>
                                        </tr>
                                        <?php  $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{?>
                            当前列表数据为空
                        <?php }?>
                    </div>
                </div>
            </div>
    <?php
        }elseif($type==2){
     ?>
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title"  style="min-height: 36px;padding: 0 0 0 10px">
                        <div class="caption">
                            <i class="fa fa-puzzle-piece"></i>展商报名列表
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php
                        if(isset($application[0]['id'])){
                            $i=($page-1)*10+1;
                            ?>
                            <div class="table-scrollable">
                                <table class="table table-hover" id="application">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            公司名称
                                        </th>
                                        <th>
                                            联系人
                                        </th>
                                        <th>
                                            职位
                                        </th>
                                        <th>
                                            联系电话
                                        </th>
                                        <th>
                                            邮箱地址
                                        </th>
                                        <th>
                                            操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($application as $ak=>$av){
                                        ?>
                                        <tr>
                                            <td>
                                                <?=$i?>
                                            </td>
                                            <td>
                                                <?=$av['company']?>
                                            </td>
                                            <td>
                                                <?=$av['name']?>
                                            </td>
                                            <td>
                                                <?=$av['position']?>
                                            </td>
                                            <td>
                                                <?=$av['cellphone']?>
                                            </td>
                                            <td>
                                                <?=$av['email']?>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs green read" data-id="<?=$av['id']?>" data-type="<?=$type?>"><i class="fa fa-book"></i>详情</a>
                                            </td>
                                        </tr>
                                        <?php  $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{?>
                            当前列表数据为空
                        <?php }?>
                    </div>
                </div>
            </div>
    <?php 
        }else{
    ?>
            <div class="col-md-12">
                <div class="portlet box purple-plum">
                    <div class="portlet-title"  style="min-height: 36px;padding: 0 0 0 10px">
                        <div class="caption">
                            <i class="fa fa-puzzle-piece"></i>现场报名列表
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php
                        if(isset($application[0]['id'])){
                            $i=($page-1)*10+1;
                            ?>
                            <div class="table-scrollable">
                                <table class="table table-hover" id="application">
                                    <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            姓名
                                        </th>
                                        <th>
                                            二维码(点击下载)
                                        </th>
                                        <th>
                                            操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($application as $ak=>$av){
                                        ?>
                                        <tr>
                                            <td>
                                                <?=$i?>
                                            </td>
                                            <td>
                                                <?=$av['name']?>
                                            </td>
                                            <td>
                                                <?php if(!empty($av['qrcode'])){?>
                                                <a download="现场观众<?=$av['id']?>.png" href="<?=$av['qrcode']?>"><img style="width: 100px;height: 100px" src="<?=$av['qrcode']?>" download="现场观众<?=$av['id']?>"></a>
                                                <?php }else{echo '[图片无法显示]';}?>
                                            </td>
                                            <td>
                                                <?php if($av['signin_at']==0){?>
                                                    <span class="stopping">未签到</span>
                                                <?php }else{ ?>
                                                    <span class="working">已签到</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php  $i++;}?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }else{?>
                            当前列表数据为空
                        <?php }?>
                    </div>
                </div>
            </div>
    <?php 
        }
    ?>
</div>
<?php if(isset($application[0]['id'])){?>
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
                    <a href="/application/index/<?=$type?>/1<?=$geturl?>"><i class="fa fa-angle-double-left"></i></a>
                </li>
                <li class="">
                    <a href="/application/index/<?=$type?>/<?=$page-1>0?$page-1:1?><?=$geturl?>"><i class="fa fa-angle-left"></i></a>
                </li>
                <?php
                if(ceil($total/10)==2){
                    if($page==1){
                        ?>
                        <li class="active"><a href="/application/index/<?=$type?>/1<?=$geturl?>">1</a></li>
                        <li class=""><a href="/application/index/<?=$type?>/2<?=$geturl?>">2</a></li>
                        <?php
                    }
                    if($page==2){
                        ?>
                        <li class=""><a href="/application/index/<?=$type?>/1<?=$geturl?>">1</a></li>
                        <li class="active"><a href="/application/index/<?=$type?>/2<?=$geturl?>">2</a></li>
                        <?php
                    }
                    ?>
                    <?php
                }
                if(ceil($total/10)==3){
                    for($i=1;$i<4;$i++){
                        if($page==$i){
                            ?>
                            <li class="active"><a href="/application/index/<?=$type?>/<?=$i?><?=$geturl?>"><?=$i?></a></li>
                            <?php
                        }else{
                            ?>
                            <li class=""><a href="/application/index/<?=$type?>/<?=$i?><?=$geturl?>"><?=$i?></a></li>
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
                    <?php if($page>1){?><li class=""><a href="/application/index/<?=$type?>/<?=$page-1?><?=$geturl?>"><?=$page-1?></a></li><?php }?>
                    <li class="<?php if(!isset($cur_page)){echo 'active';}?>"><a href="/application/index/<?=$type?>/<?=$page?><?=$geturl?>"><?=$page?></a></li>
                    <li class="<?php if(isset($cur_page)){echo 'active';}?>"><a href="/application/index/<?=$type?>/<?=$page+1?><?=$geturl?>"><?=$page+1?></a></li>
                    <?php if($page==1){?><li class=""><a href="/application/index/<?=$type?>/<?=$page+2?><?=$geturl?>"><?=$page+2?></a></li><?php }?>

                    <?php
                }
                ?>

                <li>
                    <a href="/application/index/<?=$type?>/<?=$page+1>ceil($total/10)?ceil($total/10):$page+1?><?=$geturl?>"><i class="fa fa-angle-right"></i></a>
                </li>
                <li>
                    <a href="/application/index/<?=$type?>/<?=ceil($total/10)?><?=$geturl?>"><i class="fa fa-angle-double-right"></i></a>
                </li>
            </ul>
        </div>
    <?php } ?>
<?php }?>
</div>
<div class="modal fade" id="qrcode_modal" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">批量生成现场报名二维码</h4>
            </div>
            <div class="modal-body">
                <form id="create_qrcode" role="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-2 control-label">个数<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="number" id="qrcode_number" name="qrcode_number" class="form-control" placeholder="一次最多生成50个" />
                            <p class="help-block"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div id="qrcode_down" class="modal-footer">
                <button type="button" id="close_down_qrcode" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" id="create_download_qrcode" class="btn btn-primary submit">生成</button>
            </div>
        </div>
    </div>
</div>

