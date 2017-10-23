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
            if(user_role == 'ADMINISTRATOR'){
                window.location.assign(base_url + '/dashboard');
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
                element.after(error);
                error.css({'font-size': '0.8em','color': '#f56954' });     							
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
                "password": password
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
				if (data.role == "ADMINISTRATOR") {
					alertNotify(settings.i18n.translate("login.2"), 'success');
					console.log(data);
					window.localStorage.setItem('sm_user_role', data.role);
					window.localStorage.setItem('sm_user_id', data.account_id);
					window.localStorage.setItem('sm_user_token', data.token);	
					uri = base_url + '/dashboard';
					setTimeout(function(){
						window.location.assign(uri);
					},1000);   
				 }else{
					alertNotify(settings.i18n.translate("login.3"), 'error');
				 }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                //if  status code is 400
                if(jqXHR.status == 400){
                        var response = JSON.parse(jqXHR.responseText);
                        console.info(response);
                        for(i=0;i<response.length; i++){                            
							if(response[i].code == 4000){
								alertNotify(settings.i18n.translate("login.4"), 'error');
							}else if(response[i].code == 4004){
								alertNotify(settings.i18n.translate("login.5"), 'error');
							}else if(response[i].code == 4002 || response[i].code == 4003){
								alertNotify(settings.i18n.translate("login.3"), 'error');
							}
							else{
								alertNotify(settings.i18n.translate("error.1"), 'error');
							}
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
