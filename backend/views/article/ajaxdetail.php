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
                        <tr><th> 英文版标题 </th><td> <?=$detail_array['en_title'] ?> </td></tr>
                        <tr><th> 所属分类 </th><td> <?php if(isset($detail_array['category_name'])){echo $detail_array['category_name'];} ?> </td></tr>
                        <tr><th> 缩略图 </th>
                            <td>
                                <?php if(isset($detail_array['thumb'])&&$detail_array['thumb']!=''){?>
                                <img height="150" width="200" src="<?=$detail_array['thumb']?>">
                                <?php } ?>
                            </td></tr>
                        <tr><th> 英文版缩略图 </th>
                            <td>
                                <?php if(isset($detail_array['en_thumb'])&&$detail_array['en_thumb']!=''){?>
                                    <img height="150" width="200" src="<?=$detail_array['en_thumb']?>">
                                <?php } ?>
                            </td></tr>
                        <tr><th> 来源 </th><td> <?=$detail_array['source'] ?> </td></tr>
                        <tr><th> 英文版来源 </th><td> <?=$detail_array['en_source'] ?> </td></tr>
                        <tr><th> 作者 </th><td> <?=$detail_array['author'] ?> </td></tr>
                        <tr><th> 英文版作者 </th><td> <?=$detail_array['en_author'] ?> </td></tr>
                        <tr><th> 关键字 </th><td> <?=$detail_array['keywords'] ?> </td></tr>
                        <tr><th> 英文版关键字 </th><td> <?=$detail_array['en_keywords'] ?> </td></tr>
                        <tr><th> 描述 </th><td> <?=$detail_array['description'] ?> </td></tr>
                        <tr><th> 英文版描述 </th><td> <?=$detail_array['en_description'] ?> </td></tr>
                        <tr><th> 状态 </th><td><?php if($detail_array['status']==0){?> 未发布<?php }else{?> 已发布 <?php } ?> </td></tr>
                        <tr><th> 发布人 </th><td> <?=$detail_array['created_by'] ?> </td></tr>
                        <tr><th> 发布时间 </th><td> <?=$detail_array['created_at'] ?> </td></tr>
                        <tr><th> 更新时间 </th><td> <?=$detail_array['updated_at'] ?> </td></tr>
                        <tr>
                            <th> 内容 </th>
                            <td>
                                <div class="phone-view"><?=$detail_array['content'] ?></div>
                            </td>
                        </tr>
                        <tr>
                            <th> 英文版内容 </th>
                            <td>
                                <div class="phone-view"><?=$detail_array['en_content'] ?></div>
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