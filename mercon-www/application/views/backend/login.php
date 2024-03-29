<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo get_phrase('login');?> | <?php echo $system_title;?></title>
	

	<link rel="stylesheet" href="assets_backend/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets_backend/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets_backend/css/bootstrap.css">
	<link rel="stylesheet" href="assets_backend/css/neon-core.css">
	<link rel="stylesheet" href="assets_backend/css/neon-theme.css">
	<link rel="stylesheet" href="assets_backend/css/neon-forms.css">
	<link rel="stylesheet" href="assets_backend/css/custom.css">

	<script src="assets_backend/js/jquery-1.11.0.min.js"></script>

	<!--[if lt IE 9]><script src="assets_backend/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="assets_backend/images/favicon.png">
	
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '<?php echo base_url();?>';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content" style="width:100%;">
			
			<a href="<?php echo base_url();?>" class="logo">
				<img src="uploads/logo.jpg" height="160" alt="" />
			</a>
			
			<p class="description">
            	<h2 style="color:#cacaca; font-weight:100;">
					<?php echo $system_name;?>
              </h2>
           </p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Please enter correct email and password!</p>
			</div>
			
			<form method="post" role="form" id="form_login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" data-mask="email" value=""/>
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" value=""/>
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login
					</button>
				</div>
				
						
			</form>
			
			
			<!--<div class="login-bottom-links">
				<a href="#" class="link">Forgot your password?</a>
			</div>-->
			
		</div>
		
	</div>
	
</div>


	<!-- Bottom Scripts -->
	<script src="assets_backend/js/gsap/main-gsap.js"></script>
	<script src="assets_backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets_backend/js/bootstrap.js"></script>
	<script src="assets_backend/js/joinable.js"></script>
	<script src="assets_backend/js/resizeable.js"></script>
	<script src="assets_backend/js/neon-api.js"></script>
	<script src="assets_backend/js/jquery.validate.min.js"></script>
	<script src="assets_backend/js/neon-login.js"></script>
	<script src="assets_backend/js/neon-custom.js"></script>
	<script src="assets_backend/js/neon-demo.js"></script>

</body>
</html>