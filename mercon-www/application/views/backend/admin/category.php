<div class="box-content">
	<?php echo form_open('admin/category/search' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
		<div class="padded">
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo get_phrase('select_category_level_one');?></label>
				<div class="col-sm-4">
                    <select id="parentid" name="parentid" class="form-control">
                        <?php 
                            $this->db->where('id', 1);
                            $this->db->or_where('pid', 1); 
                            $this->db->order_by('id','asc');                   
        					$tops = $this->db->get('category')->result_array();
        					foreach($tops as $row): ?>
                            	<option value="<?php echo $row['id']; ?>" <?php if ($row['id']==$selected_id) echo 'selected';?>>
        							<?php echo $row['keyword'];?>
                                </option>
                        <?php endforeach;?>
                	</select>
				</div>
				<div class="col-sm-2">
					<button type="submit" class="btn btn-blue"><?php echo get_phrase('search');?><i class="entypo-search"></i></button>
				</div>
				<div>
					<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_category_add/<?=$selected_id?>');" 
                    	class="btn btn-red pull-right">
                        <i class="entypo-plus-circled"></i>
                    	<?php echo get_phrase('add_new_category');?>
                    </a> 
				</div>
			</div>
		</div>
	</form>	
</div>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th>ID</th>
            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
			<th><div><?php echo get_phrase('top_level');?></div></th>
            <th><div><?php echo get_phrase('keyword');?></div></th>
            <th><div><?php echo get_phrase('description');?></div></th>
            <th><div><?php echo get_phrase('order');?></div></th>
            <th><div><?php echo get_phrase('hide_from_catalogue');?></div></th>
            <th><div><?php echo get_phrase('active');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
			//$categorys = $this->db->get_where('category',array('pid'=>0))->result_array();
            foreach($categorys as $row):?>
        <tr>
            <td class="id"><?php echo $row['id'];?></td>
            <td><img src="<?php echo $this->crud_model->get_image_url('category',$row['id']);?>" class="img-thumbnail" width="30" /></td>
            <td><?php echo $row['parent'];?></td>
			<td><?php echo $row['keyword'];?></td>
			<td><?php echo $row['description'];?></td>
			<td>
			    <a class="btn btn-green up" href="#"><i class="fa fa-arrow-circle-up"></i></a>
                <a class="btn btn-red down" href="#"><i class="fa fa-arrow-circle-down"></i></a>
			</td>
			<td><?php if ($row['isHiddenInPdf']==1) echo 'Hide'; else echo 'Show';?></td>
            <td><?php if ($row['active']==1) echo 'YES'; else echo 'NO';?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- cate EDITING LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_category_edit/<?php echo $row['id'];?>');">
                            	<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                        <!-- detail EDITING LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_category_detail/<?php echo $row['id'];?>/<?php echo $row['pid'];?>');">
                            	<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit_details');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                        <li>
                        	<a href="<?php echo base_url();?>index.php?admin/category_content/<?php echo $row['id'];?>">
                            	<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit_spec_and_link');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <!-- cate DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/category/delete/<?php echo $row['id'].'/'.$selected_id;?>');">
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

		$('.up').click(function() {
		    var row = $(this).closest('tr');

		    $('.data_row').css('background-color','#FFFFFF');
		    row.css('background-color','#D4D4E4');
		    
		    id = row.children('td.id').text();
		    //console.log(id);

		    var actionUrl = "<?php echo base_url();?>index.php?admin/category_up";

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

		    var actionUrl = "<?php echo base_url();?>index.php?admin/category_down";

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

