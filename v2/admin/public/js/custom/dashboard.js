/**
 * Script to get course details using AJAX
 */

(function($) {
    $(document).ready(function() {
		$("#l1").addClass('active');
        var base_url = $('body').attr('data-base-url');      
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		console.log(valid_token);
		// if token exists and is valid
        if (user_token && valid_token == true) {
			if(user_role !== 'ADMINISTRATOR'){
				logout();
			}			
		}else{
			logout();
		}
		var course_uri = config.api_url + "/courses";
		var book_uri = config.api_url + "/books";
		var user_uri = config.api_url + "/accounts";
		var question_uri = config.api_url + "/questions";
		
		get_data(course_uri,"#total_courses");
		get_data(book_uri,"#total_books");
		get_data(user_uri,"#total_users");
		get_data(question_uri,"#total_questions");
		
		
		function get_data(uri, selector){		
			var result = null;
			$.ajax({
				url: uri,
				method: "GET",
				headers: {
					"x-client-id": "0000",
					"x-access-token": user_token,
					"Content-Type": "application/json",
					"cache-control": "no-cache"
				},
				async:true
			})
			.done(function (data, textStatus, jqXHR) {				
				if(data){
					console.log(data.total);
					$(selector).html(data.total);
				}else{
					$(selector).html(0);
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
		}
	});
})(jQuery);
