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
		/* Get Current URL */
        /*
		var uri = $.url();
         Get a segment from URL 
        last_segment = uri.segment(-1);
		console.log(last_segment);
		*/
		query = qs().q;//.split("+").join(" ");
		//console.log(query);
		url = config.api_url + "/courses/search";
		if(query){
			search_items(url, query);
		}		
		
		//search items
        function search_items(url, query) {
            try {
                $.ajax({
                    async: true,
                    url: url+'?query='+query,
                    type: "GET",
                    crossDomain: true,
                    //data: JSON.stringify(query),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    headers: {
                        "x-client-id": "0000"
						//,"x-access-token": user_token
                    }
                })
				.done(function(data, textStatus, jqXHR) {
					//$("#search").data('query', query);
					console.log(data.data);
					var items = data.data;
					if(items.length==0){
						$('.no_result').removeClass('hide');
					}
					for(var i=0; i<items.length;i++){
						$('#result').append('<li><a href="'+base_url+'/course/'+items[i].shortname+'">'+items[i].name+'</a></li>');
					}
					
					
					/*
					if (data.back != null) {
						$("#prev").removeClass('disabled');
						$("#prev").removeAttr('disabled');
						$("#prev").data('url', data.back);
					} else {
						$("#prev").addClass('disabled');
						$("#prev").attr('disabled', 'disabled');
					}
					if (data.next) {
						$("#next").removeClass('disabled');
						$("#next").removeAttr('disabled');
						$("#next").data('url', data.next);
					} else {
						$("#next").addClass('disabled');
						$("#next").attr('disabled', 'disabled');
					}
					//showing the total number of results set
					$('#nb-entries').text(data.total);
					$('#entries-limit').text(data.items.length);
					
					$("html, body").animate({scrollTop: 0}, "fast");
					*/
					//return false;				
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					console.info(jqXHR);
					console.log("Request failed");
				});
            } catch (err) {
                console.log(err);
            }
        }        						
	});
})(jQuery);
