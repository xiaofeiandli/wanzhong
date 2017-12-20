<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">文章详情</h4>
    </div>
    <div class="modal-body">
        <div class="table-scrollable">
            <table class="table table-striped table-hover table-bordered table-advance detail-view">
                <tbody>
                <?php
                if(isset($detail_array)&&count($detail_array)>0){
                ?>
                        <tr><th> 标题 </th><td> <?=$detail_array['title'] ?> </td></tr>
                        <tr><th> 缩略图 </th>
                            <td>
                                <?php if(isset($detail_array['thumb'])&&$detail_array['thumb']!=''){?>
                                <img height="150" width="200" src="<?=$detail_array['thumb']?>">
                                <?php } ?>
                            </td></tr>
                        <tr><th> 作者 </th><td> <?=$detail_array['author'] ?> </td></tr>
                        <tr><th> 状态 </th><td><?php if($detail_array['status']==0){?> 未发布<?php }else{?> 已发布 <?php } ?> </td></tr>
                        <tr><th> 发布时间 </th><td> <?=$detail_array['created_at'] ?> </td></tr>
                        <tr>
                            <th> 内容 </th>
                            <td>
                                <div class="phone-view"><?=$detail_array['content'] ?></div>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">关闭</button>
    </div>
</div>