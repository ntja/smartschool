/**
 * Script to get course details using AJAX
 */

(function($) {
    $(document).ready(function() {

        var lesson_id = window.localStorage.getItem('sm_lesson_id'), base_url = $('body').attr('data-base-url');      
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
			window.location.replace($(this).data('href'));
		});		
		// Get lesson detail
		get_lesson_details(lesson_id);
		
		
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
					$('.lesson_title').html(data.title);
					$('.lesson_content').html(data.content);
					if(data.lesson_material.length>0){						
						$('.lesson_video').append('<iframe width="100%" src="'+base_url+'/'+data.lesson_material[0].link+'" style="border:0;" class="video_course"></iframe>')
					}
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
                console.log('request failed !');
			});
		}			
	});
})(jQuery);
