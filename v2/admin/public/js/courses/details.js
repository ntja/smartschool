/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($){
    $(document).ready(function(){
    	$("#l3").addClass('active');
        if(localStorage.admin_token){
			/* Get Current URL */
			var url = $.url();
			
			/* Get id user profile from URL */
			cmp_id = url.segment(-1);
			
			get_company(cmp_id);
			get_company_job(cmp_id);
			
        }else{
            // Redirection vers la page de login
            window.location.href = root_admin + '/login';
        }
    });
       
	
	function get_company(id){
		try{
			var uri = config.api_url+'/companies/'+id;
			
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
                    $('#cmp_empl_name').html('<a href="'+root_admin+'/users/'+data.employer_id+'" alt="">'+data.employer_last_name+'</a>');
                    $('#cmp_empl_position').text(data.employer_position);
                    $('#cmp_name').text(data.company_name_name);
                    $('#cmp_mobile_number').text(data.phone_number);
                    $('#cmp_mailing_address').text(data.mailing_address);
                    $('#cmp_fax_number').text(data.fax_number);
                    $('#cmp_description').text(data.description);
                    $('#cmp_img').html(data.logo!=""?'<img src="'+data.logo+'" alt="logo" width="50px" height="50px">':"No logo found");
                    $('#cmp_email').text(data.email);
                    //$('#cmp_video').html('<video src="'+data.video+'"></video>');
                    $('#cmp_video').html(data.video);

                    $('#cmp_name_1').text(data.company_name_name);
                    $('#jobs').attr('href', root_admin+'/companies/'+id+'/jobs');

                    if(data.status == "PENDING"){
                            $('#cmp_status').html('<span class="label label-default">'+data.status+'</span>');
                    }else{
                            $('#cmp_status').html('<span class="label label-success">'+data.status+'</span>');
                    }

            })
            .fail(function(jqXHR, textStatus, errorThrown){

            });
		}catch(error){
			console.log(error);
		}
	}
	
	function get_company_job(id){
		try{
			var uri = config.api_url+'/companies/'+id+'/jobs';
			
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
				
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				
			});
		}catch(error){
			console.log(error);
		}
	}
})(jQuery);