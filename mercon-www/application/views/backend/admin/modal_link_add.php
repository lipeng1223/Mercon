<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_link_to_category');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open('admin/category_content/link_create/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate'));?>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="linkName"  data-validate="required" data-message-required="Value required" value="" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="linkAddress"  data-validate="required" data-message-required="Value required" value="" autofocus>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_link');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>