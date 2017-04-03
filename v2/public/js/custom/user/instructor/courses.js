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
		
		//get course of a given instructor
		get_instructor_courses(user_id, user_token, uri);
		//console.info(user_courses.data);
		//click on i-th page link
		
		$('body').delegate('.page', 'click',function(){
			//console.log($(this).data('page'));
			var page = $(this).data('page');
			uri = config.api_url + "/accounts/"+user_id+"/courses?limit="+limit+"&page="+page;
			get_instructor_courses(user_id, user_token, uri);
		});
		
		//click on next page link
		$('body').delegate('#next', 'click',function(){
			var page = $(this).data('page')+1;
			uri = config.api_url + "/accounts/"+user_id+"/courses?limit="+limit+"&page="+page;
			get_instructor_courses(user_id, user_token, uri);
		});
		
		//clcik on previous page link
		$('body').delegate('#previous', 'click',function(){
			var page = $(this).data('page')-1;
			uri = config.api_url + "/accounts/"+user_id+"/courses?limit="+limit+"&page="+page;
			get_instructor_courses(user_id, user_token, uri);
		});
		
		form.validate({
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
		
		edit_form.validate({
            errorElement: 'label',
            //errorClass: 'error',
            errorPlacement: function errorPlacement(error, element) {
                if(element.attr("name") == "edit-course_description"){
					error.insertBeofre("textarea#edit-course_description")
				}else{
					error.insertBefore(element);
					error.css({'font-size': '0.8em' });
				}
            },
            onfocusout: function(element) {
                $(element).valid();
            },
            rules: {
                "edit-course_title": {
                    required: true
                },
                "edit-short_name": {
                    required: true
                },				
				"edit-target_audience": {
                    required: true
                },
				"edit-category_list": {
                    required: true
                },
				"edit-language": {
                    required: true
                },
				"edit-course_description": {
                    required: function(){
						CKEDITOR.instances['edit-course_description'].updateElement();
					}
                },
				"edit-category_list": {
                    required: true
                },
				"edit-course_format": {
                    required: true
                }
            }
        });
		
		var language, category_list, course_format,target_audience;
		// create course dropdowns
		$('#course_format').change(function() {
            course_format = $(this).val();
            console.log(course_format);
        });
		$('#language').change(function() {
            language = $(this).val();
            console.log(language);
        });
        $('#target_audience').change(function() {
            target_audience = $(this).val();
            console.log(target_audience);
        });
		$('#category_list').change(function() {
            category_list = $(this).val();
            console.log(category_list);
        });
		
        function validate() {
            return form.valid();
        }
		
		function validate_edit_form() {
			return edit_form.valid();
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
					form.slideUp('fast');
					$('#submit_btn').hide();
                    alertNotify("Well done ! Your course has been successfully created. <br> Click on the following link to <a href='#'>add your first lesson</a>", 'success');
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
						}else{
							alertNotify("An internal server error occurred. Please try again later", 'error');
						}
					}else{
						alertNotify("An internal server error occurred. Please try again later", 'error');
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
						
		//When user clcik on edit button
		$('body').delegate('.edit-course a','click', function(e) {
			//console.log($(this).data('course-id'));
			course_id = $(this).data('course-id');
			uri = config.api_url + "/courses/"+course_id;
			//load course details
			get_single_course(course_id, user_token, uri);					
		});
		
		//When user clcik on change-staus button
		$('body').delegate('.change-status a','click', function(e) {
			//console.log($(this).data('course-id'));
			var course_id = $(this).data('course-id');
			var course_status = $(this).data('status');
			//console.log($(this).parents().closest('.status'));
			uri = config.api_url + "/courses/"+course_id;
			//Change course status
			change_status(course_id, course_status, user_token, uri);					
		});

		
		$('#edit-course_format').change(function() {
            course_format = $(this).val();
            console.log(course_format);
        });
		$('#edit-language').change(function() {
            language = $(this).val();
            console.log(language);
        });
        $('#edit-target_audience').change(function() {
            target_audience = $(this).val();
            console.log(target_audience);
        });
		$('#edit-category_list').change(function() {
            category_list = $(this).val();
            console.log(category_list);
        });
		//When user clcik on edit course button
		$('#edit_btn').click(function(e) {
            e.preventDefault();
			// Showing spinner and disable the submit button
			$('#edit_btn').append('<i class="icon-spin4 animate-spin loader"></i>').attr('disabled','disabled');
			//console.log($('#email').val());
            if (validate_edit_form()) {
                var url, course_title, short_name,course_description, data, settings = [];
				course_format = $('#edit-course_format').val();
				language = $('#edit-language').val();
				console.log(language);
				target_audience = $('#edit-target_audience').val();
				category_list = $('#edit-category_list').val();
				var data = {entries: []};
                url = config.api_url + "/courses/"+course_id;
                course_title = $('#edit-course_title').val();
                short_name = $('#edit-short_name').val();    
				
				course_description = CKEDITOR.instances['edit-course_description'].getData(); //= $('#course_description').val();
				settings.push({"field": "name", "value": course_title?course_title:""});
				settings.push({"field": "shortname", "value": short_name?short_name:""});
				settings.push({"field": "courseformat", "value": course_format?course_format:""});
				settings.push({"field": "targetaudience", "value": target_audience?target_audience:""});
				settings.push({"field": "category", "value": category_list?category_list:""});
				settings.push({"field": "language", "value": language?language:""});
				settings.push({"field": "shortdescription", "value": course_description?course_description:""});
				data['entries']  = settings;
                /*
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
				*/
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
                    //$('#close').trigger('click');
					//edit_form[0].reset();
					//edit_form.slideUp('fast');
					//$('#edit_btn').hide();
                    alertNotify("Well done ! Your course has been successfully edited.", 'success');
                    console.log(data);                    
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
					$('#edit_btn .loader').fadeOut('slow',function(){$(this).remove()});
					$('#edit_btn').removeAttr('disabled');
					//if  status code is 400
					if(jqXHR.status == 400){
						var response = JSON.parse(jqXHR.responseText);
						console.info(response);
						if(response.code == 4000 || response.code == 4011 || response.code == 4001 || response.code == 4012){
							alertNotify(response.description, 'error');
						}else{
							alertNotify("An internal server error occurred. Please try again later", 'error');
						}
					}else{
						alertNotify("An internal server error occurred. Please try again later", 'error');
					}                   
                })
				.always(function() {
					$('#edit_btn .loader').fadeOut('slow',function(){$(this).remove()});
					$('#edit_btn').removeAttr('disabled');
				});
            }else{
                $('#edit_btn .loader').fadeOut('slow',function(){$(this).remove()});
				$('#edit_btn').removeAttr('disabled');
            }
        });
	
	$('body').on('hidden.bs.modal', function(){
		$(this).removeData('bs.modal');
		$(this).find('.response-message').remove();
	});
	
	//get instructor's courses
	function get_instructor_courses(user_id, user_token, uri){		
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
			async:true
		})
		.done(function (data, textStatus, jqXHR) {
			console.log(data);
			user_courses = data;
			if(user_courses.total != 0){
				$('.course_list').empty();
				$('.pagination').empty();
				// count the number of published and unpublished courses of the current request
				count_published_courses = 0;
				count_unpublished_courses = 0;
				for(i=0;i < user_courses.data.length;i++){
					html = '<tr>';
					html +='<td width="5%">'+user_courses.data[i].id+'</td>';
					html += '<td width="30%"><a href="#">'+user_courses.data[i].name+'</a></td>';
					html += '<td width="20%">'+user_courses.data[i].shortname+'</td>';
					html +='<td width="15%"><a href="#">'+user_courses.data[i].course_category.name+'</a></td>';
					if(user_courses.data[i].status === "UNPUBLISHED"){
						html +='<td width="10%" class="status"><span class="label label-warning">'+user_courses.data[i].status+'</span></td>';
					}else{
						count_published_courses++;
						html +='<td width="10%" class="status"><span class="label label-success">'+user_courses.data[i].status+'</span></td>';
					}			
					html +='<td width="15%">';
					html += '<div class="btn-group">';
					html +='<a aria-expanded="false" href="javascript:void(0)" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></a>';
					html +='<ul class="dropdown-menu" role="menu">';
					html +='<li class="edit-course"><a data-course-id="'+user_courses.data[i].id+'" href="javascript:void(0)"  data-toggle="modal" data-target="#editModal">Edit</a></li>';
					if(user_courses.data[i].status =="PUBLISHED"){
					   html +='<li class="change-status"><a data-status="UNPUBLISHED" data-course-id="'+user_courses.data[i].id+'" href="javascript:void(0)">Unpublish</a></li>';
					}else{
						html +='<li class="change-status"><a data-status="PUBLISHED" data-course-id="'+user_courses.data[i].id+'" href="javascript:void(0)">Publish</a></li>';
					}
					html +='<li><a href="course/'+user_courses.data[i].id+'/view">View</a></li>';
					html +='</ul></div>'; 
					html += '</td>';
					html +='</tr>';
					$('.course_list').append(html);
				}
				count_unpublished_courses = user_courses.data.length - count_published_courses;
				$('.count_publish').text(count_published_courses);
				$('.count_unpublish').text(count_unpublished_courses);
				if(user_courses.last_page>1){					
					if(user_courses.current_page == 1){
						$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">&laquo;</a></li>');						
					}else{
						$('.pagination').append('<li><a href="javascript:void(0)" id="previous" data-page="'+user_courses.current_page+'">&laquo;</a></li>');
					}													  					  
					for(i=1;i<=user_courses.last_page;i++){
						if(i==user_courses.current_page){
							$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">'+i+'</a></li>');
						}else{
							var uri = config.api_url + "/accounts/"+user_id+"/courses?limit=7&page=2";
							$('.pagination').append('<li><a href="javascript:void(0)" class="page" data-page="'+i+'">'+i+'</a></li>');
							// onclick="get_instructor_courses(\''+user_id+ '\', \''+user_token+ '\', \''+uri+ '\');"
						}
					}
					if(user_courses.current_page == user_courses.last_page){
						$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">&raquo;</a></li>');
					}else{
						$('.pagination').append('<li><a href="javascript:void(0)" id="next" data-page="'+user_courses.current_page+'">&raquo;</a></li>');
					}					
				}
			}else{
				html = '<h3> No Course Found </h3>';
				$('.no-course').append(html);
			}
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			console.log('request failed !');
		});
		//return  result;
	}
	
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
 
	function get_single_course(course_id, user_token, uri){		
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
			async:true
		})
		.done(function (data, textStatus, jqXHR) {
			console.log(data);
			$('#edit-course_title').val(data.name);
			$('#edit-short_name').val(data.shortname);
			//$('#edit-course_description').val(data.shortdescription);
			CKEDITOR.instances['edit-course_description'].setData(data.shortdescription);
			$('#edit-course_title').val(data.name);
			$('#edit-course_title').val(data.name);
			$('#edit-course_title').val(data.name);
			
			$('#edit-course_format option').each(function(i,el){
				if($(this).val() == data.courseformat){
					$(this).prop("selected", true);
					return false;
				}
				//console.log($(this).val());
			});
			$('#edit-target_audience option').each(function(i,el){
				if($(this).val() == data.targetaudience){
					$(this).prop("selected", true);
					return false;
				}
			});
			
			$('#edit-language option').each(function(i,el){
				if($(this).val() == data.language){
					$(this).prop("selected", true);
					return false;
				}
			}); 
			//copy the category list from create course form to edit course form
			$('#edit-category_list').empty().append($('#category_list').html());
			
			$('#edit-category_list option').each(function(i,el){
				if($(this).val() == data.course_category.id){
					$(this).prop("selected", true);
					return false;
				}
			});
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			console.log('request failed !');
		});
		//return  result;
	}
	
	function change_status(course_id, course_status, user_token, uri){
		var data = {"status" : course_status};
		$.ajax({
			url: config.api_url + "/courses/"+course_id+"/change-status",
			method: "PUT",
			contentType: "application/json",
			crossDomain: true,
			dataType: "json",
			data: JSON.stringify(data),
			headers: {
				"x-client-id": "0000",
				"Content-Type": "application/json",
				"cache-control": "no-cache",
				"x-access-token" : user_token
			},
			async:true
		})
		.done(function (data, textStatus, jqXHR) {
			alertNotify("Your Course has been successfully "+course_status, 'success');
            console.log(data); 		
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			if(jqXHR.status == 400){
				var response = JSON.parse(jqXHR.responseText);
				console.info(response);
				if(response.code == 4000 || response.code == 4003){
					alertNotify(response.description, 'error');
				}else{
					alertNotify("An internal server error occurred. Please try again later", 'error');
				}
			}else{
				alertNotify("An internal server error occurred. Please try again later", 'error');
			}  
		});
	}
	
 });
})(jQuery);
