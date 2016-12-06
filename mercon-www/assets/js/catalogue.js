var Catalogue = function () {

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
    var runCatalogueValidator = function () {
        var form = $('#catalogueForm');
        var errorHandler = $('#formError', form);
        var successHandler = $('#formSuccess', form);
        var stateHandler = $('#stateError');
        form.validate({
            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                email: {
                    minlength: 2,
                    required: true,
                    email: true
                }
            },
            submitHandler: function (form) {
                errorHandler.hide();
                successHandler.hide();
                stateHandler.hide();
                //form.submit();
                submitCatalogueRequest();
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                errorHandler.show();
            }
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
            runSetDefaultValidation();
            runCatalogueValidator();
        }
    };
}();

function submitCatalogueRequest() {
    var form = $('#catalogueForm');
    form.block({
        overlayCSS: {
            backgroundColor: '#fff'
        },
        message: '<img src="' + baseurl + '/assets/images/ajaxloader.gif" /> Please wait...',
        css: {
            border: 'none',
            color: '#333',
            background: 'none'
        }
    });

    var errorHandler = $('#formError', form);
    var successHandler = $('#formSuccess', form);
    $('#stateError').hide();
    errorHandler.hide();
    successHandler.hide();

    var newsletter = 0;

    if ($('#newsletter').is(':checked')) {
        newsletter = 1;
    }

    $.ajax({
        url: baseurl + 'index.php?catalogue/send_request',
        method: 'POST',
        dataType: 'json',
        data: {
            email: $("#email").val(),
            name: $("#name").val(),
            newsletter: newsletter
        },
        error: function ()
        {
            errorHandler.show();
            form.unblock();
        },
        success: function (response)
        {
            var result = response;

            // We will give some time for the animation to finish, then execute the following procedures	
            setTimeout(function ()
            {
                if (result == true)
                {
                    form.unblock();
                    successHandler.show();
                    successHandler.removeClass('hidden');
                    // Redirect to login page
                    setTimeout(function ()
                    {
                        $('#catalogueForm')[0].reset();
                        successHandler.hide(5000);
                    }, 10000);
                } else {
                    errorHandler.show();
                    form.unblock();
                    setTimeout(function ()
                    {
                        errorHandler.hide(3000);
                    }, 10000);
                }

            }, 1000);
        }
    });
}