<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">

			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-user"></i> 
					<?php echo get_phrase('manage_profile');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
		<div class="tab-content">
        	<!----EDITING FORM STARTS---->
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/pvideo_management/save' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <?php 
                        if ($video->url != ''):
                        ?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <iframe style="height:400px !important; width: 100%" src="<?php echo $video->url;?>" frameborder="0"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>
                        </div>
                        <?php endif;?>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Youtube Embeded URL</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="url" value="<?php echo $video->url;?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                              <button type="submit" class="btn btn-info"><?php echo get_phrase('save');?></button>
                            </div>
						</div>
                    </form>
                </div>
			</div>
            <!----EDITING FORM ENDS--->
            
		</div>
	</div>
</div>