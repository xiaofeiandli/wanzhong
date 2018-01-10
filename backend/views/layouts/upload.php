<!--PDF文件上传-->
<div class="modal fade" id="pdf_modal" tabindex="-1" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">音视频上传</h4>
            </div>
            <div class="modal-body">
                    <form role="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="icheck-inline">
                                    <div class="md-radio-inline">
                                        <div class="md-radio">
                                            <input class="icheck" type="radio" value='video' id="video" name="type_name" class="md-radiobtn" checked>
                                            <label for="video"><span></span><span class="check"></span><span class="box"></span>视频</label>
                                        </div>
                                        <div class="md-radio">
                                            <input class="icheck" type="radio" value='audio' id="audio" name="type_name" class="md-radiobtn">
                                            <label for="audio"><span></span><span class="check"></span><span class="box"></span>音频</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="file">
                        <label class="col-md-2 control-label">选择<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="file" name="file" accept="image/*,audio/*,video/*">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group" id="name">
                        <label class="col-md-2 control-label">名称<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control"  maxlength="20"/>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">描述&nbsp;</label>
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
                <h4 class="modal-title">图像上传</h4>
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