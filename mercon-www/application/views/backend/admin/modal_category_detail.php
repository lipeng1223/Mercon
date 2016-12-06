<?php 
$edit_data		=	$this->db->get_where('category_details' , array('categoryID' => $param2) )->row();
$content = $edit_data->categoryDetails;
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
				
                <form action="<?php echo base_url()?>admin/category/detail_update/<?php echo $param2?>/<?php echo $param3;?>" method="post" 
                    accept-charset="utf-8" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" novalidate="novalidate" 
                    onsubmit="return postForm()">
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="<?php echo $this->crud_model->get_image_url('category_detail' , $param2);?>" alt="...">
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
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('details');?></label>
                        
						<div class="col-sm-9">
							<div class="summernote"><?php echo $content;?></div>
							<textarea class="form-control hide" id="content" name="content"></textarea>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('update_category');?></button>
						</div>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var postForm = function() {
	var content = $('#content').html($('.summernote').summernote("code"));
}
</script>