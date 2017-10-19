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
			url = url +'?query='+query;
			search_items(url);
			//search_items(url, query);
		}

		//click on next page book link
		$('body').delegate('#next_book_list', 'click',function(){
			//$('html, body').animate({scrollTop: 0}, "smooth");
			var page = $(this).data('book_page')+1;			
			var page_url = $(this).data('book_next');
			search_items(page_url, query);
		});
		
		//click on previous page book link
		$('body').delegate('#previous_book_list', 'click',function(){
			//$('html, body').animate({scrollTop: 0}, "smooth");			
			var page = $(this).data('book_page')-1;			
			var page_url = $(this).data('book_previous');
			search_items(page_url, query);
		});
		
		
		//click on next page courses link
		$('body').delegate('#next_course_list', 'click',function(){
			//$('html, body').animate({scrollTop: 0}, "smooth");
			var page = $(this).data('course_page')+1;			
			var page_url = $(this).data('course_next');
			search_items(page_url, query);
		});
		
		//click on previous page courses link
		$('body').delegate('#previous_course_list', 'click',function(){
			//$('html, body').animate({scrollTop: 0}, "smooth");			
			var page = $(this).data('course_page')-1;			
			var page_url = $(this).data('course_previous');
			search_items(page_url, query);
		});
		
		//search items
        function search_items(url, query) {
            try {
				if(query){
					url = url +'&query='+query;
				}
                $.ajax({
                    async: true,
                    url: url,
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
					//console.log($.isEmptyObject(data.books));
					var items = null;
					// courses resutls
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
						$('#course_list').empty().append('<h4><b>Courses : '+data.courses.total+' results found</b></h4>');
						$('#course_list').append(html);
						$('.pagination-course').empty();
						if(data.courses.next_page_url){
							$('.pagination-course').append('<li><a href="javascript:void(0)" data-course_page="'+data.courses.current_page+'" data-course_next="'+data.courses.next_page_url+'" id="next_course_list"> Next &raquo;</a></li>');
						}
						if(data.courses.prev_page_url){			
							$('.pagination-course').prepend('<li><a href="javascript:void(0)"  data-course_page="'+data.courses.current_page+'" data-course_previous="'+data.courses.prev_page_url+'" id="previous_course_list"> &laquo; Previous</a></li>');
						}
					}										
					//books results
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
								html += '<a href="'+items[i].filepath+'" class="read-book fancy-box fancybox.iframe embed"  data-type="iframe"><img src="'+base_url+'/'+items[i].cover+'" alt="" /></a>';
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
								html += '<p class="btn-add"> <a href="'+items[i].filepath+'" class="read-book fancy-box fancybox.iframe embed"  data-type="iframe"><i class="icon-book"></i> '+settings.i18n.translate('book.catalog.2')+'</a></p>';
								//html += '<p class="btn-details"> <a href="#"><i class=" icon-share"></i> '+settings.i18n.translate('book.catalog.1')+'</a></p>';
								html += '<p class="btn-details"> <a href="#"><i class=" icon-download"></i> '+settings.i18n.translate('book.catalog.1')+'</a></p>';
								html += '</div>';
								html += '</div>';
								html += '</div>';
								html += '</div>';
							}
							
							//$('html, body').animate({scrollTop: 20}, "smooth");
							$('#book_list').empty().append('<h4><b>Books : '+data.books.total+' result(s) found</b></h3>');
							$('#book_list').append(html);
							$('.pagination-book').empty();
							if(data.books.next_page_url){
								$('.pagination-book').append('<li><a href="javascript:void(0)" data-book_page="'+data.books.current_page+'" data-book_next="'+data.books.next_page_url+'" id="next_book_list"> Next &raquo;</a></li>');
							}
							if(data.books.prev_page_url){			
								$('.pagination-book').prepend('<li><a href="javascript:void(0)"  data-book_page="'+data.books.current_page+'" data-book_previous="'+data.books.prev_page_url+'" id="previous_book_list"> &laquo; Previous</a></li>');
							}
							// Adjust iframe height according to the contents
							//parent.jQuery.fancybox.getInstance().update();
							$(".fancy-box").fancybox({
								//maxWidth	: 800,
								//maxHeight	: 600,
								fitToView	: true,
								//width		: '70%',
								//height		: '100%',
								autoSize	: false,
								scrolling   : 'auto',					
								closeClick	: false,
								openEffect  : 'elastic',
								closeEffect : 'elastic',
								autoSize    : false,
								type        : 'iframe',
								toolbar     : true,
								smallBtn    : false,
								iframe: {
									preload: false, // fixes issue with iframe and IE,
									css : {
										width : '90%',
										height : '90%',
									}
								},
								'onComplete' : function() {
									$('#fancybox-frame').load(function() { // wait for frame to load and then gets it's height
									$('#fancybox-content').height($(this).contents().find('body').height()+130);
								});
							  }
							});	
						}						
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
