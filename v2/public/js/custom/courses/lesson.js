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
		
		$('.next').on('click',function(){			
			console.info($("#main_content").data('course_id'));
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
					
					//if next lesson exists for this section
					if(data.next_course){
						$('.next').removeClass("hide");
						$('.next').on('click',function(){
							course = $("#main_content").data('course_id');
							console.info(course);							
							window.location.assign(base_url+'/course/'+course+'/'+data.next_course.slug_title);
						});
					}
					// if previous lesson exists for this section
					if(data.prev_course){
						$('.prev').removeClass("hide");
						$('.prev').on('click',function(){
							course = $("#main_content").data('course_id');							
							window.location.assign(base_url+'/course/'+course+'/'+data.prev_course.slug_title);
						});						
					}
					if(data.lesson_material.length>0){
						if(data.lesson_material[0].extension !== "pdf"){
							var html = '<video id="player" controls="controls" class="mejs__player" data-mejsoptions=\'{"alwaysShowControls": "true"}\'><source src="'+base_url+'/'+data.lesson_material[0].link+'" /></video>';
								$('.lesson_video').append(html);
								//call video lecturer
								mediaelement();
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

		function mediaelement(){
			$('#player').mediaelementplayer({
				// if the <video width> is not specified, this is the default
				defaultVideoWidth: '99%',
				// if the <video height> is not specified, this is the default
				defaultVideoHeight: 450,
				// if set, overrides <video width>
				videoWidth: -1,
				// if set, overrides <video height>
				videoHeight: -1,
				// width of audio player
				audioWidth: 400,
				// height of audio player
				audioHeight: 30,
				// initial volume when the player starts
				startVolume: 0.8,
				// useful for <audio> player loops
				loop: false,
				// enables Flash and Silverlight to resize to content size
				enableAutosize: true,
				// the order of controls you want on the control bar (and other plugins below)
				features: ['playpause','progress','current','duration','tracks','volume','fullscreen','backlight','googleanalytics'],
				// automatically create these translations on load
				translations:['es','ar','fr'],
				// Hide controls when playing and mouse is not over the video
				alwaysShowControls: false,
				// force iPad's native controls
				iPadUseNativeControls: false,
				// force iPhone's native controls
				iPhoneUseNativeControls: false, 
				// force Android's native controls
				AndroidUseNativeControls: false,
				// forces the hour marker (##:00:00)
				alwaysShowHours: false,
				// show framecount in timecode (##:00:00:00)
				showTimecodeFrameCount: false,
				// used when showTimecodeFrameCount is set to true
				framesPerSecond: 25,
				// turns keyboard support on and off for this instance
				enableKeyboard: true,
				// when this player starts, it will pause other players
				pauseOtherPlayers: true,
				// array of keyboard commands
				keyActions: []					 
			});
		}
	});
})(jQuery);
