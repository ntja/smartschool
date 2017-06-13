/**
 * Script for manage instructor courses
 */

(function($) {
    $(document).ready(function() {

        var form, role, user_courses = null;  
		form = $("#create-course-form");
		var edit_form = $("#edit-course-form");
        //base_url = $('body').attr('data-base-url');		
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var limit = 10, course_id=null;
		var sudoNotify = $('.notification-container').sudoNotify({				
		  log: false, 			  
		  // custom styles for succsee notification bar
		  successStyle: { 
			color: '#ffffff',
			fontWeight:700,
			backgroundColor: '#30d9a4'
		  }
		});
		var uri = config.api_url + "/accounts/"+user_id+"/courses?limit="+limit;
		console.log(uri);
		/*
		var valid_token = check_token_validity(user_token);
		// if token exists and is valid
        if (!user_token || valid_token == false) {						
			window.location.assign(base_url + '/login');
		}
		//When user clcik on logout button
		$('.logout').click(function(e) {
            e.preventDefault();
			logout();
		});
		
		//Get user details
		user_detail = get_user_details(user_id, user_token);
		console.info(user_detail);
		
		if(user_detail){
			$('#user_name').empty().html(user_detail.first_name);
		}
		*/
		if(user_role !== "INSTRUCTOR"){
			logout();
		}
		
		// get course categories
		get_course_categories(user_token);
		
		form.validate({
			ignore: [],
            errorElement: 'label',
            //errorClass: 'error',
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
                error.css({'font-size': '0.8em' });     							
            },
            onfocusout: function(element) {
                $(element).valid();
            },
            rules: {
                course_title: {
                    required: true
                },
                short_name: {
                    required: true
                },
				course_format:{
					required: true
				},
				target_audience: {
                    required: true
                },
				category_list: {
                    required: true
                },
				language: {
                    required: true
                },
				course_description: {
                    required: function(){
						CKEDITOR.instances.course_description.updateElement();
					}
               }
            }
        });				
		
		var language, category_list, course_format,target_audience;
		// create course dropdowns
		$('#course_format').change(function() {
            course_format = $(this).val();            
        });
		$('#language').change(function() {
            language = $(this).val();            
        });
        $('#target_audience').change(function() {
            target_audience = $(this).val();           
        });
		$('#category_list').change(function() {
            category_list = $(this).val();            
        });
		
        function validate() {
            return form.valid();
        }				
		
		//When user clcik on create course button
		$('#submit_btn').click(function(e) {
            e.preventDefault();
			// Showing spinner and disable the submit button
			$('#submit_btn').append('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled','disabled');
			//console.log($('#email').val());
            if (validate()) {
                var url, course_title, short_name,course_description, data;
				
                url = config.api_url + '/courses';
                course_title = $('#course_title').val();
                short_name = $('#short_name').val();    
				//course_format = $('#course_format').val();
				//target_audience = $('#target_audience').val();
				//category_list = $('#category_list').val();
				course_title = $('#course_title').val();
				course_description = CKEDITOR.instances.course_description.getData(); //= $('#course_description').val();
                data = {
                    "name": course_title,
                    "shortname": short_name,
					"courseformat": course_format,
					"targetaudience": target_audience,
					"category": category_list,
					"language": language,
					"shortdescription": course_description,
					"instructor": user_id
                };
                console.log(data);
                //console.log(JSON.stringify(data))                
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: "application/json",
                    crossDomain: true,
                    dataType: "json",
                    data: JSON.stringify(data),
                    headers: {
                        "x-client-id": "0000",
                        "Content-Type": "application/json",
						"x-access-token": user_token
                    }
                })
                // if everything is ok
                .done(function(data, textStatus, jqXHR) {					
                    //$('#close').trigger('click');
					form[0].reset();
					//form.slideUp('fast');
					$('#close_create_modal').trigger('click');
					$('#submit_btn').hide();
                    //alertNotify("Well done ! Your course has been successfully created. <br> Click on the following link to <a href='#'>add your first lesson</a>", 'success');
                    sudoNotify.success(settings.i18n.translate("instructor.course.1"));
					console.log(data);                    
					get_instructor_courses(user_id, user_token, uri);					                   
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
					//if  status code is 400
					if(jqXHR.status == 400){
						var response = JSON.parse(jqXHR.responseText);
						console.info(response.code);
						if(response.code == 4000 || response.code == 4011 || response.code == 4001 || response.code == 4012){
							alertNotify(response.description, 'error');
							sudoNotify.error(response.description);
						}else{
							//alertNotify("An internal server error occurred. Please try again later", 'error');
							sudoNotify.error(settings.i18n.translate("error.1"));
						}
					}else{
						//alertNotify("An internal server error occurred. Please try again later", 'error');
						sudoNotify.error(settings.i18n.translate("error.1"));
					}                   
                })
				.always(function() {
					$('#submit_btn .loader').fadeOut('slow',function(){$(this).remove()});
					$('#submit_btn').removeAttr('disabled');
				});
            }else{
                $('#submit_btn .loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit_btn').removeAttr('disabled');
            }
        });

	function get_course_categories(user_token){
		$.ajax({
			url: config.api_url + "/categories?type=course",
			method: "GET",
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
			console.log(data);
			if(data.total>0){
				//$('#category_list').empty();				
				html = '';
				for(i=0;i < data.data.length;i++){
					html +='<option value="'+data.data[i].id+'">'+data.data[i].name+'</option>';
				}
				$('#category_list').append(html);
			}
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			console.log('request failed !');
		});
		//return  result;
	}
 
 });
})(jQuery);
