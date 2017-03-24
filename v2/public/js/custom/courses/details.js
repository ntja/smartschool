/**
 * Script for log in user in using AJAX
 */

(function($) {
    $(document).ready(function() {

        var course_details = null, course_id = $('section').data('course_id'), base_url = $('body').attr('data-base-url');      
        
		//Get user details
		course_details = get_course_details(course_id);	
		$('#course_title').prepend("<h2><strong>"+course_details.name+"</strong></h2>");
		$('.subject').html("Subject : "+course_details.course_category.name);
		$('.course_desc > .summary').after("<div class='col-md-12'><h4>"+course_details.shortdescription+"</h4></div>");
		
		/*		
		for(i=0;i < course_details.section.length;i++){
			html += '<h3 class="chapter_course no_margin_rop">'+course_details.section[i].title+'</h3>';
			html += '<div class="strip_single_course">';
			html += '<h4><a href="course_detail_page_txt.html">Lorem ipsum dolor sit amet, case saepe impetus sed ut.</a></h4>';
			html += '<ul><li><i class="icon-clock"></i> 00:58</li><li><i class="icon-doc"></i>Text reading</li></ul>';
            html += '</div>';
		}	
		*/
		//$('#course_content').html(html);
		get_section_details(course_details.id);
		
		//get section information
		function get_section_details(course_id){		
			var result = null;
			$.ajax({
				url: config.api_url + "/courses/"+course_id+"/sections",
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
				var html = "";
				for(i=0; i < data.data.length; i++){
					html += '<h3 class="chapter_course no_margin_rop">'+data.data[i].title+'</h3>';
					for(j=0;j < data.data[i].lessons.length;j++){
						html += '<div class="strip_single_course">';
						html += '<h4><a href="course_detail_page_txt.html">'+data.data[i].lessons[j].title+'</a></h4>';
						html += '<ul><li><i class="icon-clock"></i> 00:58</li><li><i class="icon-doc"></i>Text reading</li></ul>';
						html += '</div>';
					}					
				}
				$('#course_content').html(html);
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				console.log('request failed !');
			});
		}
	});
})(jQuery);
