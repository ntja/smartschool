/**
 * Script for log in user in using AJAX
 */

(function($) {
    $(document).ready(function() {

        var form, base_url, role, user_courses = null;      
        base_url = $('body').attr('data-base-url');
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		console.log(valid_token);		
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
		user_detail = get_user_details(user_id, user_token);
		console.info(user_detail);
		if(user_detail){
			$('#user_name').empty().html(user_detail.first_name);
		}
		//Get user details
		user_courses = get_instructor_courses(user_id, user_token);
		console.info(user_courses.data);
		if(user_courses){
			for(i=0;i<user_courses.data.length;i++){
				html = '<tr><td>'+user_courses.data[i].id+'</td><td>'+user_courses.data[i].name+'</td><td>'+user_courses.data[i].shortname+'</td><td>'+user_courses.data[i].course_category.name+'</td><td>'+user_courses.data[i].status+'</td></tr>';
				$('.course_list').append(html);
			}
			if(user_courses.last_page>1){
				$('.pagination').append('<li><a href="#">&laquo;</a></li>');									  					  
				for(i=1;i<=user_courses.last_page;i++){
					if(i==user_courses.current_page){
						$('.pagination').append('<li class="disabled"><a href="#">'+i+'</a></li>');
					}else{
						$('.pagination').append('<li><a href="#">'+i+'</a></li>');
					}
				}
				$('.pagination').append('<li><a href="#">&raquo;</a></li>');
			}
		}
	});
})(jQuery);
