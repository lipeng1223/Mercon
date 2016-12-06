        <!-- start: MAIN JAVASCRIPTS -->
		<script src="<?php echo base_url();?>assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/sticky-kit/jquery.sticky-kit.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/jquery.appear.js/jquery.appear.js"></script>
		<script src="<?php echo base_url();?>assets/components/slick.js/slick/slick.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/swiper/dist/js/swiper.jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/jquery.stellar/jquery.stellar.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/countto/jquery.countTo.js"></script>
		<script src="<?php echo base_url();?>assets/components/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/jquery/dist/jquery.form.js"></script>
		<script src="<?php echo base_url();?>assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url();?>assets/js/index.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<?php if ($page_name=="catalogue" || $page_name=="catalogue_download"):?>
		<!-- start: contact us page -->
		<script src="<?php echo base_url();?>assets/js/catalogue.js"></script>
		<!-- end: contact us page -->
		<?php endif;?>
		
		<?php if ($page_name=="contact_us"):?>
		<!-- start: contact us page -->
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script src="<?php echo base_url();?>assets/components/gmaps/gmaps.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/contact.js"></script>
		<!-- end: contact us page -->
		<?php endif;?>
		
		<script src="<?php echo base_url();?>assets/components/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url();?>assets/components/sweetalert/sweet-alert.min.js"></script>
		<script src="<?php echo base_url();?>assets/components/jquery-validation/jquery.validate.min.js"></script>
		
		<script src="<?php echo base_url();?>assets/js/login.js"></script>
		
		<script>
			jQuery(document).ready(function() {
				Main.init();
				
				Index.init();

				<?php if ($page_name=="catalogue"):?>
			        Catalogue.init();
				<?php endif;?>

				<?php if ($page_name=="contact_us"):?>
			        Contact.init();
				<?php endif;?>
				
				<?php if ($page_name=="contact_us_submitted"):?>
			        Contact.init();
				<?php endif;?>

				Login.init();
			});
		</script>