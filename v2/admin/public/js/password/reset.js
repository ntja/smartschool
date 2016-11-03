/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($){
    $(document).ready(function(){
    	$("#l20").addClass('active');
        if(localStorage.admin_token){
			// if(localStorage.admin_role == "ADMINISTRATOR"){
				
				
				/* Get Current URL */
				var url = $.url();
				
				/* Get id skill from URL */
				user_id = url.segment(-2);
				
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
					window.location.href = root_admin+'/dashboard';
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
				equalTo: "New passwords are different."
            });
            
            // Declaration des variables
            var validation;
            
            // Set rules validation
            $('#edit_user').validate({
				rules: {
					'input_password': {
						required: true
					},
					'input_newpassword': {
						required: true
					},
					'input_confirmation': {
						equalTo: "#input_newpassword"
					}
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
				//console.log(localStorage.admin_id);
                edit_password(localStorage.admin_id);
            }
        } catch (error) {
            console.log(error);
        }
    }
	
	function edit_password(id){
		try{
			var uri, password, new_password, confirmation_password;
			password = $('#input_password').val();
			new_password = $('#input_newpassword').val();
			confirmation_password = $('#input_confirmation').val();
			uri = config.api_url+'/accounts/'+id+'/password';
			data = {
					"password":password,
					"new_password":new_password
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
							//localStorage.clear();
							//window.location.href = root_admin+'/login';
						}
						
					})
					.fail(function(jqXHR, textStatus, errorThrown){
						$("#save_btn").parent().addClass('fail');
						$("#save_btn").parent().removeClass('loading');
						$("#save_btn").parent().removeClass('success');
						
						if(jqXHR.responseJSON.code == 400){
							$('#flash_info').attr('hidden', "hidden");
							$('#flash_info').removeClass('alert-success').addClass('alert-danger');
							$("#msg").text(jqXHR.responseJSON.description);
							$('#flash_info').removeAttr('hidden');
						}else{
							$('#flash_info').attr('hidden', "hidden");
							$('#flash_info').removeClass('alert-success').addClass('alert-danger');
							$("#msg").text("Error : ...");
							$('#flash_info').removeAttr('hidden');
						}
					});
		}catch(error){
			console.log(error);
		}
	}
})(jQuery);