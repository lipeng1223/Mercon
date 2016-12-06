<div class="row">
    <div class="col-md-12">
        <h2><a href="#"><?php echo $category_info->keyword;?></a></h2>
    </div>
    
    <hr>
    
    <ul id="Grid" class="list-unstyled">
    <?php foreach ($subs as $row):?>
        <a href="<?php echo site_url().'index.php?products_detail/'. $row['id']?>">
    		<li class="col-md-2 col-xs-3 mix category_1" data-cat="1" style="display: inline-block;">
    			<div class="portfolio-item icons-effect" style="height: 131px;">
    				<div class="thumb-overlay">
    					<img src="<?php echo $this->crud_model->get_image_url('category', $row['id']);?>" class="img-responsive" style="height:77px">
    				</div>
    				<div class="thumb-info center margin-top-10">
    					<span><?php echo $row['keyword']?></span>
    				</div>
    			</div>
    		</li>
		</a>
	<?php endforeach;?>
	</ul>
</div>