<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_product_item');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/product_item/create/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate'));?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('part_no');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="partno"  data-validate="required" data-message-required="Value required" value="" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('size');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="size" value=""  data-validate="required" data-message-required="Value required" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                        
						<div class="col-sm-5">
							<input type="number" class="form-control" name="price" value=""  data-validate="required" data-message-required="Value required" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('product_code');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="code" value=""  data-validate="required" data-message-required="Value required" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Weight(GM)</label>
                        
						<div class="col-sm-5">
							<input type="number" class="form-control" name="weight" value=""  data-validate="required" data-message-required="Value required" autofocus>
						</div> 
					</div>
					
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('color');?></label>
                        <div class="col-sm-5">
                            <select name="color" class="form-control color" style="color: red">
                            	<option value="red" style="color: red;">Red</option>
                            	<option value="green" style="color: green;">Green</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_item');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>