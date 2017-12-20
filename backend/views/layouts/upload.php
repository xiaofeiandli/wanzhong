<!--PDF文件上传-->
<div class="modal fade" id="pdf_modal" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">资源上传</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="pdf" name="type_name">
                    <div class="form-group" id="file">
                        <label class="col-md-2 control-label">选择资源<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="file" name="file" accept="image/*,audio/*,video/*">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group" id="name">
                        <label class="col-md-2 control-label">中文名称<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control"  maxlength="20"/>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">资源描述&nbsp;</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="desc" maxlength="100" rows="4" style="resize:none;"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary submit">提交</button>
            </div>
        </div>
    </div>
</div>

<!--高清图片批量上传-->
<div class="modal fade" id="image_modal" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">高清图片上传</h4>
            </div>
            <div class="modal-body">
                <div class="uploader">
                    <div id="file_list" class="uploader-list clearfix"></div>
                </div>
            </div>
            <div class="modal-footer uploader-action" id="up_action">
                <button type="button" class="btn btn-sm blue" id="picker">选择文件</button>
                <button type="button" class="btn btn-sm green" id="upload">开始上传</button>
                <button type="button" class="btn btn-sm yellow" id="reload">重新上传</button>
            </div>
        </div>
    </div>
</div>