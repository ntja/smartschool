/**
 * Script for registering user in using AJAX
 */

(function($) {
    $(document).ready(function() {
		//window.localStorage.clear();
        var form, base_url, role;
        form = $("#register-form");
        base_url = $('body').attr('data-base-url');
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		console.log(valid_token);
		// if token exists and is valid
        if (user_token && valid_token == true) {
			if(user_role == 'LEARNER'){
				//window.location.assign(base_url + '/learner/dashboard');
				$(".connect-register").html("<a class='button_top' href='"+base_url+"/learner/dashboard'>Return to Dashboard</a>");
			}
			if(user_role == 'INSTRUCTOR'){
				//window.location.assign(base_url + '/instructor/dashboard');
				$(".connect-register").html("<a class='button_top' href='"+base_url+"/instructor/dashboard'>Return to Dashboard</a>");
			}
		}
		// Set custom error messages
        $.extend($.validator.messages, {
            required: settings.i18n.translate("validation.1"),
            email: settings.i18n.translate("validation.2"),
			number: settings.i18n.translate("validation.3"),
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
				first_name: {
                    required: true
                },
				last_name: {
                    required: true
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
            },
			highlight: function(element, errorClass, validClass) {
				console.info(validClass);
				$(element).addClass(errorClass).removeClass(validClass);
				//$(element.form).find("id=" + element.id).addClass(errorClass);
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
			console.log($('#email').val());
            if (validate()) {
                var url, email, password, data;
                url = config.api_url + '/accounts';
                email = $('#email').val();
                password = $('#password').val();
				first_name = $('#first_name').val();
				last_name = $('#last_name').val();
				human_verification = $('#verify_human').val();
				
                data = {
                    "email": email,
                    "password": password,
					"first_name" : first_name,
					"last_name" : last_name,
					"human_verification" : human_verification,
					"role" : "LEARNER"
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
					$('#register-form').slideUp('slow');
					html = "<div class='alert alert-success' role='alert'><span class='fa fa-check fa-lg'> </span>";
					html += settings.i18n.translate("register.1")+"  <strong>"+first_name+" </strong>"+settings.i18n.translate("register.2")+"<br>";
					html += settings.i18n.translate("register.3")+"</div>";
					$('.login').append(html);
                    //alertNotify("Well done ! Your account has been successfully created", 'success');                    
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
					//if  status code is 400
					if(jqXHR.status == 400){
						var response = JSON.parse(jqXHR.responseText);
						console.info(response.code);
						if(response.code == 4001){
							alertNotify(settings.i18n.translate("register.4"), 'error');
						}
						else if(response.code == 4000){
							alertNotify(settings.i18n.translate("register.5"), 'error');
						}
						else if(response.code == 4003){
							alertNotify(settings.i18n.translate("error.2"), 'error');
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
