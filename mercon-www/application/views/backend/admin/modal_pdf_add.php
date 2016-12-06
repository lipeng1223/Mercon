<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_pdf_to_category');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open('admin/category_content/pdf_create/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="title"  data-validate="required" data-message-required="Value required" value="" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">PDF File</label>
                        
						<div class="col-sm-5">
							<input type="file" class="form-control" name="pdf" accept="application/pdf" data-validate="required" data-message-required="Value required" autofocus>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_PDF');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>