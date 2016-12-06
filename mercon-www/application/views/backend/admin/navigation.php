<div class="sidebar-menu">
		<header class="logo-env" >
			
            <!-- logo -->
			<div class="logo" style="margin-left: 30px;">
				<a href="<?php echo base_url();?>">
					<!--<img src="uploads/logo.png"  style="max-height:60px;"/>-->
					<h1><span style="color: #FFFFFF"><?php echo $system_title;?></span></h1>
				</a>
			</div>
            
			<!-- logo collapse icon -->
			<div class="sidebar-collapse" style="">
				<a href="#" class="sidebar-collapse-icon with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		
		<div style="border-top:1px solid rgba(255, 255, 255, 1);"></div>	
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            
           
           <!-- DASHBOARD -->
           <li class="<?php if($page_name == 'dashboard') echo 'active';?>">
				<a href="<?php echo base_url();?>index.php?admin/dashboard">
					<i class="entypo-home"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
           </li>
           
           <!-- Category -->
           <li class="<?php if($page_name == 'category' || $page_name == 'category_content') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/category">
					<i class="entypo-flow-tree"></i>
					<span><?php echo get_phrase('category_manager');?></span>
				</a>
           </li>
           
           <!-- Product -->
           <li class="<?php if($page_name == 'product_keyword' || $page_name == 'product_item') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/product">
					<i class="entypo-lifebuoy"></i>
					<span><?php echo get_phrase('product_manager');?></span>
				</a>
				<!--
                <ul>
					<li class="<?php if($page_name == 'exam')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/exam">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Level 1');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'grade')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/grade">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('Level 2');?></span>
						</a>
					</li>
                </ul>
                -->
           </li>
           
           <!-- price -->
           <li class="<?php if($page_name == 'price_page' || $page_name == 'price_file') echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-credit-card"></i>
					<span><?php echo get_phrase('price_manager');?></span>
				</a>
				<ul>
					<li class="<?php if($page_name == 'price_page')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/price_page">
							<span><i class="entypo-dot"></i> Quick Price Update</span>
						</a>
					</li>
					<li class="<?php if($page_name == 'price_file')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/price_file">
							<span><i class="entypo-dot"></i> Update by Excel</span>
						</a>
					</li>				
                </ul>
           </li>
           
           <!-- Customer Registrations -->
           <li class="<?php if($page_name == 'customer_management') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/customer_management">
					<i class="entypo-users"></i>
					<span>Customer Registrations</span>
				</a>
           </li>
           
           <!-- Banner Slide Manager -->
           <li class="<?php if($page_name == 'banner_management') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/banner_management">
					<i class="entypo-book"></i>
					<span>Banner Slide</span>
				</a>
           </li>
           
           <!-- Product Slide Manager -->
           <li class="<?php if($page_name == 'pslide_management') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/pslide_management">
					<i class="entypo-docs"></i>
					<span>Product Slide</span>
				</a>
           </li>
           
           <!-- Product Video Manager -->
           <li class="<?php if($page_name == 'pvideo_management') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/pvideo_management">
					<i class="fa fa-youtube"></i>
					<span>Product Video</span>
				</a>
           </li>
           
           <!-- Product -->
           <li class="<?php if($page_name == 'about_us_images' || $page_name == 'about_us_content') echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-doc-text-inv"></i>
					<span><?php echo get_phrase('about_us_page');?></span>
				</a>
				<ul>
					<li class="<?php if($page_name == 'about_us_images') echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/about_us_images">
							<span><i class="entypo-dot"></i> Images</span>
						</a>
					</li>
					<li class="<?php if($page_name == 'about_us_content')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/about_us_content">
							<span><i class="entypo-dot"></i> Page Content</span>
						</a>
					</li>				
                </ul>
           </li>
           
           <!-- Contact Us List -->
           <li class="<?php if($page_name == 'contact_us') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/contact_us">
					<i class="fa fa-envelope-o"></i>
					<span>Contact Us</span>
				</a>
           </li>
            
           <!-- ACCOUNT -->
           <li class="<?php if($page_name == 'manage_profile') echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/manage_profile">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('my_account');?></span>
				</a>
           </li>
                
           
           
		</ul>
        		
</div>