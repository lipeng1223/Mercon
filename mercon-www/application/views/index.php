<!DOCTYPE html>
<!-- Template Name: Clip-Two - Frontend | Build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<html lang="en">
    <!-- start: HEAD -->
    <head>
        <?php include 'includes_top.php';?>
    </head>
    <!-- end: HEAD -->
    
    <body >
    <script type="text/javascript">
        var baseurl = '<?php echo base_url();?>';
    </script>
		<div id="app">
		    <!-- start: HEADER -->
		        <?php include 'header.php';?>
		    <!-- end: HEADER -->
		    
		    <!-- start: HOME MAIN SLIDER -->
		        <?php if ($page_name=="home") include 'slide.php';?>
		    <!-- end: HOME MAIN SLIDER -->
		    
		    <!-- start: Main -->
		        <div class="app-content">
				    <div class="main-content">
				        <?php include 'pages/'. $page_name. '.php';?>
				    </div>
				    
				    <?php include 'footer.php';?>
				</div>
		    <!-- end: Main -->
        </div>
        <?php include 'includes_bottom.php';?>
        
        <!-- Start of StatCounter Code for Default Guide --> <script type="text/javascript"> var sc_project=10692931; var sc_invisible=0; var sc_security="715145c7"; var scJsHost = (("https:" == document.location.protocol) ?
		"https://secure." : "http://www.");
		document.write("<sc"+"ript type='text/javascript' src='" + scJsHost+ "statcounter.com/counter/counter.js'></"+"script>");
		</script>
		<noscript><div class="statcounter"><a title="website statistics"
		href="http://statcounter.com/free-web-stats/" target="_blank"><img class="statcounter" src="http://c.statcounter.com/10692931/0/715145c7/0/"
		alt="website statistics"></a></div></noscript>
		<!-- End of StatCounter Code for Default Guide -->

    </body>
</html>