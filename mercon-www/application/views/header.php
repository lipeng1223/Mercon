<header>
	<div class="navbar navbar-default" role="navigation">
		<!-- start: TOP NAVIGATION CONTAINER -->
		<div class="container">
			<div class="navbar-header">
				<!-- start: RESPONSIVE MENU TOGGLER -->
				<a class="pull-left menu-toggler hidden-md hidden-lg mobile-button" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <i class="ti-align-justify"></i> </a>
				<!-- end: RESPONSIVE MENU TOGGLER -->
				<!-- start: RESPONSIVE MENU SEARCH -->
				<a class="pull-right hidden-md hidden-lg margin-right-20 mobile-button mobile-menu-search" href="#"> <span class="sr-only">Search Button</span> <i class="ti-search"></i> </a>
				<!-- end: RESPONSIVE MENU SEARCH -->
				<!-- start: LOGO -->
				<a href="<?php echo site_url();?>" class="navbar-brand"> <img src="<?php echo site_url('assets/images/logo/logo.png');?>" alt="Clip-Two"> </a>
				<!-- end: LOGO -->
			</div>
			<!-- start: NAVBAR -->
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="<?php if ($page_name=="home") echo "active";?>">
						<a href="<?php echo site_url();?>"> Home </a>
					</li>
					
					<li class="<?php if ($page_name=="products") echo "active";?>">
						<a href="<?php echo site_url();?>index.php?products"> Products </a>
					</li>
					
					<li class="<?php if ($page_name=="catalogue") echo "active";?>">
						<a href="<?php echo site_url();?>index.php?catalogue"> Download Catalogue </a>
					</li>
					
					<li class="<?php if ($page_name=="datasheets") echo "active";?>">
						<a href="<?php echo site_url()?>index.php?datasheets"> Datasheets </a>
					</li>
					
					<li class="<?php if ($page_name=="training") echo "active";?>">
						<a href="<?php echo site_url()?>index.php?training"> Training </a>
					</li>
					
					<li class="<?php if ($page_name=="terms_conditions") echo "active";?>">
						<a href="<?php echo site_url()?>index.php?terms_conditions"> Terms and Conditions </a>
					</li>
					
					<li class="<?php if ($page_name=="about_us") echo "active";?>">
						<a href="<?php echo site_url()?>index.php?about_us"> About Us </a>
					</li>
					
					<li class="<?php if ($page_name=="contact_us") echo "active";?>">
						<a href="<?php echo site_url();?>index.php?contact_us"> Contact Us </a>
					</li>
				</ul>
				
				<!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
				<div class="close-handle visible-sm-block visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
					<div class="arrow-left"></div>
					<div class="arrow-right"></div>
				</div>
				<!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
			</div>
			<!-- end: NAVBAR -->
		</div>
		<!-- end: TOP NAVIGATION CONTAINER -->
	</div>
</header>