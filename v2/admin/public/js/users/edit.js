/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($){
    $(document).ready(function(){
    	$("#l2").addClass('active');
        if(localStorage.admin_token){
			// if(localStorage.admin_role == "ADMINISTRATOR"){				
				/* Get Current URL */
				var url = $.url();
				
				/* Get id skill from URL */
				user_id = url.segment(-2);
				
				/* Get skill info */
				get_user(user_id);
				
				/* Get campaign info */
				$("#save_btn").click(function(){
					
					$(this).parent().addClass('loading');
					$(this).parent().removeClass('success');
					$(this).parent().removeClass('fail');
					if($(this).parent().hasClass('loading')){
						validate_form();
					}
				});
				
				$("#cancel").click(function(){
					window.location.href = root_admin+'/users';
				});
			// }else{
				// // Redirection vers la page de login
				// window.location.href = root_admin + '/dashboard';
			// }
        }else{
            // Redirection vers la page de login
            window.location.href = root_admin + '/login';
        }
    });
	
	function validate_form() {
        /*
         *  Validation using Javascript
         */
        try {
            // Set error messages
            $.extend($.validator.messages, {
                required: 'Required field',
				email: 'invalid email'
            });
            
            // Declaration des variables
            var validation;
            
            // Set rules validation
            $('#edit_user').validate({
				rules: {
					'input_firstname': {
						required: true
					},
					'input_lastname': {
						required: true
					},
					'input_email': {
						email: true,
						required: true
					},
				}
            });
            
            validation = $('#edit_user').valid();
            
            if(validation == false){
                $('#save_btn').parent().addClass('fail');
                $('#save_btn').parent().removeClass('success');
                $('#save_btn').parent().removeClass('loading');
            }else{
                $('#save_btn').parent().addClass('loading');
                $('#save_btn').parent().removeClass('success');
                $('#save_btn').parent().removeClass('fail');
                edit_user(user_id);
            }
        } catch (error) {
            console.log(error);
        }
    }
	
	
	function get_user(id){
		try{
			var uri = config.api_url+'/accounts/'+id;
			
			$.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000"
                },
				data:{"section":"settings"},
                method: "GET",
                crossDomain: true
            })
					.done(function(data, textStatus, jqXHR){
						console.log(data);
						$('#input_firstname').attr('value', data.account.first_name);
						$('#input_lastname').attr('value', data.account.last_name);
						$('#input_email').attr('value', data.account.email);
						// $('#objective').html('<b> '+data.objective+'</b>');
						// $('.pub_name').text(data.name);
					})
					.fail(function(jqXHR, textStatus, errorThrown){
						
					});
		}catch(error){
			console.log(error);
		}
	}
	
	function edit_user(id){
		try{
			var uri, firstname, lastname, email;
			firstname = $('#input_firstname').val();
			lastname = $('#input_lastname').val();
			email = $('#input_email').val();
			uri = config.api_url+'/accounts/'+id+'/profile';
			data = {
				"type":"settings",
				"entries":[
					[
						{
							"field":"first_name",
							"value":firstname
						},
						{
							"field":"last_name",
							"value":lastname
						},
						{
							"field":"email",
							"value":email
						}
					]
				]
			};
			console.log(data);
			$.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000",
					"Content-Type": "application/json"
                },
                method: "POST",
				data:JSON.stringify(data),
                crossDomain: true
            })
					.done(function(data, textStatus, jqXHR){
						console.log(data);
						if(data.code == 200){
							$("#save_btn").parent().addClass('success');
							$("#save_btn").parent().removeClass('loading');
							$("#save_btn").parent().removeClass('fail');
							
							$('#flash_info').attr('hidden', "hidden");
							$('#flash_info').removeClass('alert-danger').addClass('alert-success');
							$("#msg").text(settings.i18n.translate('setting.item.1'));
							$('#flash_info').removeAttr('hidden');
							
							// Redirection vers la page
							window.location.href = root_admin+'/users';
						}
						
					})
					.fail(function(jqXHR, textStatus, errorThrown){
						$("#save_btn").parent().addClass('fail');
						$("#save_btn").parent().removeClass('loading');
						$("#save_btn").parent().removeClass('success');
						
						if(jqXHR.responseJSON.code == 400 && jqXHR.responseJSON.description =="Currency alraidy exist"){
							$('#flash_info').attr('hidden', "hidden");
							$('#flash_info').removeClass('alert-success').addClass('alert-danger');
							$("#msg").text("Erreur : Cette devise existe déjà.");
							$('#flash_info').removeAttr('hidden');
						}else{
							$('#flash_info').attr('hidden', "hidden");
							$('#flash_info').removeClass('alert-success').addClass('alert-danger');
							$("#msg").text("Erreur : ...");
							$('#flash_info').removeAttr('hidden');
						}
					});
		}catch(error){
			console.log(error);
		}
	}
})(jQuery);