<?php
    $categories = $this->crud_model->get_product_category(); 
?>
<aside class="sidebar">
	<h4>Categories</h4>
	<ul class="nav nav-list blog-categories">
	<?php foreach ($categories as $cat):?>
		<li>
			<a href="<?php echo site_url().'index.php?products_sub/'.$cat['id'];?>"> <?php echo $cat['keyword'];?> </a>
		</li>
	<?php endforeach;?>
		<!--
		<li>
			<a href="<?php echo site_url('products_sub/0');?>"> Cable Trays </a>
		</li>
		-->
	</ul>
</aside>