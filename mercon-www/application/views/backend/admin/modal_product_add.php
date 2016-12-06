<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_product');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/product/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
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
						<label for="field-2" class="col-sm-3 control-label">Category LV1</label>
                        
						<div class="col-sm-5">
							<select id="cat1" name="cate1" class="form-control" data-validate="required" data-message-required="Value required">
                                <option value=""></option>
                                <?php 
                                    $this->db->where('pid',1);
                                    $this->db->order_by('id asc');
                					$cate1s = $this->db->get('category')->result_array();
                					foreach($cate1s as $row): ?>
                                    	<option value="<?php echo $row['id']; ?>" <?php if ($row['id']==$param2) echo 'selected';?>>
                							<?php echo $row['keyword'];?>
                                        </option>
                                <?php endforeach;?>
                        	</select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Category LV2</label>
                        <?php
                            if ($param2 > 0){
                                $this->db->where('pid',$param2);
                                $this->db->order_by('id asc');
                                $cate2s = $this->db->get('category')->result_array();
                            } 
                        ?>
						<div class="col-sm-5">
							<select id="cat2" name="cate2" class="form-control" <?php if (count($cate2s)>0) echo "data-validate='required' data-message-required='Value required'";?>>
                                <option value=""></option>
                                <?php
                					foreach($cate2s as $row): ?>
                                    	<option value="<?php echo $row['id']; ?>" <?php if ($row['id']==$param3) echo 'selected';?>>
                							<?php echo $row['keyword'];?>
                                        </option>
                                <?php endforeach;?>
                        	</select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name"  data-validate="required" data-message-required="Value required" value="" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('number_of_items');?></label>
                        
						<div class="col-sm-5">
							<input type="number" class="form-control" name="count" value=""  data-validate="required" data-message-required="Value required" autofocus>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_product');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	$("#cat1").change(function(){
        var actionUrl = "<?php echo base_url();?>index.php?admin/ajax_get_cate2";
        var cate1 = $(this).val();
        $("#cat2").prop("disabled",true);
        
        $.ajax({
        	url: actionUrl,
			method: 'POST',
			dataType: 'json',
			data: {
				cate1: cate1
			},
			error: function()
			{
				alert("An error occoured!");
			},
			success: function(response)
			{
                $("#cat2").html(response);
                $("#cat2").prop("disabled",false);
            }
        });
    });
		
</script>