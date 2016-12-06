<?php 
$edit_data = $this->db->get_where('category_youtube' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_video_content');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open('admin/category_content/video_update/'.$param2.'/'.$param3, array('class' => 'form-horizontal form-groups-bordered validate'));?>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="title"  data-validate="required" data-message-required="Value required" value="<?=$row['title'];?>" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('url');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="url"  data-validate="required" data-message-required="Value required" value="<?=$row['url'];?>" autofocus>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info">Edit Video Content</button>
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