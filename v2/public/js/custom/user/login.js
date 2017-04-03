/**
 * Script for log in user in using AJAX
 */

(function($) {
    $(document).ready(function() {

        var form, base_url, role;
        form = $("#login-form");
        base_url = $('body').attr('data-base-url');
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token');
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
		// Set custom error messages
        $.extend($.validator.messages, {
            required: settings.i18n.translate("validation.1"),
            email: settings.i18n.translate("validation.2"),
			number: settings.i18n.translate("validation.3")
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
                password: {
                    required: true
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
		//When user clcik on login button
		$('#submit_btn').click(function(e) {
            e.preventDefault();
			// Showing spinner and disable the submit button
			$('#submit_btn').append('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled','disabled');
			//console.log($('#email').val());
            if (validate()) {
                var url, email, password, data;
                url = config.api_url + '/accounts/authenticate';
                email = $('#email').val();
                password = $('#password').val(); 
				human_verification = $('#verify_human').val();
                data = {
                    "email": email,
                    "password": password,
					"human_verification" : human_verification,					
                };
                console.log(data);
                //console.log(JSON.stringify(data))                
                $.ajax({
                    url: url,
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
                    var uri;
					var return_url = qs().return_url;
                    alertNotify(settings.i18n.translate("login.2"), 'success');
                    console.log(data);
                    window.localStorage.setItem('sm_user_role', data.role);
					window.localStorage.setItem('sm_user_id', data.account_id);
					window.localStorage.setItem('sm_user_token', data.token);
					if(return_url){
						uri = return_url;
					}
					else if (data.role == "INSTRUCTOR") {                        
                        uri = base_url + '/instructor/dashboard';
                    } else if (data.role == "LEARNER"){
                        uri = base_url + '/learner/dashboard';
                    }
					//$('#login-form').slideUp('slow')
					//$('#signin')[0].reset();
                    setTimeout(function(){
                        window.location.assign(uri);
                    },1000);  
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
					//if  status code is 400
					if(jqXHR.status == 400){
						var response = JSON.parse(jqXHR.responseText);
						console.info(response.code);
						if(response.code == 4000){
							alertNotify(settings.i18n.translate("login.4"), 'error');
						}else if(response.code == 4004){
							alertNotify(settings.i18n.translate("login.5"), 'error');
						}else if(response.code == 4002 || response.code == 4003){
							alertNotify(settings.i18n.translate("login.3"), 'error');
						}
						else{
							alertNotify(settings.i18n.translate("error.1"), 'error');
						}
					}else{
						alertNotify(settings.i18n.translate("error.1"), 'error');
					}                   
                })
				.always(function() {
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
