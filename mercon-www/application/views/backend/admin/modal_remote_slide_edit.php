<?php
    $online_db = $this->load->database('online', TRUE);
    $edit_data = $online_db->get_where('banner_slide', array('id'=>$param2))->result_array();
    foreach ($edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_slide_banner');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/banner_management/remote_update/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('image');?></label>
                        
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_online_url('slide', $param2);?>">
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
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control" name="title" data-validate="required" data-message-required="Value required" value="<?php echo $row['title']?>" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subtitle');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control" name="sub_title"  data-validate="required" data-message-required="Value required" value="<?php echo $row['sub_title']?>" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('button_text');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control" name="button_text" data-validate="required" data-message-required="Value required" value="<?php echo $row['button_text']?>" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('button_link');?></label>
                        
						<div class="col-sm-8">
							<input type="text" class="form-control" name="button_link" data-validate="required" data-message-required="Value required" value="<?php echo $row['button_link']?>" autofocus>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-8">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('save');?></button>
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