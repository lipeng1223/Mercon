<div class="box-content">
	<div class="padded">
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo get_phrase('product_name');?>:</label>
			<label class="col-sm-5 control-label" style="color: #1C4AC0;  font-weight: bold;"><?php echo $product_name;?></label>
		</div>
	</div>
</div>
<br><br>
<?php echo form_open('admin/product_item/save/'.$productid , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
    <table class="table table-bordered datatable" id="table_export">
        <thead>
            <tr>
    			<th><div><?php echo get_phrase('part_no');?></div></th>
                <th><div><?php echo get_phrase('size');?></div></th>
                <th><div><?php echo get_phrase('price($)');?></div></th>
                <th><div><?php echo get_phrase('product_code');?></div></th>
                <th><div>Weight(GM)</div></th>
                <th><div>Stocked Item</div></th>
                <th><div><?php echo get_phrase('active');?></div></th>
                <th><div><?php echo get_phrase('options');?></div></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($items as $row):?>
            <tr>
                <td>
                    <input type="hidden" name="id[]" value="<?=$row['id']?>">
                    <input type="text" class="form-control" name="partno[]" value="<?=$row['partno']?>">
                </td>
    			<td><input type="text" class="form-control" name="size[]" value="<?=$row['size']?>"></td>
    			<td><input type="number" class="form-control" name="price[]" value="<?=$row['price']?>" onkeyup="this.value=number_filter1(this.value);"></td>
    			<td><input type="text" class="form-control" name="code[]" value="<?=$row['code']?>"></td>
    			<td><input type="number" class="form-control" name="weight[]" value="<?=$row['weight']?>" onkeyup="this.value=number_filter1(this.value);"></td>
    			<td width="120px" data-validate="required">
                    <select name="color[]" class="form-control color" style="color: <?=$row['color']?>">
                    	<option value="red" <?php if($row['color'] == "red")echo 'selected';?> style="color: red;">Red</option>
                    	<option value="green" <?php if($row['color'] == "green")echo 'selected';?> style="color: green;">Green</option>
                    </select>
                </td>
                <td width="120px" data-validate="required">
                    <select name="active[]" class="form-control">
                    	<option value="1" <?php if($row['active'] == 1)echo 'selected';?>>Active</option>
                    	<option value="0" <?php if($row['active'] == 0)echo 'selected';?>>Deactive</option>
                    </select>
                </td>
                <td>
                    <a class="btn btn-default" href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/product_item/delete/<?php echo $row['id'].'/'.$productid;?>');">
                	<i class="entypo-trash"></i>
						<?php echo get_phrase('delete');?>
                   	</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    
    <div class="form-group pull-right">
		<div class="col-sm-1">
			<button type="submit" class="btn btn-blue pull-right"><?php echo get_phrase('save');?></button>
		</div>
		<div class="col-sm-1">
			<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_item_add/<?=$productid?>');" 
            	class="btn btn-red">
                <i class="entypo-plus-circled"></i>
            	<?php echo get_phrase('add_new_item');?>
            </a> 
		</div>
	</div>
</form>

<script type="text/javascript">
$(document).ready(function() {
   $('.color').change(function() {
	  var color = $(this).val();
      $(this).css('color',color);
   }); 
});

function number_filter1(str_value){
	return str_value.replace(/[^0-9.]/gi, ""); 
}
</script>

