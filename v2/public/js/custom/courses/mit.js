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
			var page = $(this).data('next');
			console.info(page);
			get_course(page);
		});
		
		//clcik on previous page link
		$('body').delegate('#previous', 'click',function(){
			var page = $(this).data('previous');
			get_course(page);
		});		
		
		//click on a category
		$('body').delegate('.category', 'click',function(){
			var category = $(this).data('id');
			get_course(category);
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
						html +='<li><a href="#" class="category" data-id="'+data[i].category_id+'">'+data[i].name+' ('+data[i].course_count+')</a></li>';
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
			$.get(url, function( data ) {			  
			  var course_list = data;
			  $( "#course_list" ).empty();
			  $('.pagination').empty();
			  html = '<ul class="list_1">';
			  for(i=0;i<data.length;i++){
				html +=  '<li><a href="'+data[i].linkurl+'" target="blank">'+data[i].title +'</a></li>';
			  }
			  html += '</ul>';
			  $( "#course_list" ).html(html);
			  console.info(data);			  		
			});			
		}
		
		function get_course(cat){						
			url =  "http://data.oeconsortium.org/api/v1/categories/"+cat+"/";			
			//console.log(url);			
			$.get(url, function( data ) {			  
			  var course_list = data.results;
			  $( "#course_list" ).empty();
			  $('.pagination').empty();
			  html = '<ul class="list_1">';
			  for(i=0;i<course_list.length;i++){
				html +=  '<li><a href="'+course_list[i].linkurl+'" target="blank">'+course_list[i].title +'</a></li>';
			  }
			  html += '</ul>';
			  $( "#course_list" ).html(html);
			  console.info(data);
			  //console.log(data.next_page);
			  if(data.previous){
					$('.pagination').append('<li><a href="javascript:void(0)" data-previous="'+data.previous_page+'" id="previous">&laquo; Previous</a></li>');
				}
				if(data.next){			
					$('.pagination').append('<li><a href="javascript:void(0)" data-next="'+data.next_page+'" id="next"> Next &raquo; </a></li>');
				}			
			});			
		}
	});
})(jQuery);
