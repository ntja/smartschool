/**
 * Reset password Script
 */

(function($) {
	$(document).ready(function() {
		var params = qs(), uri = config.api_url + '/accounts/reset-password?key='+params.key;
		base_url = $('body').attr('data-base-url');
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'),form = $("#reset-password-form");;
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		console.log(valid_token);
		// if token exists and is valid
        if (user_token && valid_token == true) {
			if(user_role == 'LEARNER'){
				window.location.assign(base_url + '/learner/dashboard');
			}
			if(user_role == 'INSTRUCTOR'){
				window.location.assign(base_url + '/instructor/dashboard');
			}
		}
		//console.log(params.key);
		// Set custom error messages
		$.extend($.validator.messages, {
            required: settings.i18n.translate("validation.1"),
            email: settings.i18n.translate("validation.2"),
			minlength: $.validator.format(settings.i18n.translate("validation.4")),
			equalTo : settings.i18n.translate("validation.5")
        });
        
        form.validate({
            errorElement: 'label',
            //errorClass: 'error',
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
                error.css({'font-size': '0.8em' });     							
            },
            onfocusout: function(element) {
                $(element).valid();
            },
            rules: {
                email: {
                    required: true,
                    email: true
                },
				confirm_password: {
                    required: true,
					equalTo : "#password"
                },
                password: {
                    required: true,
					minlength: 8
                },
				verify_human:{
					required: true,
					number: true
				}
            }
        });

        function validate() {
            return form.valid();
        }
		$('#submit_btn').click(function(e) {
			e.preventDefault();
			// Showing spinner and disable the submit button
			$('#submit_btn').append('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled','disabled');
			if (validate()) {
				password = $('#password').val();
				confirm_password = $('#confirm_password').val();
                data = {
                    "password": password,
					"confirm_password" : confirm_password
                };
				$.ajax({
					url: uri,
					type: "POST",
					contentType: "application/json",
					crossDomain: true,
					dataType: "json",
					data: JSON.stringify(data),
					headers: {
						"x-client-id": "0000",
						"Content-Type": "application/json"
					}
				})
				// if everything is ok
				.done(function(data, textStatus, jqXHR) {
					//var uri;
					$('#reset-password-form').slideUp('slow');
					alertNotify(settings.i18n.translate("reset.password.1"), 'success');
					console.log(data);
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					//if  status code is 400
					if(jqXHR.status == 400){
						var response = JSON.parse(jqXHR.responseText);
						console.info(response.code);
						if(response.code == 4000){
							alertNotify(response.description, 'error');
						}else{
							alertNotify(settings.i18n.translate("error.1"), 'error');
						}
					}else{
						alertNotify(settings.i18n.translate("error.1"), 'error');
					}                   
				}).always(function() {
						$('#submit_btn .loader').fadeOut('slow',function(){$(this).remove()});
						$('#submit_btn').removeAttr('disabled');
					});				
            }else{
                $('#submit_btn .loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit_btn').removeAttr('disabled');
            }
		});				
	});
})(jQuery);