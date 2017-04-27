/**
 * Script to get course details using AJAX
 */

(function($) {
    $(document).ready(function() {

        var base_url = $('body').attr('data-base-url');      
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		console.log(valid_token);
		// if token exists and is valid
        if (user_token && valid_token == true) {
			if(user_role == 'LEARNER'){
				$(".connect-register").html("<a class='button_top' href='"+base_url+"/learner/dashboard'>Return to Dashboard</a>");
			}
			if(user_role == 'INSTRUCTOR'){
				$(".connect-register").html("<a class='button_top' href='"+base_url+"/instructor/dashboard'>Return to Dashboard</a>");
			}
		}
		var limit = 12;
		var uri = config.api_url + "/courses?limit="+limit;
		$('body').delegate('.page', 'click',function(){
			//console.log($(this).data('page'));
			var page = $(this).data('page');
			uri = config.api_url + "/courses?limit="+limit+"&page="+page;
			get_courses(uri);
		});
		
		//click on next page link
		$('body').delegate('#next', 'click',function(){
			var page = $(this).data('page')+1;
			uri = config.api_url + "/courses?limit="+limit+"&page="+page;
			get_courses(uri);
		});
		
		//clcik on previous page link
		$('body').delegate('#previous', 'click',function(){
			var page = $(this).data('page')-1;
			uri = config.api_url + "/courses?limit="+limit+"&page="+page;
			get_courses(uri);
		});
		
		//Get courses list
		get_courses(uri);
		
		// Get all course categories
		get_course_categories();
		
		
		//get all courses
		function get_courses(uri){		
			var result = null;
			$.ajax({
				url: uri,
				method: "GET",
				headers: {
					"x-client-id": "0000",
					"Content-Type": "application/json",
					"cache-control": "no-cache"
				},
				async:true
			})
			.done(function (data, textStatus, jqXHR) {
				console.log(data.data);
				//console.log(data.valid == false);
				if(data.data.length ==0){
					var html = "<h3>No course found. <a href='"+base_url+"/courses/catalog'>Return to Home page</a></h3>";
				}else{
					html = "<div class='row'>"
					for(i=0; i < data.data.length; i++){
						if(i%3 == 0){
							html += "</div>";
							html += "<div class='row'>";
						}					
						html += '<div class="col-lg-4 col-md-6">';
						html += '<div class="col-item">';
						html += '<div class="photo">';
						html += '<a href="'+base_url+'/course/'+data.data[i].shortname+'"><img src="'+base_url+'/public/img/poetry.jpg" alt="" /></a>';
						html += '<div class="cat_row"><a href="#">'+data.data[i].course_category.name+'</a><span class="pull-right"><i class=" icon-money"></i>Free</span></div>';
						html += '</div>';
						html += '<div class="info">';
						html +=	'<div class="row">'
						html += '<div class="course_info col-md-12 col-sm-12">';
						html += '<h4>'+data.data[i].name+'</h4>';
						//html += '<p > Lorem ipsum dolor sit amet, no sit sonet corpora indoctum, quo ad fierent insolens. Duo aeterno ancillae ei. </p>';
						html += '<div class="rating">';
						html += '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i>'
						html += '</div>';
						//html += '<div class="price pull-right">Free</div>';
						html += '</div>';
						html += '</div>';
						html += '<div class="separator clearfix">';
						html += '<p class="btn-add"> <a href="apply_2.html"><i class="icon-export-4"></i> Subscribe</a></p>';
						html += '<p class="btn-details"> <a href="'+base_url+'/course/'+data.data[i].shortname+'"><i class=" icon-eye"></i> Details</a></p>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
					}
					$('.pagination').empty();
					if(data.last_page>1){					
						if(data.current_page == 1){
							$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">&laquo;</a></li>');						
						}else{
							$('.pagination').append('<li><a href="javascript:void(0)" id="previous" data-page="'+data.current_page+'">&laquo;</a></li>');
						}													  					  
						for(i=1;i<=data.last_page;i++){
							if(i==data.current_page){
								$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">'+i+'</a></li>');
							}else{
								$('.pagination').append('<li><a href="javascript:void(0)" class="page" data-page="'+i+'">'+i+'</a></li>');
							}
						}
						if(data.current_page == data.last_page){
							$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">&raquo;</a></li>');
						}else{
							$('.pagination').append('<li><a href="javascript:void(0)" id="next" data-page="'+data.current_page+'">&raquo;</a></li>');
						}					
					}
				}
				
				$('#course_list').html(html);
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
		}
		
		//get all course categories (subjects)
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
						html +='<li><a href="#">'+data.data[i].name+'</a></li>';
					}
					$('.subject').append(html);
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
			//return  result;
		}

	});
})(jQuery);
