/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
		$("#l4").addClass('active');
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
		var limit = 10, uri = config.api_url + '/books?limit='+limit;
        get_books(uri);        

        //click on next page link
		$('body').delegate('#next', 'click',function(){			
			var page = $(this).data('page')+1;
			var page_url = $(this).data('next');
			get_books(page_url);
		});
		
		//click on previous page link
		$('body').delegate('#previous', 'click',function(){
			var page = $(this).data('page')-1;
			var page_url = $(this).data('previous');
			get_books(page_url);
		});	
		 
    // Custom Functions
    function get_books(url) {
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
                            return '<a href="'+base_url+'/courses/'+full.slug_name+'">'+data+'</a>';
                        }
                    },
                    {                     
                        data: "slug_name"
                    },
                    {                     
                        data: "size"
                    },
                    {                     
                        data: "category_name"
                    },
					{                     
                        data: "cover",
                        render: function(data, type, full, meta){
                            return '<img src="'+base_url+'../../../'+data+'" alt="" width="100px" height="100px" />';
                        }
                    },
					{                     
                        data: "filepath",
						render: function(data, type, full, meta){
                            return '<a href="'+base_url+'../../../'+data+'" alt="" width="100px" height="100px">Open the book</a>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta){                                                        
                            var html = '<div class="btn-group">';
                            //var html = '';
                            //html+='<button class="btn btn-success" onclick="delete_row(\'trow_1\');"><i class="fa fa-edit"></i>Edit</button>';                            
                            html+='<a aria-expanded="false" href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></a>';
                            html+='<ul class="dropdown-menu" role="menu">';
                            html+='<li><a href="book/'+full.id+'/edit">Edit</a></li>';                            
                            //html+='<button class="btn btn-danger"><i class="fa fa-times"></i>delete</button>';
                            html+='<li><a href="book/'+full.id+'/delete">delete</a></li>';
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