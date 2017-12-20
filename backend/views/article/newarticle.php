<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<?php
		if(isset($article_detail)&&count($article_detail)>0) {
			?>
			<h4 class="modal-title"><i class="fa fa-edit"></i>编辑文章</h4>
		<?php
			}else{
		?>
			<h4 class="modal-title"><i class="fa fa-edit"></i>新增文章</h4>
		<?php
		}
		?>
	</div>
	<div class="modal-body">
		<form role="form" class="form-horizontal">
			<?php
				if(isset($article_detail)&&count($article_detail)>0) {
			?>
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label">文章分类<i class="required">*</i></label>
							<div class="col-md-8">
								<div class="form-group">
									<div class="input-group">
										<div class="icheck-inline margin-left-60" id="checkform">
													<label>
														<input type="checkbox" name="category_1" value="1"   class="child-checkbox"> 诗
														<input type="checkbox" name="category_2" value="2"   class="child-checkbox"> 歌词
													</label>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-group" id="title">
							<label class="col-md-2 control-label">标题<i class="required">*</i></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="title"  placeholder="" value="<?=$article_detail['title']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="thumb">
							<label class="col-md-2 control-label">缩略图</label>
							<div class="col-md-8">
								<div class="margin-top-10 thumb">
									<?php
									if(isset($article_detail['thumb'])&&$article_detail['thumb']!=''){?>
										<img height="150" width="200" src="<?=$article_detail['thumb']?>">
									<?php }
									?>
								</div>
								<input class="thumb_h" type="hidden" name="thumb" value="<?=$article_detail['thumb']?>">
								<span class="btn blue thumb-btn" style="margin-left:0;">上传</span>
								<span class="btn red del">删除</span>
							</div>
						</div>
						<div class="form-group" id="author">
							<label class="col-md-2 control-label">作者</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="author"  placeholder="" value="<?=$article_detail['author']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="content">
							<label class="col-md-2 control-label">内容<i class="required">*</i></label>
							<div class="col-md-8">
								<div class="summernote"><?=$article_detail['content'] ?></div>
								<div class="help-block"></div>
							</div>
						</div>
					</div>
			<?php
				}else{
			?>
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label">文章分类<i class="required">*</i></label>
							<div class="col-md-8">
								<div class="form-group">
									<div class="input-group">
										<div class="icheck-inline margin-left-60" id="checkform">
												<label><input type="checkbox" name="category_1" value="1"   class="child-checkbox"> 诗</label>
												<label><input type="checkbox" name="category_2" value="2"   class="child-checkbox"> 歌词</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" id="title">
							<label class="col-md-2 control-label">标题<i class="required">*</i></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="title" >
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="thumb">
							<label class="col-md-2 control-label">缩略图</label>
							<div class="col-md-8">
								<div class="margin-top-10 thumb"></div>
								<input class="thumb_h" type="hidden" name="thumb">
								<span class="btn blue thumb-btn" style="margin-left:0;">上传</span>
								<span class="btn red del">删除</span>
							</div>
						</div>
						<div class="form-group" id="author">
							<label class="col-md-2 control-label">作者</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="author"  placeholder="">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="content">
							<label class="col-md-2 control-label">内容<i class="required">*</i></label>
							<div class="col-md-8">
								<div class="summernote"></div>
								<div class="help-block"></div>
							</div>
						</div>
					</div>
			<?php
				}
			?>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn">取消</button>
		<button type="button" class="btn blue submit">提交</button>
	</div>
</div>


