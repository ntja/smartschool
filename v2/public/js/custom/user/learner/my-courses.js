/**
 * Script for learner courses list
 */

(function($) {
    $(document).ready(function() {
        //When user clcik on logout button
		$('.logout').click(function(e) {
            e.preventDefault();
			logout();
		});
		
		var form, base_url, role, user_detail = null;      
        base_url = $('body').attr('data-base-url');
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		console.log(valid_token);		
		// if token exists and is valid
        if (!user_token || valid_token == false) {						
			window.location.assign(base_url + '/login');
		}
		if(user_role !== "LEARNER"){
			logout();
		}
		var limit = 10;
		var uri = config.api_url + "/accounts/"+user_id+"/applications?limit="+limit;
		//get learner's courses
		
		//get course of a given learner
		get_learner_courses(user_id, user_token, uri);
		
		
		function get_learner_courses(user_id, user_token, uri){		
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
					var html = "";
					html += '<tbody>';
					for(i=0;i < user_courses.data.length;i++){
						html += '<tr>';
						html += '<td>'+user_courses.data[i].category+'</td>';
						html += '<td><a href="#">'+user_courses.data[i].course_details.name+'</a></td>';
						html += '<td>'+user_courses.data[i].date_joined+'</td>';
						html += '<td><img src="'+base_url+'/img/bullet_start_2.png" alt=""> '+user_courses.data[i].progression+'</td>';
						html += '</tr>';
					}					
					html += '</tbody>';
					$('.courses .table').append(html);
				}else{
					html = '<div class=" col-md-10 col-md-offset-1 text-center"><h3> You are not registered on any Course. </h3><p><a href="#" class="button_medium">Browse Course Catalog</a></p></div>';
					$('.courses').empty().append(html);
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
			//return  result;
		}				
		
	});
})(jQuery);
