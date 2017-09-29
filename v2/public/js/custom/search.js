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
		
		//click to read or download book
		$('body').delegate('.read-book', 'click',function(){
			var src = $(this).data('book');
			$(".book-title").html($(this).data('book-title'));
			$('.book-content').empty().addClass('myIframe').append('<iframe scrolling="yes" src="'+base_url+'/'+src+'" class="embed-responsive-item" allowfullscreen></iframe>');
		});
		query = qs().q;//.split("+").join(" ");
		//console.log(query);
		url = config.api_url + "/search";
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
					console.log($.isEmptyObject(data.books));
					var items = null;
					if(!$.isEmptyObject(data.courses)){
						items = data.courses.data;
						if(items.length==0){
							$('.no_result').removeClass('hide');
						}
						html = "<div class='row'>";
						for(i=0; i<items.length; i++){
							if(i%4 == 0){
								html += "</div>";
								html += "<div class='row'>";
							}
							html += "<div class='col-lg-3 col-md-6 col-sm-6'>";
							html += "<div class='col-item'>";
							html += "<div class='photo'>";
							html += "<a href='"+base_url + "/course/"+items[i].shortname+"'><img src='"+base_url + "/public/img/poetry.jpg' alt='' /></a>";
							html += "<div class='cat_row'>";
							if(items[i].course_category){
								html += "<a href='#'>"+items[i].course_category.name+"</a>";
							}
							html += "<span class='pull-right'><i class='icon-money'></i>"+settings.i18n.translate('home.3')+"</span></div>";
							html += "</div>";
							html += "<div class='info'>";
							html += "<div class='row'>";
							html += "<div class='course_info col-md-12 col-sm-12'>";
							html += "<h4><strong><a href='"+base_url + "/course/"+items[i].shortname+"'>"+items[i].name+"</a></strong></h4>";
							html += "</div>";
							html += "</div>";
							html += "</div>";
							html += "</div>";
							html += "</div>";												
						}
						$('#course_list').append('<h4><b>Courses : '+data.courses.total+' results found</b></h4>');
						$('#course_list').append(html);
					}										
					/*
					for(var i=0; i<items.length;i++){
						$('#result').append('<li><a href="'+base_url+'/course/'+items[i].shortname+'">'+items[i].name+'</a></li>');
					}
					*/										
					
					if(!$.isEmptyObject(data.books)){
						var items = data.books.data;
						if(items.length ==0){
							var html = "<h3>No book found. <a href='"+base_url+"/books/catalog'>Return to Home page</a></h3>";
						}else{
							html = "<div class='row'>"
							for(i=0; i < items.length; i++){
								if(i%4 == 0){
									html += "</div>";
									html += "<div class='row'>";
								}					
								html += '<div class="col-lg-3 col-md-6">';
								html += '<div class="col-item">';
								html += '<div class="photo">';
								html += '<a href="#" class="read-book" data-toggle="modal" data-target="#myModal" data-book="'+items[i].filepath+'" data-book-title="'+items[i].name+'"><img src="'+base_url+'/'+items[i].cover+'" alt="" /></a>';
								html += '<div class="cat_row">';						
								html += '<a href="#">'+items[i].category_name+'</a>';						
								html += '<span class="pull-right"><i class=" icon-money"></i>'+settings.i18n.translate('home.3')+'</span></div>';
								html += '</div>';
								html += '<div class="info">';
								html +=	'<div class="row">'
								html += '<div class="course_info col-md-12 col-sm-12">';
								html += '<h4>'+items[i].name+'</h4>';
								//html += '<p > Lorem ipsum dolor sit amet, no sit sonet corpora indoctum, quo ad fierent insolens. Duo aeterno ancillae ei. </p>';
								html += '<div class="rating">';
								html += '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i>'
								html += '</div>';
								//html += '<div class="price pull-right">Free</div>';
								html += '</div>';
								html += '</div>';
								html += '<div class="separator clearfix">';
								html += '<p class="btn-add"> <a href="#" class="read-book" data-toggle="modal" data-target="#myModal" data-book="'+items[i].filepath+'" data-book-title="'+items[i].name+'"><i class="icon-book"></i> '+settings.i18n.translate('book.catalog.2')+'</a></p>';
								//html += '<p class="btn-details"> <a href="#"><i class=" icon-share"></i> '+settings.i18n.translate('book.catalog.1')+'</a></p>';
								html += '<p class="btn-details"> <a href="#"><i class=" icon-download"></i> '+settings.i18n.translate('book.catalog.1')+'</a></p>';
								html += '</div>';
								html += '</div>';
								html += '</div>';
								html += '</div>';
							}
							$('.pagination').empty();
							
							if(data.books.last_page>1){					
								if(data.books.current_page == 1){
									$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">&laquo;</a></li>');						
								}else{
									$('.pagination').append('<li><a href="javascript:void(0)" id="previous" data-page="'+data.books.current_page+'">&laquo;</a></li>');
								}													  					  
								for(i=1; i<=data.books.last_page;i++){
									if(i==data.books.current_page){
										$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">'+i+'</a></li>');
									}else{
										$('.pagination').append('<li><a href="javascript:void(0)" class="page" data-page="'+i+'">'+i+'</a></li>');
									}
								}
								if(data.books.current_page == data.books.last_page){
									$('.pagination').append('<li class="disabled"><a href="javascript:void(0)">&raquo;</a></li>');
								}else{
									$('.pagination').append('<li><a href="javascript:void(0)" id="next" data-page="'+data.books.current_page+'">&raquo;</a></li>');
								}					
							}
						}
						$('html, body').animate({scrollTop: 0}, "smooth");
						$('#book_list').append('<h4><b>Books : '+data.books.total+' result(s) found</b></h3>');
						$('#book_list').append(html);
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
