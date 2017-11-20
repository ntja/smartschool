/**
 * Script to get course details using AJAX
 */

(function($) {
    $(document).ready(function() {

        var base_url = $('body').attr('data-base-url');
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);		
		//console.log(qs());
		// if token exists and is valid
        if (user_token && valid_token == true) {
			if(user_role == 'LEARNER'){
				$(".connect-register").html("<a class='button_top' href='"+base_url+"/learner/dashboard'>Return to Dashboard</a>");
			}
			if(user_role == 'INSTRUCTOR'){
				$(".connect-register").html("<a class='button_top' href='"+base_url+"/instructor/dashboard'>Return to Dashboard</a>");
			}
		}		
		var book_id = $("#main_content").data("book_id");
		// Get book info
		get_book_info(book_id,user_token);
		
		//get book info
		function get_book_info(book_id){
			$.ajax({
				url: config.api_url + "/books/"+book_id,
				method: "GET",
				headers: {
					"x-client-id": "0000",
					"Content-Type": "application/json",
					"cache-control": "no-cache",
					//"x-access-token" : user_token
				},
				crossDomain:false,
				async:true
			})
			.done(function (data, textStatus, jqXHR) {
				console.log(data.item.filepath);
				if(data){
					$("#book").append('<h3 class="text-center text-primary"><strong>'+data.item.name+'</strong></h3><iframe src="'+base_url+'/'+data.item.filepath+'" width="99%" height="500"></iframe>');
					$(".breadcrumb").append('<li class="active">'+data.item.name+'</li>');
					//get books of same categories
					get_similar_books(data.item.category, data.item.id);
				}
				//<iframe src="{{URL::to('/')}}/your file path here" width="100%" height="600"></iframe>
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				$("#book").append('<h2 class="text-center text-danger"> Book Not FOund</h2>');
				console.log('request failed !');
			});
			//return  result;
		}
		
		//get all course categories (subjects)
		function get_similar_books(cat_id, book_id){
			$.ajax({
				url: config.api_url + "/categories/"+cat_id+"/books",
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
				//console.log(data);
				if(data.total>0){
					//$('#category_list').empty();				
					html = '';
					for(i=0;i < data.data.length;i++){
						if(data.data[i].id != book_id){
							html +='<li><a href="'+base_url+'/books/'+data.data[i].slug_name+'" data-category_id="'+data.data[i].id+'">'+data.data[i].name+'</a></li>';
						}						
					}
					$('.similar_books').append(html);
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
			//return  result;
		}

	});
})(jQuery);
