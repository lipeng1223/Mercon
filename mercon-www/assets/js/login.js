var Login = function () {
    var runLoginButtons = function () {
        $('.forgot').bind('click', function () {
            $('.box-login').hide();
            $('.box-forgot').show();
        });
        $('.register').bind('click', function () {
            $('.box-login').hide();
            $('.box-register').show();
        });
        $('.go-back').click(function () {
            $('.box-login').show();
            $('.box-forgot').hide();
            $('.box-register').hide();
        });
    };
    
    var runSetDefaultValidation = function () {
        $.validator.setDefaults({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
                    error.appendTo($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: ':hidden',
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error');
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').addClass('has-error');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            }
        });
    };
    var runLoginValidator = function () {
        var form = $('#loginForm');
        //var errorHandler = $('.errorHandler', form);
        form.validate({
            rules: {
                email: {
                    minlength: 2,
                    required: true
                },
                password: {
                    minlength: 6,
                    required: true
                }
            },
            submitHandler: function (form) {
                //errorHandler.hide();
                //form.submit();
				onLoginSubmit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                //errorHandler.show();
            }
        });
    };
    
    var runForgotValidator = function () {
        var form2 = $('.form-forgot');
        
        var errorHandler2 = $('.errorHandler', form2);
        form2.validate({
            rules: {
                email: {
                    required: true
                }
            },
            submitHandler: function (form) {
                errorHandler2.hide();                
                //form2.submit();
                onForgotSubmit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler2.show();
            }
        });
    };
    var runRegisterValidator = function () {
        var form3 = $('#registerForm');
        //var errorHandler3 = $('.errorHandler', form3);
        form3.validate({
            rules: {
            	company: {
                    minlength: 2,
                    required: true
                },
                address1: {
                    minlength: 2,
                    required: true
                },
                city: {
                    minlength: 2,
                    required: true
                },
                state: {
                    minlength: 2,
                    required: true
                },
                country: {
                    minlength: 2,
                    required: true
                },
                postcode: {
                    minlength: 2,
                    required: true
                },
                name: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true
                },
                password: {
                    minlength: 6,
                    required: true
                },
                repassword: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
            },
            submitHandler: function (form) {
                //errorHandler3.hide();
                onCreateSubmit();
                //form3.submit();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                //errorHandler3.show();
            }
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
            //runLoginButtons();
            runSetDefaultValidation();
            runLoginValidator();
            //runForgotValidator();
            runRegisterValidator();
        }
    };
}();

function onCreateSubmit(){
	var form = $('#registerForm');
	form.block({
		overlayCSS: {
			backgroundColor: '#fff'
		},
		message: '<img src="assets/images/ajaxloader.gif" /> Please wait...',
		css: {
			border: 'none',
			color: '#333',
			background: 'none'
		}
	});

	/*var errorHandler = $('.errorHandler', form);
	var errorHandler1 = $('.errorHandler1', form);

	errorHandler.hide();
	errorHandler1.hide();*/
	
	form.ajaxSubmit(function(e){
		if(e=='true'){
			form.unblock();
			window.location.href = baseurl;
		}
		else{
			sweetAlert("Oops...", "Your email was used already!", "error");
			form.unblock();
		}
	});
}


function onLoginSubmit(){
	var form = $('#loginForm');
	form.block({
		overlayCSS: {
			backgroundColor: '#fff'
		},
		message: '<img src="assets/images/ajaxloader.gif" /> Please wait...',
		css: {
			border: 'none',
			color: '#333',
			background: 'none'
		}
	});

	//var errorHandler = $('.errorHandler', form);
	/*var remember = 0;
	
	if($('#remember').is(':checked')){
		remember = 1;
	}	*/

	//errorHandler.hide();
	$.ajax({
		url: baseurl + 'login/ajax_login',
		method: 'POST',
		dataType: 'json',
		data: {
			email: $("#login_email").val(),
			password: $("#login_password").val(),
			//rememberme: remember
		},
		error: function()
		{
			alert("An error occoured!");
			form.unblock();
		},
		success: function(response)
		{
			// Login status [success|invalid]
			var login_status = response.login_status;
			
			// We will give some time for the animation to finish, then execute the following procedures	
			setTimeout(function()
			{
				// If login is invalid, we store the 
				if(login_status == 'invalid')
				{
					//errorHandler.show();
					sweetAlert("Incorrect Account Info!", "Please check your info again", "error");
					form.unblock();
				}
				else if(login_status == 'success')
				{
					form.unblock();
					// Redirect to login page
					setTimeout(function()
					{
						var redirect_url = baseurl + 'index.php?admin';
						
						/*
						if(response.redirect_url && response.redirect_url.length)
						{
							redirect_url = response.redirect_url;
						}
						*/
						
						window.location.href = redirect_url;
					}, 400);
				}
				
			}, 1000);
		}
	});
}

function onForgotSubmit(){
	var form = $('.form-forgot');
	form.block({
		overlayCSS: {
			backgroundColor: '#fff'
		},
		message: '<img src="assets/images/loading.gif" /> 處理中...',
		css: {
			border: 'none',
			color: '#333',
			background: 'none'
		}
	});

	var errorHandler = $('.errorHandler', form);

	errorHandler.hide();
	
	$.ajax({
		url: baseurl + 'login/reset_password',
		method: 'POST',
		dataType: 'json',
		data: {
			email: $("#forgot_email").val(),
		},
		error: function()
		{
			alert("An error occoured!");
			form.unblock();
		},
		success: function(response)
		{
			var result = response;
			
			// We will give some time for the animation to finish, then execute the following procedures	
			setTimeout(function()
			{
				if(result == true)
				{
					form.unblock();
					// Redirect to login page
					setTimeout(function()
					{
						var redirect_url = baseurl + "login";
						
						window.location.href = redirect_url;
					}, 400);
				}
				else{
					errorHandler.show();
					form.unblock();
				}
				
			}, 1000);
		}
	});
}