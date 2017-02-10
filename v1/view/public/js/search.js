/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {    	
        var base_url = $('body').attr('data-base-url');        
        //var courses;

        var query_params = get_query('query');
        console.info(query_params.query);
        get_courses(config.api_url + '/courses/search?query='+query_params.query);
        //console.info(table);       

         $('#next').click(function(e) {            
            e.preventDefault();
            //$("#course").DataTable().destroy();
            //table.destroy();            
            url = $("#next").data('url');
            url+= '&limit='+limit;
            console.log(url);
            get_courses(url);
         });

         $('#prev').click(function(e) {
            e.preventDefault();
            url = $("#prev").data('url');
            url+= '&limit='+limit;
            get_courses(url);
         });
        
        
    // Custom Functions
    function get_courses(url) {                
        var html='', src;
        $.ajax({
            url: url,
            type: "GET",
            crossDomain: true,
			async:true,
            dataType: "json",
            headers: {
                "x-client-id": "0000"
            }
        })
        .done(function(data, textStatus, jqXHR) {
            if(data.data){
                //console.info(data.prev_page_url != null);            
            if(data.prev_page_url != null){
                $("#prev").removeClass('hide');
                $("#prev").data('url',data.prev_page_url);
            }else{                
                $("#prev").addClass('hide');
            }
            if(data.next_page_url != null){
                $("#next").removeClass('hide');
                $("#next").data('url',data.next_page_url);
            }else{
                $("#next").addClass('hide');
            }
            for(var i=0; i<data.data.length;i++){      
                if(!data.data[i].smallicon){
                    if(data.data[i].category_name=="Physics"){
                        src = 'images/icons/education/physics.png';
                    }else if(data.data[i].category_name=="Mathematics"){
                        src = 'images/icons/education/compass.png';
                    }else if(data.data[i].category_name=="Computer Science"){
                        src = 'images/icons/education/computer.png';
                    }else if(data.data[i].category_name=="Computer Science"){
                        src = 'images/icons/education/learning.png';
                    }
                }
                html+= '<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn">';
                html+= '<div class="shop-item course-v2">';
                html+= '<div class="post-media entry">';
                html+= '<img src="'+src+'" alt="" class="img-responsive">';
                html+= '<div class="magnifier">';
                html+= '<div class="shop-bottom clearfix">';
                html+= '<a href="courses/'+data.data[i].shortname+'" title="View Course details"><i class="fa fa-eye"></i></a>';
                html+= '</div><!-- end shop-bottom -->';

                html+= '<div class="large-post-meta">';
                html+= '<span class="avatar"><a href="instructors"><img src="images/icons/education/teacher.png" alt="" class="img-circle"> '+data.data[i].first_name+' '+data.data[i].last_name+'</a></span>';
                html+= '<small>&#124;</small>';
                html+= '<span class="hidden-xs"><a href="#"><i class="fa fa-graduation-cap"></i> 0 Students</a></span>';
                html+= '</div><!-- end meta -->';
                html+= '</div><!-- end magnifier -->';
                html+= '</div><!-- end post-media -->';
                html+= '<div class="shop-desc">';
                html+= '<div class="shop-price clearfix">';
                html+= '<div class="pull-left">';
                html+= '<div class="rating">';
                html+= '<i class="fa fa-star"></i>';
                html+= '<i class="fa fa-star"></i>';
                html+= '<i class="fa fa-star"></i>';
                html+= '<i class="fa fa-star"></i>';
                html+= '<i class="fa fa-star"></i>';
                html+= '</div><!-- end rating -->';
                html+= '</div><!-- end left -->';
                html+= '<div class="pull-right">';
                html+= '<small>Free</small>';
                html+= '</div><!-- end right -->';
                html+= '</div>';
                html+= '<h4><a href="courses/'+data.data[i].shortname+'" title="">'+data.data[i].name+'</a></h4>';
                html+= '<small>Category: '+data.data[i].category_name+'</small>';
                html+= '</div>';
                html+= '</div><!-- end shop-item -->';
                html+= '</div><!-- end carousel-item -->';                   
            }            
            $(".number-items").html(data.total+" item(s) found");
            $("#catalog").empty().append(html);			
            }else{
                $(".number-items").html(data.total+" item(s) found");
            }
			$(".criteria i").html('"'+query_params.query+'"');
            //$('#catalog .panel').css('min-height','360px');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        });        
    }    
    
    });    
})(jQuery);