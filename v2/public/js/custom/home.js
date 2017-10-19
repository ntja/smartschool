/**
 * Script to get courses in using AJAX
 */

(function($) {
    $(document).ready(function() {
		
		$.get( "http://data.oeconsortium.org/api/v1/courses/search/?q=informatique", function( data ) {
		  $( ".result" ).html( data );
		  console.info(data);
		});
		
        var courses = null, data = null,base_url = $('body').attr('data-base-url');      
        
		//Get courses list
		courses = get_courses();		
		
		if(courses){
			data = courses.data;
			console.info(data);
			$('#course_list').empty();
			html = "<div class='row'>";
			for(i=0; i<data.length; i++){
				if(i%4 == 0){
					html += "</div>";
					html += "<div class='row'>";
				}
				html += "<div class='col-lg-3 col-md-6 col-sm-6'>";
				html += "<div class='col-item'>";
				//html += "<span class='ribbon_course'></span>";
				html += "<div class='photo'>";
				html += "<a href='"+base_url + "/course/"+data[i].shortname+"'>";
				if(data[i].photo){
					html += "<img src='"+base_url + "/public/"+data[i].photo+"' alt='' height='200' />";
				}else{
					html += "<img src='"+base_url + "/public/img/poetry.jpg' alt='' />";
				}
				html += "</a>";
				html += "<div class='cat_row'>";
				if(data[i].course_category){
					html += "<a href='#'>"+data[i].course_category.name+"</a>";
				}
				html += "<span class='pull-right'><i class='icon-money'></i>"+settings.i18n.translate('home.3')+"</span></div>";
				html += "</div>";
				html += "<div class='info'>";
				html += "<div class='row'>";
				html += "<div class='course_info col-md-12 col-sm-12'>";
				html += "<h5><strong>"+data[i].name+"</strong></h5>";
				//html += "<p> "+data[i].shortdescription.substr(0,100)+"</p>";
				html += "<div class='rating'>";
				html += "<i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i class='icon-star-empty'></i>";
				html += "</div>";
				html += "</div>";
				html += "</div>";
				html += "<div class='separator clearfix'>";
				html += "<p class='btn-add'> <a href='"+base_url + "/subscription-plans'><i class='icon-export-4'></i> "+settings.i18n.translate('home.2')+"</a></p>";
				html += "<p class='btn-details'> <a href='"+base_url + "/course/"+data[i].shortname+"'><i class='icon-eye'></i> "+settings.i18n.translate('home.1')+"</a></p>";
				html += "</div>";
				html += "</div>";
				html += "</div>";
				html += "</div>";												
			}
			$('#course_list').append(html);                        
			if(data.length > 12){
                $('.view_all').removeClass('hide');
			}
		}
	});
})(jQuery);
