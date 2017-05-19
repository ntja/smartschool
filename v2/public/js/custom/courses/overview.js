/**
 * Script to get course details using AJAX
 */

(function($) {
    $(document).ready(function() {

        var course_details = null, course_id = $('section').data('course_id'), base_url = $('body').attr('data-base-url');      
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
		//Get course details
		course_details = get_course_details(course_id);	
		$('#course_title').prepend("<h2><strong>"+course_details.name+"</strong></h2>");		
		$('.summary').append(course_details.shortdescription);
		$('.language').html(course_details.language);
                if(course_details.course_category){
                    $('.subject').html(course_details.course_category.name);
                }		
		$('.length').html(course_details.expected_duration);
		$('.level').html(course_details.targetaudience);
		
		/*		
		for(i=0;i < course_details.section.length;i++){
			html += '<h3 class="chapter_course no_margin_rop">'+course_details.section[i].title+'</h3>';
			html += '<div class="strip_single_course">';
			html += '<h4><a href="course_detail_page_txt.html">Lorem ipsum dolor sit amet, case saepe impetus sed ut.</a></h4>';
			html += '<ul><li><i class="icon-clock"></i> 00:58</li><li><i class="icon-doc"></i>Text reading</li></ul>';
            html += '</div>';
		}	
		*/
		//$('#course_content').html(html);
		get_section_details(course_details.id, course_id);
		
		//get user information
		var user = get_user_details(user_id, user_token);
		if(user ){
			//$('.user_name').html(user.first_name+' '+user.last_name);
			//var photo = (user.photo == 'null' | user.photo == '')?'img/avatar.jpeg':user.photo;
			//$('.photo').attr('src', photo);
		}
		
		// click on enroll button
		$('.enroll').on('click', function(){
			if(!valid_token){
				window.location.assign(base_url + '/login?return_url='+base_url+'/course/'+course_id);
			}
			$('.enroll').append('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled','disabled');
			join_course(user_id, user_token,course_details.id);
		});
		
		$('body').delegate('.lesson_title', 'click',function(){
			console.log($(this).data('lesson_id'));
			window.localStorage.setItem('sm_lesson_id',$(this).data('lesson_id'))
			window.location.replace($(this).data('href'));
		});
		
		//get section information
		function get_section_details(course_id, course_shortname){		
			var result = null;
			$.ajax({
				url: config.api_url + "/courses/"+course_id+"/sections",
				method: "GET",
				headers: {
					"x-client-id": "0000",
					"Content-Type": "application/json",
					"cache-control": "no-cache"
				},
				async:true
			})
			.done(function (data, textStatus, jqXHR) {
				console.log(data.data);
				//console.log(data.valid == false);
				if(data.data.length ==0){
					var html = "<h3>"+settings.i18n.translate("course.overview.1")+" <a href='"+base_url+"/courses/catalog'>"+settings.i18n.translate("course.overview.2")+"</a></h3>";
				}else{
					var html = "";
					for(i=0; i < data.data.length; i++){
						//if section has at least one lesson show it
						if(data.data[i].lessons.length>0){
							k = i+1;
							html += '<h3 class="chapter_course">'+data.data[i].title+'<small class="pull-right">'+data.data[i].lessons.length+' lesson (s)</small></h3>';
							for(j=0;j < data.data[i].lessons.length;j++){
								html += '<div class="strip_single_course">';
								html += '<h4><a class="lesson_title" href="javascript:void(0);" data-href="'+base_url+'/course/'+course_shortname+'/'+data.data[i].lessons[j].slug_title+'" data-lesson_id="'+data.data[i].lessons[j].id+'">'+data.data[i].lessons[j].title+'</a></h4>';
								html += '<ul><li><i class="icon-clock"></i> 00:00</li><li><i class="icon-doc"></i>Text reading</li></ul>';
								html += '</div>';
							}
                        }
					}
				}
				
				$('#course_content').html(html);
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
                console.log('request failed !');
			});
		}
		
		//get course information
		function get_course_details(id){		
			var result = null;
			$.ajax({
				url: config.api_url + "/courses/"+id,
				method: "GET",
				headers: {
					"x-client-id": "0000",
					"Content-Type": "application/json",
					"cache-control": "no-cache"
				},
				crossDomain:true,
				async:false
			})
			.done(function (data, textStatus, jqXHR) {
                            console.log(data);
                            result = data;		
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
			return  result;
		}
		
		function join_course(user_id, user_token, course_id){		
			var result = null;
			var sudoNotify = $('.notification-container').sudoNotify({				
			  log: false, 			  
			  // custom styles for succsee notification bar
			  successStyle: { 
				color: '#ffffff',
				fontWeight:700,
				backgroundColor: '#30d9a4'
			  }
			});
			$.ajax({
				url: uri = config.api_url + "/courses/"+course_id+"/join",
				method: "POST",
				headers: {
					"x-client-id": "0000",
					"Content-Type": "application/json",
					"cache-control": "no-cache",
					"x-access-token" : user_token
				},
				crossDomain:false,
				async:true
			})
			.done(function (data, textStatus, jqXHR) {
				sudoNotify.success(settings.i18n.translate("course.overview.3")); 
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			})
			.always(function() {
				$('.enroll .loader').fadeOut('slow',function(){$(this).remove()});
				$('.enroll').removeAttr('disabled');
			});
			//return  result;
		}

	});
})(jQuery);
