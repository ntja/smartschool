/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($){
    $(document).ready(function(){
    	$("#l5").addClass('active');
    	$("#l17").addClass('active');
        if(localStorage.admin_token){
			// if(localStorage.admin_role == "ADMINISTRATOR"){				
				/* Get Current URL */
				var url = $.url();
				
				/* Get id skill from URL */
				jobID = url.segment(-1);
				
				/* Get skill info */
				get_job(jobID);
				
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
					window.location.href = root_admin+'/settings/education-minors';
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
                required: 'Champ requis',
            });
            
            // Declaration des variables
            var validation;
            
            // Set rules validation
            $('#edit_job').validate({
				rules: {
					'input_name': {
						required: true
					}
				}
            });
            
            validation = $('#edit_job').valid();
            
            if(validation == false){
                $('#save_btn').parent().addClass('fail');
                $('#save_btn').parent().removeClass('success');
                $('#save_btn').parent().removeClass('loading');
            }else{
                $('#save_btn').parent().addClass('loading');
                $('#save_btn').parent().removeClass('success');
                $('#save_btn').parent().removeClass('fail');
                edit_skill(jobID);
            }
        } catch (error) {
            console.log(error);
        }
    }
	
	
	function get_job(id){
		try{
			var uri = config.api_url+'/education-minors/'+id;
			
			$.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000"
                },
                method: "GET",
                crossDomain: true
            })
					.done(function(data, textStatus, jqXHR){
						console.log(data);
						$('#input_name').attr('value',data.name);
						// $('#objective').html('<b> '+data.objective+'</b>');
						// $('.pub_name').text(data.name);
					})
					.fail(function(jqXHR, textStatus, errorThrown){
						
					});
		}catch(error){
			console.log(error);
		}
	}
	
	function edit_skill(id){
		try{
			var uri, name;
			name = $('#input_name').val();
			uri = config.api_url+'/education-minors/'+id;
			data = {"name":name};
			$.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000",
					"Content-Type": "x-www-url-formurlencoded"
                },
                method: "PUT",
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
							window.location.href = root_admin+'/settings/education-minors';
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