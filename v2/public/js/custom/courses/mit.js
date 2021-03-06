/**
 * Script to get courses in using AJAX
 */

(function($) {
    $(document).ready(function() {
		
		query = qs().q;
		//console.log(query);
		if(qs().q){
			query = "q="+query;
		}else{
			query = "q=computer science";
		}
		//console.log(query);
		get_categories();
		
		get_latest_course();
		
		function search(q){
			url =  "http://data.oeconsortium.org/api/v1/courses/search/?"+q;
			//console.log(url);			
			$.get(url, function( data ) {
			  //$( "#course_list" ).html( data.documents );
			  var course_list = data.documents;
			  $( "#course_list" ).empty();
			  $('.pagination').empty();
			  html = '<ul class="list_1">';
			  for(i=0;i<course_list.length;i++){
				  //if(course_list[i].source == "Massachusetts Institute of Technology"){
					$( "#course_list" ).append( '<p><a href="'+course_list[i].link+'" target="blank">'+course_list[i].title +'</a></p>' );
					html +=  '<li><a href="'+course_list[i].link+'" target="blank">'+course_list[i].title +'</a></li>' 
				  //}			
			  
			  }
			  html += '</ul>';
			  $( "#course_list" ).html(html);
			  console.info(data);
			  //console.log(data.next_page);
			  if(data.previous_page){
					$('.pagination').append('<li><a href="javascript:void(0)" data-previous="'+data.previous_page+'" id="previous">&laquo; Previous</a></li>');
				}
				if(data.next_page){			
					$('.pagination').append('<li><a href="javascript:void(0)" data-next="'+data.next_page+'" id="next"> Next &raquo; </a></li>');
				}			
			});			
		}
		//click on next page link
		$('body').delegate('#next', 'click',function(){
			$('html, body').animate({scrollTop: 0}, "smooth");
			var page = $(this).data('next');			
			get_course(page);
		});
		
		//clcik on previous page link
		$('body').delegate('#previous', 'click',function(){
			$('html, body').animate({scrollTop: 0}, "smooth");
			var page = $(this).data('previous');
			get_course(page);
		});		
		
		//click on a category
		$('body').delegate('.category', 'click',function(){
			var category = $(this).data('id');
			$(this).parent().siblings().each(function( index ) {
			  $( this ).find('a').removeAttr("id");
			});
			console.info($(this).siblings());
			$(this).attr('id', 'active');
			url = "http://data.oeconsortium.org/api/v1/categories/"+category+"/";
			get_course(url);
		});
		
		$('.latest_courses').on('click',function(){
			$(".title").text("Latest Courses");
			$(this).parent().siblings().each(function( index ) {
			  $( this ).find('a').removeAttr("id");
			});
			$(this).attr('id', 'active');
			get_latest_course();
		});
		
		
		function get_categories(){
			var url =  "http://data.oeconsortium.org/api/v1/categories/";
			$.get(url, function( ) {			 
			})
			.done(function(data) {
				console.log(data);
				if(data.length>0){
					//$('#category_list').empty();				
					html = '';
					for(i=0;i < data.length;i++){
						html +='<li><a href="javascript:void(0)" class="category" data-id="'+data[i].category_id+'">'+data[i].name+' ('+data[i].course_count+')</a></li>';
					}
					$('.subject').append(html);
				}
			})
			  .fail(function() {
				//alert( "error" );
			})
			  .always(function() {
				//alert( "finished" );
			});				
		}
		
		function get_latest_course(){
			url =  "http://data.oeconsortium.org/api/v1/courses/latest/";								
			$.get(url).done(function(data) {
			  var course_list = data;
			  $( "#course_list" ).empty();
			  $('.pagination').empty();
			  html = '<ul class="list_1">';
			  for(i=0;i<data.length;i++){
				if(valid_URL(data[i].linkurl)){
					html +=  '<li><a href="'+data[i].linkurl+'" target="_blank">'+data[i].title +'</a></li>';
				}
			  }
			  html += '</ul>';
			  $( "#course_list" ).html(html);
			  console.info(data);			  		
			});			
		}
		
		function get_course(url){
			//url =  "http://data.oeconsortium.org/api/v1/categories/"+cat+"/";
			//console.log(url);			
			$.get(url).done(function(data) {
				var course_list = data.results;
				$(".title").text(data.title);
				$( "#course_list" ).empty();
				$('.pagination').empty();
				html = '<ul class="list_1">';
				for(i=0;i<course_list.length;i++){
					if(valid_URL(course_list[i].linkurl)){
						html +=  '<li><a href="'+course_list[i].linkurl+'" target="_blank">'+course_list[i].title +'</a></li>';
					}					
				}
				html += '</ul>';
				$( "#course_list" ).html(html);
				console.info(data);
				//console.log(data.next_page);
				if(data.previous){
					$('.pagination').append('<li><a href="javascript:void(0)" data-previous="'+data.previous+'" id="previous">&laquo; Previous</a></li>');
				}
				if(data.next){			
					$('.pagination').append('<li><a href="javascript:void(0)" data-next="'+data.next+'" id="next"> Next &raquo; </a></li>');
				}			
			})
			  .fail(function() {
				//alert( "error" );
			})
			  .always(function() {
				//alert( "finished" );
			});			
		}
		function valid_URL(str) {
		   var regex = /(?:https?):\/\/(\w+:{:?}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
		  if(!regex .test(str)) {
			//alert("Please enter valid URL.");
			return false;
		  } else {
			return true;
		  }
		}
	});
})(jQuery);
