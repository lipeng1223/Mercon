<div>
	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_pslide_add');" 
    	class="btn btn-red pull-right">
        <i class="entypo-plus-circled"></i>
    	<?php echo get_phrase('add_new_slide');?>
    </a> 
</div>
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th style="max-width:80px"><div>ID</div></th>
            <th style="min-width:200px"><div><?php echo get_phrase('slide_image');?></div></th>
            <th style="min-width:93px"><div><?php echo get_phrase('order');?></div></th>
            <th style="max-width:80px"><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
			//$categorys = $this->db->get_where('category',array('pid'=>0))->result_array();
            foreach($slides as $row):?>
        <tr>
            <td class="id"><?php echo $row['id'];?></td>
            <td><img src="<?php echo $this->crud_model->get_image_url('pslide', $row['id']);?>" class="img-thumbnail" width="200"/></td>
			<td>
			    <a class="btn btn-green up" href="#"><i class="fa fa-arrow-circle-up"></i></a>
                <a class="btn btn-red down" href="#"><i class="fa fa-arrow-circle-down"></i></a>
			</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- cate EDITING LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_pslide_edit/<?php echo $row['id'];?>');">
                            	<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <!-- cate DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/pslide_management/delete/<?php echo $row['id'];?>');">
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

		    var actionUrl = "<?php echo base_url();?>index.php?admin/slide_up";

	        $.ajax({
	        	url: actionUrl,
				method: 'POST',
				dataType: 'json',
				data: {
					id: id,
					table: 'product_slide'
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
						sweetAlert("Can't change Sequence!");
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

		    var actionUrl = "<?php echo base_url();?>index.php?admin/slide_down";

	        $.ajax({
	        	url: actionUrl,
				method: 'POST',
				dataType: 'json',
				data: {
					id: id,
					table: 'product_slide'
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
						sweetAlert("Can't change Sequence!");
						return false;
					}
	            }
	        });
		});
	});
		
</script>

