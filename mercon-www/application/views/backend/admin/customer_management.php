<a href="<?php echo site_url('admin/customer_export')?>" class="btn btn-red pull-right">
    <i class="entypo-plus-circled"></i>
	Download to Excel
</a>
<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
			<th>ID</th>
            <th>Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Company Size</th>
            <th class="hidden-xs hidden-sm">WillPurchaseIn</th>
            <th class="hidden-xs hidden-sm">RequestCallBack</th>
            <th class="hidden-xs hidden-sm">SendNewsletter</th>
            <th class="hidden-xs hidden-sm">DateCreated</th>
            <th><div>Options</div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($customers as $row):?>
        <tr>
            <td><?php echo $row['customerID'];?></td>
			<td><?php echo $row['firstName'].' '.$row['lastName'];?></td>
			<td><?php echo $row['companyName'];?></td>
			<td><?php echo $row['emailAddress'];?></td>
			<td><?php echo $row['phoneNumber'];?></td>
			<td><?php echo $row['companySize'];?></td>
			<td class="hidden-xs hidden-sm"><?php echo $row['willPurchaseIn'];?></td>
            <td class="hidden-xs hidden-sm"><?php if ($row['requestCallBack']==1)echo 'YES'; else echo 'NO';?></td>
            <td class="hidden-xs hidden-sm"><?php if ($row['sendNewsletter']==1)echo 'YES'; else echo 'NO';?></td>
            <td class="hidden-xs hidden-sm"><?php echo $row['dateCreated'];?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                        <!-- cate DELETION LINK -->
                        <li>
                        	<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/customer_management/delete/<?php echo $row['customerID'];?>');">
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
		var datatable = $("#table_export").dataTable({
			"bSort" : false
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

