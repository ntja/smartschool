/**
 * Script for log user in using AJAX
 */

(function($){
    $(document).ready(function () {
	//localStorage.removeItem('token');     
        if (!localStorage.admin_token) {
            $('#Signinbtn').click(function () {
                if (!$(this).parent().hasClass('loading')) {
                    // Calling validate_login_form() function. 
                    validate_login_form();
                }
            });
        }else{
            window.location.href = root_admin+'/dashboard';
        }
    });    
    
    // login function through AJAX using JQuery
function login() {        
    var login, password, data, url, token, person_id, rmber_me;
    try {
        email = $("#inputEmail").val();
        password = $("#password").val();
        data = {"email": email, "password": password};            
        url = config.api_url+'/accounts/authenticate';
        $.ajax({
            url: url,
            method: "POST",
            data: JSON.stringify(data),
            headers: {
                "x-client-id": "0000",
                "Content-Type": "application/json",
                "cache-control": "no-cache"
            },
            crossDomain:true,
            dataType:"json"
        })
                // Si les params de connexion sont OK
                .done(function (data, textStatus, jqXHR) {
                    console.log(data);
                    if((data.code == 200)){
                        // And redirection to dashboard page
                        // Icon of success next to the button
                        $('#Signinbtn').parent().removeClass('fail');
                        $('#Signinbtn').parent().removeClass('loading');
                        $('#Signinbtn').parent().addClass('success');

                        // Alert of success
                        $('#error400').attr('hidden', 'hidden');
                        $('#success').attr('hidden', 'hidden');
                        $('#success').removeAttr('hidden');
                        $('#msg_success').html(settings.i18n.translate('login.login.4'));
                        $('body').scrollTop(0);

                        token = data.token;
                        account_id = data.account_id;
                        rmber_me = $("#RmberMe:checked").val();

                        // Si remenber me est check
                        if (rmber_me == 'on') {
                            localStorage.setItem("admin_token", token);
                            localStorage.setItem("admin_renew_token", 1);
                        }

                        //meme si il n'a pas check
                        localStorage.setItem("admin_token", token);
                        localStorage.setItem('admin_id', data.account_id);
						get_user_name(data.account_id);
                        //localStorage.setItem('login', data.login);
                        window.location.href = root_admin+"/dashboard";
                    }
                })

                // Si les params de connexion ne sont pas les bonnes
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log('request failed !');
                    console.log(errorThrown);
                    $('#Signinbtn').parent().removeClass('success');
                    $('#Signinbtn').parent().removeClass('loading');
                    $('#Signinbtn').parent().addClass('fail');
                    console.log(jqXHR);
                    console.log(errorThrown);                    
                    // Login ou mot de passe incorrect
                    if (jqXHR.status == '400') {
                        $("#error400").attr('hidden', 'hidden');
                        $('#success').attr('hidden', 'hidden');
                        $("#error400").removeAttr('hidden');
                        $("#msg_error").html(settings.i18n.translate('login.login.6'));
                        $('body').scrollTop(0);
                    // non-authorized Access
                    if (jqXHR.status == '403') {
                        $("#error400").attr('hidden', 'hidden');
                        $('#success').attr('hidden', 'hidden');
                        $("#error400").removeAttr('hidden');
                        $("#msg_error").html(settings.i18n.translate('login.login.7'));
                        $('body').scrollTop(0);
                    }
                    
                    // Requete invalide
                    if (jqXHR.status == '404') {
                        $("#error400").attr('hidden', 'hidden');
                        $('#success').attr('hidden', 'hidden');
                        $("#error400").removeAttr('hidden');
                        $("#msg_error").html(settings.i18n.translate('login.login.8'));
                        $('body').scrollTop(0);
                    }
                    // Requete invalide
                    if (jqXHR.status == '406') {
                        $("#error400").attr('hidden', 'hidden');
                        $('#success').attr('hidden', 'hidden');
                        $("#error400").removeAttr('hidden');
                        $("#msg_error").html(settings.i18n.translate('login.login.9'));
                        $('body').scrollTop(0);
                    }
                    }
                })
                .always(function () {});
    } catch (error) {
        console(error);
    }
}    

//function to validate login form
function validate_login_form() {
    /*
     *  Validation using Javascript
     */
    try {
        // Set error messages
        $.extend($.validator.messages, {
            required: settings.i18n.translate('login.login.1'),
            minlength: settings.i18n.translate('login.login.2'),
            email: settings.i18n.translate('login.login.3')
        });

        // Declaration des variables
        var validation;

        // Set rules validation
        $('#login_form').validate({
            rules: {
                'inputEmail': {
                    required: true,
                    email:true
                },
                'password': {
                    required: true
                }
            }
        });
        
        validation = $('#login_form').valid();
        // if validation failed
        if(validation == false){
            $('#Signinbtn').parent().addClass('fail');
            $('#Signinbtn').parent().removeClass('success');
            $('#Signinbtn').parent().removeClass('loading');
        }else{
            $('#Signinbtn').parent().addClass('loading');
            $('#Signinbtn').parent().removeClass('success');
            $('#Signinbtn').parent().removeClass('fail');
            
            //calling login() function if validation passed
            login();
        }
    } catch (error) {
        console.log(error);
    }
}

function get_user_name(id){
		try{
			var uri = config.api_url+'/accounts/'+id;
			
			$.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000"
                },
				data: {"section":"settings"},
                method: "GET",
                crossDomain: true
            })
					.done(function(data, textStatus, jqXHR){
						console.log(data);
						localStorage.setItem('admin_name', data.account.last_name);
						
					})
					.fail(function(jqXHR, textStatus, errorThrown){
						
					});
		}catch(error){
			console.log(error);
		}
	}

})(jQuery);