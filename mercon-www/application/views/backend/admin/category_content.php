<div class="box-content">
	<div class="padded">
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo get_phrase('category_name');?>:</label>
			<label class="col-sm-5 control-label" style="color: #1C4AC0;  font-weight: bold;"><?php echo $category_name;?></label>
		</div>
	</div>
</div>

<!-- PDF link part -->
<br><br>
List for PDF
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
			<th><div><?php echo get_phrase('title');?></div></th>
			<th><div>PDF</div></th>
            <th colspan="2"><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($pdfs as $row):?>
        <tr>
            <td>
                <?=$row['title']?>
            </td>
            <td width='60px'>
                <a href="uploads/category_pdf/<?php echo $row['filename'];?>" target="_blank">
                    <img src="assets/images/pdf.jpg" class="img-rounded" height="30">
                </a>
            </td>
            <td width='80px'>
                <a class="btn btn-default" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_pdf_edit/<?php echo $row['id'].'/'.$cateid;?>');">
            	   <i class="entypo-trash"></i>
					<?php echo get_phrase('edit');?>
               	</a>
            </td>
            <td width='80px'>
                <a class="btn btn-default" href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/category_content/pdf_delete/<?php echo $row['id'].'/'.$cateid;?>');">
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
		<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_pdf_add/<?=$cateid?>');" 
        	class="btn btn-blue">
            <i class="entypo-plus-circled"></i>
        	<?php echo get_phrase('add_new_PDF');?>
        </a> 
	</div>
</div>

<!-- Youtube link part -->
<br><br>
List for Youtube
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
			<th><div><?php echo get_phrase('title');?></div></th>
			<th><div>Youtube</div></th>
            <th colspan="2"><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($videos as $row):?>
        <tr>
            <td>
                <?=$row['title']?>
            </td>
            <td width='60px'>
                <a href="<?php echo $row['url'];?>" target="_blank">
                    <img src="assets/images/YouTube-icon.png" class="img-rounded" height="30">
                </a>
            </td>
            <td width='80px'>
                <a class="btn btn-default" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_video_edit/<?php echo $row['id'].'/'.$cateid;?>');">
            	   <i class="entypo-trash"></i>
					<?php echo get_phrase('edit');?>
               	</a>
            </td>
            <td width='80px'>
                <a class="btn btn-default" href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/category_content/video_delete/<?php echo $row['id'].'/'.$cateid;?>');">
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
		<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_video_add/<?=$cateid?>');" 
        	class="btn btn-blue">
            <i class="entypo-plus-circled"></i>
        	<?php echo get_phrase('add_new_video');?>
        </a> 
	</div>
</div>

<!--Text Link Part -->
<br><br>
List for Link
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
			<th><div><?php echo get_phrase('link_name');?></div></th>
			<th><div><?php echo get_phrase('link_address');?></div></th>
            <th colspan="2"><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($links as $row):?>
        <tr>
            <td>
                <?=$row['linkName']?>
            </td>
            <td>
                <a href="<?php echo $row['linkAddress'];?>" target="_blank">
                   <i class="fa fa-link fa-2" aria-hidden="true"></i> <?=$row['linkAddress']?>
                </a>
            </td>
            <td width='80px'>
                <a class="btn btn-default" href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_link_edit/<?php echo $row['id'].'/'.$cateid;?>');">
            	   <i class="entypo-trash"></i>
					<?php echo get_phrase('edit');?>
               	</a>
            </td>
            <td width='80px'>
                <a class="btn btn-default" href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/category_content/link_delete/<?php echo $row['id'].'/'.$cateid;?>');">
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
		<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_link_add/<?=$cateid?>');" 
        	class="btn btn-blue">
            <i class="entypo-plus-circled"></i>
        	<?php echo get_phrase('add_new_link');?>
        </a> 
	</div>
</div>