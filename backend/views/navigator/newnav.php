<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"></button>
		<h4 class="modal-title"><i class="fa fa-edit"></i><?php if($data){echo '编辑';}else{echo '添加';}?>导航</h4>
	</div>
	<div class="modal-body">
		<form role="form" class="form-horizontal">
			<div class="form-body">
				<div class="form-group" id="cate_name">
					<label class="col-md-3 control-label">导航名称（中文）</label>
					<div class="col-md-8">
						<input type="text" class="form-control" value="<?php if($data){echo $data['name'];}?>" name="name">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="form-group"  id="cate_name_en">
					<label class="col-md-3 control-label">导航名称（英文）</label>
					<div  class="col-md-8">
						<input type="text" class="form-control"  value="<?php if($data){echo $data['en_name'];}?>" name="en_name">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="form-group" id="nav_url">
					<label class="col-md-3 control-label">导航地址</label>
					<div  class="col-md-8">
						<input type="text"  class="form-control"  value="<?php if($data){echo $data['url'];}?>" name="url">
						<span class="help-block">如：http://www.gfm.mobi</span>
					</div>
				</div>
				<div class="form-group" id="weight">
					<label class="col-md-3 control-label">权重</label>
					<div  class="col-md-8">
						<input type="number"  class="form-control" value="<?php if($data){echo $data['weight'];}else{echo '1';}?>" name="weight" placeholder="">
						<span class="help-block">请填写数字，权重越大排序越靠前</span>
					</div>
				</div>
				<?php if($class_one){?>
				<div class="form-group">
					<label class="col-md-3 control-label">导航级别</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="icheck-inline">
                                <div class="md-radio-inline">
                                    <div class="md-radio">
                                        <input class="icheck" type="radio" value='1' id="radio14" name="class" class="md-radiobtn" <?php if($data['class']==1){echo 'checked';}?>>
                                        <label for="radio14">
                                            <span></span>
                                            <span class="check" style="background:#337ab7;"></span>
                                            <span class="box"></span>
                                            一级导航 </label>
                                    </div>
                                    <div class="md-radio has-warning">
                                        <input class="icheck" type="radio" value='2' id="radio16" name="class" class="md-radiobtn" <?php if($data['class']==2){echo 'checked';}?>>
                                        <label for="radio16" style="color: #333;">
                                            <span></span>
                                            <span class="check" style="background:#337ab7;"></span>
                                            <span class="box" style="border-color:#666;"></span>
                                            二级导航 </label>
                                    </div>
                                    <span class="help-block">未选默认一级导航</span>
                                </div>
                            </div>
                        </div>
                        <span class="help-block"></span>
                    </div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">所属一级分类</label>
					<div class="col-md-8">
						<select id="notific8_life" class="form-control input-medium" name="pid">
						<option value="">未选择</option>
						<?php foreach($class_one as $k=>$v){?>
							<option value="<?=$v['id']?>" <?php if($data['parent_id']==$v['id']){echo 'selected';}?>><?=$v['name']?></option>
						<?php }?>
						</select>
					</div>
				</div>
				<?php }?>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn default" data-dismiss="modal">取消</button>
		<button type="button" class="btn blue submit">提交</button>
	</div>
</div>