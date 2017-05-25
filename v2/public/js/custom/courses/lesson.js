/**
 * Script to get course details using AJAX
 */

(function($) {
    $(document).ready(function() {

        var /*lesson_id = window.localStorage.getItem('sm_lesson_id'),*/ base_url = $('body').attr('data-base-url');      
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
        var valid_token = check_token_validity(user_token);
        //console.log(valid_token);
        // if token exists and is valid
        if (user_token && valid_token == true) {
            if(user_role == 'LEARNER'){
                    $(".connect-register").html("<a class='button_top' href='"+base_url+"/learner/dashboard'>Return to Dashboard</a>");
            }
            if(user_role == 'INSTRUCTOR'){
                    $(".connect-register").html("<a class='button_top' href='"+base_url+"/instructor/dashboard'>Return to Dashboard</a>");
            }
        }
		$('body').delegate('.lesson_title', 'click',function(){			
			//get_lesson_details($(this).data('lesson_id'));
			window.localStorage.setItem('sm_lesson_id',$(this).data('lesson_id'))
			window.location.assign($(this).data('href'));
		});
		/* Get Current URL */
        var uri = $.url();
        /* Get a segment from URL */
        last_segment = uri.segment(-1);
		console.log(last_segment);
		
		//update breadcrumb
		$('.breadcrumb').append('<li class="active">'+last_segment+'</li>');
		
		// Get lesson detail
		get_lesson_details(last_segment);
		
		
		function get_lesson_details(lesson_id){		
			var result = null;
			$.ajax({
				url: config.api_url + "/courses/lessons/"+lesson_id,
				method: "GET",
				headers: {
					"x-client-id": "0000",
					"Content-Type": "application/json",
					"cache-control": "no-cache"
				}
			})
			.done(function (data, textStatus, jqXHR) {				
				//console.log(data.valid == false);
				if(data){
					$('.lesson_center_title').html(data.title);
					$('.lesson_content').html(data.content);
					if(data.lesson_material.length>0){
						if(data.lesson_material[0].extension == "mp4"){
								$('.lesson_video').append('<video width="100%" height="100%" controls="controls" class="mejs__player" data-mejsoptions=\'{"alwaysShowControls": "true"}\'><source src="'+base_url+'/'+data.lesson_material[0].link+'" /></video>');
						}else{
							$('.lesson_video').addClass('myIframe').append('<iframe scrolling="yes" class="mejs-player" src="'+base_url+'/'+data.lesson_material[0].link+'?rel=0" frameborder="0" allowfullscreen></iframe>');
						}
						//$('video').attr('autoplay',false);						

					}
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
                //console.log(jqXHR);
				if(jqXHR.status == 400){
					window.location.assign(base_url+'/courses/catalog');
				}
			});
		}			
	});
})(jQuery);
