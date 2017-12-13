<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"></button>
		<h4 class="modal-title"><i class="fa fa-edit"></i><?php if($data){echo '编辑';}else{echo '添加';}?>栏目</h4>
	</div>
	<div class="modal-body">
		<form role="form" class="form-horizontal">
			<div class="form-body">
				<div class="form-group" id="cate_name">
					<label class="col-md-2 control-label">栏目名称（中文）</label>
					<div class="col-md-8">
						<input type="text" id="name" class="form-control" value="<?php if($data){echo $data['name'];}?>" name="name">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="form-group" id="cate_name_en">
					<label class="col-md-2 control-label">栏目名称（英文）</label>
					<div  class="col-md-8">
						<input type="text" id="en_name" class="form-control"  value="<?php if($data){echo $data['en_name'];}?>" name="en_name">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="form-group"  id="flag">
					<label class="col-md-2 control-label">栏目标记</label>
					<div  class="col-md-8">
						<input type="text" class="form-control"  value="<?php if($data){echo $data['flag'];}?>" name="flag">
						<span class="help-block">'news'已分配给会展新闻,请慎重添加</span>
					</div>
				</div>
				<div class="form-group" id="status">
					<label class="col-md-2 text-right">是否发布</label>
					<div class="col-md-8">
						<div class="checkbox" style="padding-left: 0;">
							<label>
								<input type="checkbox"  name="status" <?php if($data['status']==1){echo 'checked';}?> >选中表示发布（添加文章时可选）
							</label>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn default" data-dismiss="modal">取消</button>
		<button type="button" class="btn blue submit" id="upload_category">提交</button>
	</div>
</div>