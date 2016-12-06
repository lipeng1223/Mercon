<br><br>
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
			<th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Recieved</th>
        </tr>
    </thead>
    <tbody>
    	
        <?php 
            foreach($contact_us_data as $row):?>
        <tr>
            <td><?php echo $row->id; ?></td>
			<td><?php echo $row->name; ?></td>
			<td><?php echo $row->email; ?></td>
			<td><?php echo $row->subject; ?></td>
			<td><?php echo $row->message; ?></td>
			<td><?php echo date("d-m-Y", $row->datetime); ?></td>
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

