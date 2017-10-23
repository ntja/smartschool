/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
		$("#l3").addClass('active');
    	var base_url = $('body').attr('data-base-url');      
        var user_role = window.localStorage.getItem('sm_user_role'), user_token = window.localStorage.getItem('sm_user_token'), user_id = window.localStorage.getItem('sm_user_id');
        //check if user token is still valid 
		var valid_token = check_token_validity(user_token);
		// if token exists and is valid
        if (user_token && valid_token == true) {
			if(user_role !== 'ADMINISTRATOR'){
				logout();
			}			
		}else{
			logout();
		}
		var limit = 10, uri = config.api_url + '/courses?limit='+limit;
        get_courses(uri);        

        //click on next page link
		$('body').delegate('#next', 'click',function(){			
			var page = $(this).data('page')+1;
			var page_url = $(this).data('next');
			get_courses(page_url);
		});
		
		//click on previous page link
		$('body').delegate('#previous', 'click',function(){
			var page = $(this).data('page')-1;
			var page_url = $(this).data('previous');
			get_courses(page_url);
		});	
		 
    // Custom Functions
    function get_courses(url) {
		//$.fn.dataTable.ext.errMode = 'throw'; //throw error on console
        $.ajax({
            url: url,
            type: "GET",
            crossDomain: true,
            dataType: "json",
            headers: {
                "x-client-id": "0000",
                "x-access-token": user_token
            }
        })
        .done(function(data, textStatus, jqXHR) {
            $('.pagination').empty();
			if(data.next_page_url){
				$('.pagination').append('<li><a href="javascript:void(0)" data-page="'+data.current_page+'" data-next="'+data.next_page_url+'" id="next"> Next &raquo;</a></li>');
			}
			if(data.prev_page_url){			
				$('.pagination').prepend('<li><a href="javascript:void(0)"  data-page="'+data.current_page+'" data-previous="'+data.prev_page_url+'" id="previous"> &laquo; Previous</a></li>');
			}      
            $('#course_list').DataTable({
                data: data.data,
                destroy: true,
                searching: true,
                paginate: false,
                ordering: false,
                info:false,
                columns:[
                    {
                        data: "name",
                        render: function(data, type, full, meta){
                            return '<a href="'+base_url+'/courses/'+full.shortname+'">'+data+'</a>';
                        }
                    },
                    {                     
                        data: "shortname"
                    },
                    {                     
                        data: "status",
                        render: function(data, type, full, meta){
                            if(full.status=="PUBLISHED"){
                                return '<span class="label label-success">'+data+'</span>';    
                            }else{
                                return '<span class="label label-default">'+data+'</span>';
                            }
                            
                        }
                    },
                    {                     
                        data: "course_category",
						defaultContent: '',
						render: function(data, type, full, meta){							
                            if(!$.isEmptyObject(data)){
                                return '<strong">'+data.name+'</strong>';
                            }
                            
                        }
                    },
					{                     
                        data: "courseformat"
                    },
					{                     
                        data: "course_type"
                    },
                    {                     
                        data: "account",
						defaultContent: '',
						render: function(data, type, full, meta){							
                            if(!$.isEmptyObject(data)){
                                return '<strong">'+data.first_name+'  '+data.last_name+'</strong>';
                            }
                            
                        }
                    },
                    {                     
                        data: "language"
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta){                                                        
                            var html = '<div class="btn-group">';
                            //var html = '';
                            //html+='<button class="btn btn-success" onclick="delete_row(\'trow_1\');"><i class="fa fa-edit"></i>Edit</button>';                            
                            html+='<a aria-expanded="false" href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></a>';
                            html+='<ul class="dropdown-menu" role="menu">';
                            html+='<li><a href="course/'+full.id+'/edit">Edit</a></li>';
                            if(full.status=="PUBLISHED"){
                            //    html+='<button class="btn btn-success"><i class="fa fa-plus"></i>Unpublish</button>';
                               html+='<li><a href="#">Unpublish</a></li>';
                            }else{
                           //     html+='<button class="btn btn-info"><i class="fa fa-plus"></i>Publish</button>';
                                html+='<li><a href="#">Publish</a></li>';
                            }
                            //html+='<button class="btn btn-danger"><i class="fa fa-times"></i>delete</button>';
                            html+='<li><a href="course/'+full.id+'/delete">delete</a></li>';
                            html+='</ul></div>';                                                
                            return html;
                        },
                        orderable:false
                    }
                ]
            });            
            //$('#course_wrapper').css('min-height','200px');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        });        
    }
    
    });    
})(jQuery);