
(function($) {
    $(document).ready(function() {
		$('#search').on('click', function(){
			var query = $('.query').val();
			uri = $('body').attr('data-base-url')+'/courses/search?q='+query.replace(/\s/g, "+");
			window.location.assign(encodeURI(uri));
			//console.info(encodeURIComponent(query));
		});

		$('#query_input').keypress(function(e) {	
			var key = e.which;
			console.info("enter pressedd");
			if (key == 13) {
				var query = $('.query').val();
				if (query != '') {
					e.preventDefault();					
					uri = $('body').attr('data-base-url')+'/courses/search?q='+query.replace(/\s/g, "+");
					window.location.assign(encodeURI(uri));
					//console.info(encodeURI(query));
				}
			}
		});
		/*
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
		//When user click on logout button
		$('.logout').click(function(e) {
            e.preventDefault();
			logout();
		});
		
		//Get user details
		user_detail = get_user_details(user_id, user_token);
		//console.info(user_detail);
		if(user_detail){
			$('#user_name').empty().html(user_detail.first_name);
		}
		*/
    });
})(jQuery);
