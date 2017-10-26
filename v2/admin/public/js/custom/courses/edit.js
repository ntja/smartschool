/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
		$("#l3").addClass('active');
    	var base_url = $('body').attr('data-base-url');      
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		// if token exists and is valid
        if (user_token && valid_token == true) {
			if(user_role !== 'ADMINISTRATOR'){
				logout();
			}			
		}else{
			logout();
		}

		var course_id = $('.course_id').data('course_id'), uri = config.api_url + "/courses/"+course_id, course_data = null;
		get_single_course(uri,user_token);
		 
		//When user clcik on create course button
		$('#edit_btn').click(function(e) {
            e.preventDefault();
			// Showing spinner and disable the submit button
			$(this).append('<i class="icon-spin3 animate-spin loader"></i>').attr('disabled','disabled');
			//console.log($('#email').val());            
			var url, data, data_obj = [], cover = null;
			var data = {entries: []};
			url = config.api_url + "/courses/"+course_id;			
			cover = $('#book_cover').data('cover');
			data_obj.push({"field": "name", "value": course_data.name});
			data_obj.push({"field": "shortname", "value": course_data.shortname});
			data_obj.push({"field": "courseformat", "value": course_data.courseformat});
			data_obj.push({"field": "targetaudience", "value": course_data.targetaudience});
			if(course_data.category){
				data_obj.push({"field": "category", "value": course_data.category});
			}			
			data_obj.push({"field": "language", "value": course_data.language});
			data_obj.push({"field": "shortdescription", "value": course_data.shortdescription});
			if(cover){
				data_obj.push({"field": "photo", "value": cover});
			}			
			data['entries']  = data_obj;                
			console.log(data);
			//console.log(JSON.stringify(data))                
			$.ajax({
				url: url,
				type: "PUT",
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
				window.location.assign(base_url + '/courses');
				//$('#close').trigger('click');
				//edit_form[0].reset();
				//edit_form.slideUp('fast');
				//$('#edit_btn').hide();
				//alertNotify("Well done ! Your course has been successfully edited.", 'success');
				$('#edit_btn').removeAttr('disabled');
				//$('#edit_btn').append('<i class="fa fa-check"></i>');
				//sudoNotify.success(settings.i18n.translate("instructor.course.2"));
				//console.log(data);                    
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				$('#edit_btn .loader').fadeOut('slow',function(){$(this).remove()});
				$('#edit_btn').removeAttr('disabled');
				//if  status code is 400
				if(jqXHR.status == 400){
					var response = JSON.parse(jqXHR.responseText);
					console.info(response);
					if(response.code == 4000 || response.code == 4011 || response.code == 4001 || response.code == 4012){
						//alertNotify(response.description, 'error');
						//sudoNotify.error(response.description);
					}else{
						//alertNotify("An internal server error occurred. Please try again later", 'error');
						//sudoNotify.error(settings.i18n.translate("error.1"));
					}
				}else{
					//alertNotify("An internal server error occurred. Please try again later", 'error');
					//sudoNotify.error(settings.i18n.translate("error.1"));
				}                   
			})
			.always(function() {
				$('#edit_btn .loader').fadeOut('slow',function(){$(this).remove()});
				$('#edit_btn').removeAttr('disabled');
			});
		}); 
		 
		// Custom Functions
		function get_single_course(uri, user_token){		
			var result = null;
			$.ajax({
				url: uri,
				method: "GET",
				headers: {
					"x-client-id": "0000",
					"Content-Type": "application/json",
					"cache-control": "no-cache",
					"x-access-token" : user_token
				},
				crossDomain:false,
				async:false
			})
			.done(function (data, textStatus, jqXHR) {
				course_data = data;
				$('#course_title').val(data.name);
				$('#short_name').val(data.shortname);				
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
			//return  result;
		}
    });    
})(jQuery);