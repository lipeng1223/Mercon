<div>
	<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_about_image_add');" 
    	class="btn btn-red pull-right">
        <i class="entypo-plus-circled"></i>
    	<?php echo get_phrase('upload_new_image');?>
    </a> 
</div>
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th style="max-width:80px"><div>ID</div></th>
            <th style="min-width:200px"><div><?php echo get_phrase('image');?></div></th>
            <th style="min-width:93px"><div><?php echo get_phrase('url');?></div></th>
            <th style="max-width:80px"><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
			$i = 1;
            foreach($images as $row):?>
        <tr>
            <td class="id"><?php echo $i;?></td>
            <td><img src="<?php echo base_url().'uploads/about_us_image/'.$row['image_name'];?>" class="img-thumbnail" width="200"/></td>
			<td>
			    <textarea cols="100" rows="2"><?php echo base_url().'uploads/about_us_image/'.$row['image_name'];?></textarea>
			</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- cate EDITING LINK -->
                        <li>
                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_about_image_edit/<?php echo $row['id'];?>');">
                            	<i class="entypo-pencil"></i>
								<?php echo get_phrase('edit');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <!-- cate DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/about_us_images/delete/<?php echo $row['id'];?>');">
                            	<i class="entypo-trash"></i>
								<?php echo get_phrase('delete');?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php $i++; endforeach;?>
    </tbody>
</table>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable({});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>