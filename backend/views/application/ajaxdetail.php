<?php
use yii\helpers\Url;
?>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">报名详情</h4>
    </div>
    <div class="modal-body">
        <div class="table-scrollable">
            <table class="table table-striped table-hover table-bordered table-advance no-wrap" id="application_detail">
                <tbody>
                <?php
                if(isset($detail_array)&&count($detail_array)>0){
                    if($type==0){
                ?>
                        <tr><td> 姓名 </td><td> <?=$detail_array['name'] ?> </td></tr>
                        <tr><td> 手机 </td><td> <?=$detail_array['cellphone'] ?> </td></tr>
                        <tr><td> 证件类型 </td><td> <?=$detail_array['certificate_type'] ?> </td></tr>
                        <tr><td> 证件号码 </td><td> <?=$detail_array['certificate_number'] ?> </td></tr>
                        <tr><td> 邮箱地址 </td><td> <?=$detail_array['email'] ?> </td></tr>
                        <tr><td> 公司 </td><td> <?=$detail_array['company'] ?> </td></tr>
                        <tr><td> 职位 </td><td> <?=$detail_array['position'] ?> </td></tr>
                        <tr><td> 报名时间 </td><td> <?=$detail_array['created_at'] ?> </td></tr>
                        <tr><th> 状态 </th><td><?php if($detail_array['signin_at']==0){?> 未签到<?php }else{?> 已签到 <?php } ?> </td></tr>
                        <tr><td> 二维码</td><td> <?php if(isset($detail_array['qrcode'])){?><img src="<?=$detail_array['qrcode']?>" /><?php }else{echo '获取失败，刷新重试';}?> </td></tr>
                <?php
                        }elseif($type==1){
                 ?>
                        <tr><td> 姓名 </td><td> <?=$detail_array['name'] ?> </td></tr>
                        <tr><td> 手机 </td><td> <?=$detail_array['cellphone'] ?> </td></tr>
                        <tr><td> 证件类型 </td><td> <?=$detail_array['certificate_type'] ?> </td></tr>
                        <tr><td> 证件号码 </td><td> <?=$detail_array['certificate_number'] ?> </td></tr>
                        <tr><td> 邮箱地址 </td><td> <?=$detail_array['email'] ?> </td></tr>
                        <tr><td> 公司 </td><td> <?=$detail_array['company'] ?> </td></tr>
                        <tr><td> 职位 </td><td> <?=$detail_array['position'] ?> </td></tr>
                        <tr><td> 详细地址 </td><td> <?=$detail_array['address'] ?> </td></tr>
                        <tr><td> 报名时间 </td><td> <?=$detail_array['created_at'] ?> </td></tr>
                        <tr><td> 二维码</td><td> <?php if(isset($detail_array['qrcode'])){?><img src="<?=$detail_array['qrcode']?>" /><?php }else{echo '获取失败，刷新重试';}?> </td></tr>
                        <tr><td> 名片图片 </td><td> <?php if(isset($detail_array['card'])&&!empty($detail_array['card'])){?><img src="<?=$detail_array['card'] ?>" style="width:360px;height:216px"/><?php }?> </td></tr>
                <?php
                    }else{
                ?>
                        <tr><td> 公司名称 </td><td> <?=$detail_array['company'] ?> </td></tr>
                        <tr><td> 联系人 </td><td> <?=$detail_array['name'] ?> </td></tr>
                        <tr><td> 职位 </td><td> <?=$detail_array['position'] ?> </td></tr>
                        <tr><td> 联系电话 </td><td> <?=$detail_array['cellphone'] ?> </td></tr>
                        <tr><td> 邮箱地址 </td><td> <?=$detail_array['email'] ?> </td></tr>
                        <tr><td> 公司详细地址 </td><td> <?=$detail_array['address'] ?> </td></tr>
                        <tr><td> 公司网站 </td><td> <?=$detail_array['website'] ?> </td></tr>
                        <tr><td> 参展目的 </td><td> <?=$detail_array['purpose'] ?> </td></tr>
                        <tr><td> 参展面积 </td><td> <?=$detail_array['area'] ?> </td></tr>
                        <tr><td> 参展类别 </td><td> <?=$detail_array['classes'] ?> </td></tr>
                        <tr><td> 报名时间 </td><td> <?=$detail_array['created_at'] ?> </td></tr>
                        <tr><td> 二维码</td><td> <?php if(isset($detail_array['qrcode'])){?><img src="<?=$detail_array['qrcode']?>" /><?php }else{echo '获取失败，刷新重试';}?> </td></tr>
                <?php
                }}
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">关闭</button>
    </div>
</div>