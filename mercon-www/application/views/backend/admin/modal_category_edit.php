<?php 
$edit_data		=	$this->db->get_where('category' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_category');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/category/update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-7">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('category' , $param2);?>" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('parent_category');?></label>
                        
						<div class="col-sm-7">
							<select name="parentid" class="form-control">
                                <?php 
                					$this->db->where('id',1);
                                    $this->db->or_where('pid',1);                    
                					$tops = $this->db->get('category')->result_array();
                					foreach($tops as $row1): ?>
                                    	<option value="<?php echo $row1['id']; ?>" <?php if ($row1['id']==$row['pid']) echo 'selected';?>>
                							<?php echo $row1['keyword'];?>
                                        </option>
                                <?php endforeach;?>
                        	</select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('keyword');?></label>
                        
						<div class="col-sm-7">
							<input type="text" class="form-control" name="keyword"  data-validate="required" data-message-required="Value required" value="<?=$row['keyword']?>" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('description');?></label>
                        
						<div class="col-sm-7">
							<input type="text" class="form-control" name="description" value="<?=$row['description']?>" >
						</div> 
					</div>
					
					<div class="form-group">
                        <label class="col-sm-4 control-label">Hide from Catalogue</label>
                        <div class="col-sm-7">
                            <input type="checkbox" name="isHide" value="1" style="width:30px; height:30px" 
                                <?php if($row['isHiddenInPdf'] == 1)echo 'checked';?>/>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('active');?></label>
                        <div class="col-sm-7">
                            <select name="active" class="form-control">
                            	<option value="1" <?php if($row['active'] == 1)echo 'selected';?>>Active</option>
                            	<option value="0" <?php if($row['active'] == 0)echo 'selected';?>>Deactive</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('update_category');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php
endforeach;
?>