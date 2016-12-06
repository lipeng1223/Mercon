<div class="box-content">
	<?php echo form_open('admin/product/search' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
		<div class="padded">
			<div class="form-group">
				<label class="col-sm-2 control-label"><?php echo get_phrase('category_lv1');?>:</label>
				<div class="col-sm-2">
                    <select id="cate1" name="cate1" class="form-control" data-validate="required" data-message-required="Value required">
                        <option value=""></option>
                        <?php 
                            $this->db->where('pid',1);
                            $this->db->order_by('id asc');
        					$tops = $this->db->get('category')->result_array();
        					foreach($tops as $row): ?>
                            	<option value="<?php echo $row['id']; ?>" <?php if ($row['id']==$cate1) echo 'selected';?>>
        							<?php echo $row['keyword'];?>
                                </option>
                        <?php endforeach;?>
                	</select>
				</div>
				<label class="col-sm-2 control-label"><?php echo get_phrase('category_lv2');?>:</label>
				<div class="col-sm-2">
                    <select id="cate2" name="cate2" class="form-control">
                        <option value=""></option>
                        <?php 
                            $this->db->where('pid',$cate1);
                            $this->db->order_by('id asc');
        					$tops = $this->db->get('category')->result_array();
        					foreach($tops as $row): ?>
                            	<option value="<?php echo $row['id']; ?>" <?php if ($row['id']==$cate2) echo 'selected';?>>
        							<?php echo $row['keyword'];?>
                                </option>
                        <?php endforeach;?>
                	</select>
				</div>
				<div class="col-sm-1">
					<button type="submit" class="btn btn-blue"><?php echo get_phrase('search');?><i class="entypo-search"></i></button>
				</div>
				<div>
					<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_product_add/<?=$cate1?>/<?=$cate2?>');" 
                    	class="btn btn-red pull-right">
                        <i class="entypo-plus-circled"></i>
                    	<?php echo get_phrase('add_new_product');?>
                    </a> 
				</div>
			</div>
		</div>
	</form>	
</div>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div>ID</div></th>
            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
			<th><div><?php echo get_phrase('category Lv1');?></div></th>
            <th><div><?php echo get_phrase('category Lv2');?></div></th>
            <th><div><?php echo get_phrase('name');?></div></th>
            <th><div><?php echo get_phrase('number of items');?></div></th>
            <th><div><?php echo get_phrase('order');?></div></th>
            <th><div><?php echo get_phrase('active');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
			//$categorys = $this->db->get_where('category',array('pid'=>0))->result_array();
            foreach($products as $row):?>
        <tr>
            <td class="id"><?php echo $row['id'];?></td>
            <td><img src="<?php echo $this->crud_model->get_image_url('product',$row['id']);?>" class="img-thumbnail" width="30" /></td>
            <td><?php echo $cate1name;?></td>
			<td><?php echo $cate2name;?></td>
			<td><?php echo $row['name'];?></td>
			<td><?php echo $row['count'];?></td>
			<td>
			    <a class="btn btn-green up" href="#"><i class="fa fa-arrow-circle-up"></i></a>
                <a class="btn btn-red down" href="#"><i class="fa fa-arrow-circle-down"></i></a>
			</td>
            <td><?php if ($row['active']==1)echo 'YES'; else echo 'NO';?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        
                        <!-- cate EDITING LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_product_edit/<?php echo $row['id'];?>/<?=$cate1?>/<?=$cate2?>');">
                        	   <i class="entypo-pencil"></i>
								<?php echo get_phrase('edit_product');?>
                           	</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                        	<a href="<?php echo base_url();?>index.php?admin/product_item/<?php echo $row['id'];?>">
                        	   <i class="entypo-pencil"></i>
								<?php echo get_phrase('edit_items');?>
                           	</a>
                        </li>
                        <li class="divider"></li>
                        <!-- cate DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/product/delete/<?php echo $row['id'].'/'.$selected_id;?>');">
                            	<i class="entypo-trash"></i>
								<?php echo get_phrase('delete');?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
	    /*
		var datatable = $("#table_export").dataTable({
			"bSort" : false
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
		*/

		$("#cate1").change(function(){
	        var actionUrl = "<?php echo base_url();?>index.php?admin/ajax_get_cate2";
	        var cate1 = $(this).val();
	        $("#cate2").prop("disabled",true);
	        
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
	                $("#cate2").html(response);
	                $("#cate2").prop("disabled",false);
	            }
	        });
	    });

		$('.up').click(function() {
		    var row = $(this).closest('tr');

		    $('.data_row').css('background-color','#FFFFFF');
		    row.css('background-color','#D4D4E4');
		    
		    id = row.children('td.id').text();
		    //console.log(id);

		    var actionUrl = "<?php echo base_url();?>index.php?admin/product_up";

	        $.ajax({
	        	url: actionUrl,
				method: 'POST',
				dataType: 'json',
				data: {
					id: id
				},
				error: function()
				{
					sweetAlert("An error occoured!");
					return false;
				},
				success: function(response)
				{
					if(response==true){
						row.insertBefore(row.prev());
					}
					else{
						sweetAlert("Can't change Order!");
						return false;
					}
	            }
	        });
		});

		$('.down').click(function() {
			var row = $(this).closest('tr');
			
			$('.data_row').css('background-color','#FFFFFF');
			row.css('background-color','#D4D4E4');
						
			id = row.children('td.id').text();
		    //console.log(id);

		    var actionUrl = "<?php echo base_url();?>index.php?admin/product_down";

	        $.ajax({
	        	url: actionUrl,
				method: 'POST',
				dataType: 'json',
				data: {
					id: id
				},
				error: function()
				{
					sweetAlert("An error occoured!");
					return false;
				},
				success: function(response)
				{
					if(response==true){
						row.insertAfter(row.next());
					}
					else{
						sweetAlert("Can't change Order!");
						return false;
					}
	            }
	        });
		});
		
	});
		
</script>

