/**
 * Script for log in user in using AJAX
 */

(function($) {
    $(document).ready(function() {

        var form, base_url, role, user_courses = null;      
        base_url = $('body').attr('data-base-url');		
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var limit = 10;
		var valid_token = check_token_validity(user_token);
		var uri = config.api_url + "/accounts/"+user_id+"/courses?limit="+limit;
		console.log(uri);		
		// if token exists and is valid
        if (!user_token || valid_token == false) {						
			window.location.assign(base_url + '/login');
		}
		if(user_role !== "INSTRUCTOR"){
			logout();
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
			if(user_courses){
				$('.course_list').empty();
				$('.pagination').empty();
				// count the number of published and unpublished courses of the current request
				count_published_courses = 0;
				count_unpublished_courses = 0;
				for(i=0;i < user_courses.data.length;i++){
					html = '<tr>';
					html +='<td width="5%">'+user_courses.data[i].id+'</td>';
					html += '<td width="35%"><a href="#">'+user_courses.data[i].name+'</a></td>';
					html += '<td width="15%">'+user_courses.data[i].shortname+'</td>';
					html +='<td width="15%"><a href="#">'+user_courses.data[i].course_category.name+'</a></td>';
					if(user_courses.data[i].status === "UNPUBLISHED"){
						html +='<td width="10%"><span class="label label-warning">'+user_courses.data[i].status+'</span></td>';
					}else{
						count_published_courses++;
						html +='<td width="10%"><span class="label label-success">'+user_courses.data[i].status+'</span></td>';
					}			
					html +='<td width="15%">';
					html += '<div class="btn-group">';
					html +='<a aria-expanded="false" href="javascript:void(0)" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></a>';
					html +='<ul class="dropdown-menu" role="menu">';
					html +='<li><a href="'+user_courses.data[i].id+'/edit">Edit</a></li>';
					if(user_courses.data[i].status =="PUBLISHED"){
					   html +='<li><a href="javascript:void(0)">Unpublish</a></li>';
					}else{
						html +='<li><a href="javascript:void(0)">Publish</a></li>';
					}
					html +='<li><a href="'+user_courses.data[i].id+'/delete">delete</a></li>';
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
 });
})(jQuery);
