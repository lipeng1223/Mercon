<section id="page-title">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h1 class="mainTitle">Login or Register</h1>
				<span class="mainDescription"></span>
			</div>
			<ol class="breadcrumb">
				<li>
					<span>Home</span>
				</li>
				<li class="active">
					<span>Login & Register</span>
				</li>
			</ol>
		</div>
	</div>
</section>
<section class="container-fluid container-fullw bg-white">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h2 class="">Log in to Central Info</h2>
				<form action="" id="loginForm" method="post" role="form">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label> Email <span class="symbol required"></span></label>
								<input type="email" id="login_email" name="email" value="" data-msg-required="Please enter your email." maxlength="100" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label> Password <span class="symbol required"></span></label>
								<input type="password" id="login_password" name="password" value="" data-msg-required="Please enter password." maxlength="100" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" data-caption-delay="900" data-caption-class="fadeIn" class="btn btn-primary margin-top-15 opacity-0 btn-wide btn-scroll btn-scroll-top fa-arrow-right animated fadeIn">
								<span>Log In</span>
							</button>
						</div>
					</div>
				</form>
			</div>
			
			<div class="col-md-offset-1 col-md-7">
				<h2 class="">Register with Central Info</h2>
				<form action="<?php echo site_url('login/register')?>" id="registerForm" method="post" role="form">
					<div class="row">
					    <div class="col-md-6">
						    <div class="form-group">
								<label> Company Name <span class="symbol required"></span> </label>
								<input type="text" value="" data-msg-required="Please enter your company name" maxlength="100" class="form-control" name="company" id="company">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label> Address 1 <span class="symbol required"></span> </label>
								<input type="text" value="" data-msg-required="Please enter your address." class="form-control" name="address1" id="address1">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label> Contact Name <span class="symbol required"></span> </label>
								<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label> Address 2  </label>
								<input type="text" value="" data-msg-required="Please enter your address" class="form-control" name="address2" id="address2">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label> Your email <span class="symbol required"></span> </label>
								<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." 
								        class="form-control" name="email" id="email">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label> City <span class="symbol required"></span> </label>
								<input type="text" value="" data-msg-required="Please enter your city." maxlength="100" class="form-control" name="city" id="city">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label> Password <span class="symbol required"></span> </label>
								<input type="password" value="" data-msg-required="Please enter your password." maxlength="100" class="form-control" name="password" id="password">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label> State <span class="symbol required"></span> </label>
								<input type="text" value="" data-msg-required="Please enter your state." class="form-control" name="state" id="state">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label> Password Confirm <span class="symbol required"></span> </label>
								<input type="password" value="" data-msg-required="Please re enter your password" maxlength="100" class="form-control" name="repassword" id="repassword">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label> Country <span class="symbol required"></span> </label>
								<input type="text" value="" data-msg-required="Please enter your Country" class="form-control" name="country" id="country">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
							<div class="col-md-offset-6 col-md-6">
								<label> Postcode <span class="symbol required"></span> </label>
								<input type="text" value="" data-msg-required="Please enter your postcode." class="form-control" name="postcode" id="postcode">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group">
						    <div class="col-md-6">
								<label> Phone Number </label>
								<input type="text" value="" data-msg-required="Please enter your phonenumber" class="form-control" name="phone" id="phone">
							</div>
							
							<div class="col-md-6">
								<label> Mobile Number </label>
								<input type="text" value="" data-msg-required="Please enter your mobile number" class="form-control" name="mobile" id="mobile">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<button type="submit" data-caption-delay="900" data-caption-class="fadeIn" class="btn btn-primary margin-top-15 opacity-0 btn-wide btn-scroll btn-scroll-top fa-arrow-right animated fadeIn">
								<span>Register</span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>