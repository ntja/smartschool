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
		
		get_data(query);
		
		function get_data(q){
			url =  "http://data.oeconsortium.org/api/v1/courses/search/?"+q;
			//console.log(url);			
			$.get(url, function( data ) {
			  //$( "#course_list" ).html( data.documents );
			  var course_list = data.documents;
			  $( "#course_list" ).empty();
			  $('.pagination').empty();
			  for(i=0;i<course_list.length;i++){
				  //if(course_list[i].source == "Massachusetts Institute of Technology"){
					$( "#course_list" ).append( '<p><a href="'+course_list[i].link+'" target="blank">'+course_list[i].title +'</a></p>' );
				  //}			
			  }
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
			get_data(page);
		});
		
		//clcik on previous page link
		$('body').delegate('#previous', 'click',function(){
			var page = $(this).data('previous');
			get_data(page);
		});		
		/**/								
	});
})(jQuery);