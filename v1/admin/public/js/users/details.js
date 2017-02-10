/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($){
    $(document).ready(function(){
    	$("#l2").addClass('active');
        if(localStorage.admin_token){
			/* Get Current URL */
			var url = $.url();
			
			/* Get id user profile from URL */
			user_id = url.segment(-1);
			
			get_user(user_id);
			
        }else{
            // Redirection vers la page de login
            window.location.href = root_admin + '/login';
        }
    });
       
	
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
				data: {"section":"settings"},
                method: "GET",
                crossDomain: true
            })
            .done(function(data, textStatus, jqXHR){
                    console.log(typeof data.account);
                    $('#user_firstname').text(data.account.first_name);
                    $('#user_lastname').text(data.account.last_name);
                    $('#user_role').text(data.account.role);
                    if(typeof data.account.photo != "object"){
                        $('#user_img').attr('src', data.account.photo);
                    }else{                        
                        $('#user_img').attr('src', "http://sw.ai/staging/squirrel/view/public/images/avatar.png");
                    }
                    $('#user_img').attr('height', "100px");
                    $('#user_img').attr('width', "100px");
                    $('#user_email').text(data.account.email);

                    if(data.account.active_status == "ACTIVE"){
                            $('#user_status').html('<span class="label label-success">'+data.account.active_status+'</span>');
                    }else if(data.account.active_status == "DISABLED"){
                            $('#user_status').html('<span class="label label-default">'+data.account.active_status+'</span>');
                    }

            })
            .fail(function(jqXHR, textStatus, errorThrown){

            });
        }catch(error){
                console.log(error);
        }
    }
})(jQuery);