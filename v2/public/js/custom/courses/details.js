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
	});
})(jQuery);
