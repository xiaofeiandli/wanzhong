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
											<?php if(is_array($category_array)&&count($category_array)>0){ foreach($category_array as $ck=>$cv) { ?>
													<label>
														<input type="checkbox" name="category_<?=$cv['id']?>" value="<?=$cv['id']?>"   class="child-checkbox" <?php if(in_array($cv['id'],$article_detail['category_id'])) echo 'checked'; ?>> <?= $cv['name'] ?>
													</label>
												<?php }if($isnews==0){?> <div class="help-block">&nbsp;&nbsp;&nbsp;模版文章分类为单选</div><?php }}else{echo '暂无分类，请先到栏目管理添加';} ?>
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
						<div class="form-group" id="en_title">
							<label class="col-md-2 control-label">英文标题<i class="required">*</i></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="en_title"  placeholder="" value="<?=$article_detail['en_title']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<?php
							if(isset($isnews)&&$isnews!=1){
						?>
								<div class="form-group" id="weight">
									<label class="col-md-2 control-label">权重</label>
									<div class="col-md-8">
										<input type="text" class="form-control input-large" name="weight"  placeholder="" value="<?=$article_detail['weight']?>">
										<div class="help-block"></div>
									</div>
								</div>
						<?php
							}
						?>
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
						<div class="form-group" id="thumb_en">
							<label class="col-md-2 control-label">缩略图(英文版)</label>
							<div class="col-md-8">
								<div class="margin-top-10 thumb">
									<?php
									if(isset($article_detail['en_thumb'])&&$article_detail['en_thumb']!=''){?>
										<img height="150" width="200" src="<?=$article_detail['en_thumb']?>">
									<?php }
									?>
								</div>
								<input class="thumb_h" type="hidden" name="en_thumb" value="<?=$article_detail['en_thumb']?>">
								<span class="btn blue thumb-btn" style="margin-left:0;">上传</span>
								<span class="btn red endel">删除</span>
							</div>
						</div>
						<div class="form-group" id="source">
							<label class="col-md-2 control-label">来源</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="source"  placeholder="" value="<?=$article_detail['source']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="en_source">
							<label class="col-md-2 control-label">来源(英文)</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="en_source"  placeholder="" value="<?=$article_detail['en_source']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="author">
							<label class="col-md-2 control-label">作者</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="author"  placeholder="" value="<?=$article_detail['author']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="en_author">
							<label class="col-md-2 control-label">作者(英文)</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="en_author"  placeholder="" value="<?=$article_detail['en_author']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="keywords">
							<label class="col-md-2 control-label">关键字</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="keywords"  placeholder="" value="<?=$article_detail['keywords']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="en_keywords">
							<label class="col-md-2 control-label">关键字(英文)</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="en_keywords"  placeholder="" value="<?=$article_detail['en_keywords']?>">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="description">
							<label class="col-md-2 control-label">描述<i class="required">*</i></label>
							<div class="col-md-8">
								<textarea class="form-control" rows="3" name="description" style="resize: none;"><?=$article_detail['description']?></textarea>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group" id="en_description">
							<label class="col-md-2 control-label">描述(英文)<i class="required">*</i></label>
							<div class="col-md-8">
								<textarea class="form-control" rows="3" name="en_description" style="resize: none;"><?=$article_detail['en_description']?></textarea>
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
						<div class="form-group" id="content_en">
							<label class="col-md-2 control-label">内容(英文)<i class="required">*</i></label>
							<div class="col-md-8">
								<div class="summernote"><?=$article_detail['en_content'] ?></div>
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
											<?php if(is_array($category_array)&&count($category_array)>0){ foreach($category_array as $ck=>$cv) { ?>
												<label><input type="checkbox" name="category_<?=$cv['id']?>" value="<?=$cv['id']?>" flag="<?=$cv['flag'] ?>"  class="child-checkbox"> <?= $cv['name'] ?></label>
											<?php }if($isnews==0){?> <div class="help-block">&nbsp;&nbsp;&nbsp;模版文章分类为单选</div><?php }}else{echo '暂无分类，请先到栏目管理添加';}  ?>
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
						<div class="form-group" id="en_title">
							<label class="col-md-2 control-label">英文标题<i class="required">*</i></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="en_title">
								<div class="help-block"></div>
							</div>
						</div>
						<?php
						if(isset($isnews)&&$isnews!=1){
							?>
							<div class="form-group" id="weight">
								<label class="col-md-2 control-label">权重</label>
								<div class="col-md-8">
									<input type="text" class="form-control input-large" name="weight"  placeholder="" value="">
									<div class="help-block"></div>
								</div>
							</div>
							<?php
						}
						?>
						<div class="form-group" id="thumb">
							<label class="col-md-2 control-label">缩略图</label>
							<div class="col-md-8">
								<div class="margin-top-10 thumb"></div>
								<input class="thumb_h" type="hidden" name="thumb">
								<span class="btn blue thumb-btn" style="margin-left:0;">上传</span>
								<span class="btn red del">删除</span>
							</div>
						</div>
						<div class="form-group" id="thumb_en">
							<label class="col-md-2 control-label">缩略图(英文版)</label>
							<div class="col-md-8">
								<div class="margin-top-10 thumb"></div>
								<input class="thumb_h" type="hidden" name="en_thumb">
								<span class="btn blue thumb-btn" style="margin-left:0;">上传</span>
								<span class="btn red endel">删除</span>
							</div>
						</div>
						<div class="form-group" id="source">
							<label class="col-md-2 control-label">来源</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="source"  placeholder="">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="en_source">
							<label class="col-md-2 control-label">来源(英文)</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="en_source"  placeholder="">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="author">
							<label class="col-md-2 control-label">作者</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="author"  placeholder="">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="en_author">
							<label class="col-md-2 control-label">作者(英文)</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="en_author"  placeholder="">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="keywords">
							<label class="col-md-2 control-label">关键字</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="keywords"  placeholder="">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="en_keywords">
							<label class="col-md-2 control-label">关键字(英文)</label>
							<div class="col-md-8">
								<input type="text" class="form-control input-large" name="en_keywords"  placeholder="">
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="description">
							<label class="col-md-2 control-label">描述<i class="required">*</i></label>
							<div class="col-md-8">
								<textarea class="form-control" rows="3" name="description" style="resize: none;"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group" id="en_description">
							<label class="col-md-2 control-label">描述(英文)<i class="required">*</i></label>
							<div class="col-md-8">
								<textarea class="form-control" rows="3" name="en_description" style="resize: none;"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group" id="content">
							<label class="col-md-2 control-label">内容<i class="required">*</i></label>
							<div class="col-md-8">
								<div class="summernote"></div>
								<div class="help-block"></div>
							</div>
						</div>
						<div class="form-group" id="content_en">
							<label class="col-md-2 control-label">内容(英文)<i class="required">*</i></label>
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


