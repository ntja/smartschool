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
		
		function facebook_login() {
            try {

                FB.login(function(response) {
                    var token;
                    console.log(response);
                    if (response.authResponse) {
                        token = response.authResponse.accessToken;
                        console.log(token);

                        var url = config.api_url + "/accounts/social-login";
                        var data = {"network": "facebook", "network_token": token};
                        $.ajax({
                            url: url,
                            method: "POST",
                            headers: {
                                "content-type": "application/json"
                            },
                            data: JSON.stringify(data),
                            crossDomain: true
                        })
                                .done(function(data, jqXHR, textStatus) {
                                    console.info(data);
                                    if (data.logged == false) {  // if user does not have an account yet
                                        window.localStorage.setItem('email', data.email);
                                        window.localStorage.setItem('social_id', data.social_id);
                                        window.localStorage.setItem('first_name', data.first_name);
                                        window.localStorage.setItem('last_name', data.last_name);
                                        window.localStorage.setItem('facebook_id', data.facebook_id);
                                        uri = base_url + '/complete-registration';
                                        window.location.assign(uri);
                                    } else if (data.logged == true) {
                                        login(data);
                                    }

                                })
                                .fail(function(jqXHR, textStatus, errorThrown) {
									showAlert('This account has been suspended. Please contact the Administrator', false);
									return;
                                    console.log(jqXHR);
                                    console.log(errorThrown);
                                });

                    } else {
                        console.log('User canceled login or he is not fully authorized.');
                    }
                }, {
                    scope: 'email',
                    return_scopes: true
                });
            } catch (error) {
                console.log(error);
            }
        }
        function google_authenticate(network_code) {
            var token = network_code;
            $(document).ready(function() {
                //console.error(token);
                if (token) {
                    var url = config.api_url + "/accounts/social-login";
                    var data = {"network": "google", "network_token": token};
                    $.ajax({
                        url: url,
                        method: "POST",
                        headers: {
                            "content-type": "application/json"
                        },
                        data: JSON.stringify(data),
                        crossDomain: true
                    })
                            .done(function(data, jqXHR, textStatus) {
                                console.log(data);
                                if (data.logged == false) { // if user does not have an account yet
                                    window.localStorage.setItem('email', data.email);
                                    window.localStorage.setItem('social_id', data.social_id);
                                    window.localStorage.setItem('first_name', data.first_name);
                                    window.localStorage.setItem('last_name', data.last_name);
                                    window.localStorage.setItem('google_id', data.google_id);
                                    uri = base_url + '/complete-registration';
                                    window.location.assign(uri);
                                } else if (data.logged == true) {
                                    console.info("enter here");
                                    login(data);
                                }
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
								console.log(jqXHR);
								console.log(errorThrown);
								var response = JSON.parse(jqXHR.responseText);
								console.info(response);
								if(response.code == 4000){
									showAlert(response.description, false);
								}else{
									showAlert("An error occurred. Please try again later", false);
								}
								return;
                            });
                } else {
                    console.log('User cancelled  login process or he is not fully authorized.');
                }
            });
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
		
		$("#google-login").click(function(e){            
			 e.preventDefault();
			 $('.alert-container .close').parent().css('display', 'none');
			 console.info($('.login').data("network"));
			 google_authenticate($('.login').data("network"));
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
                },2000);  
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
