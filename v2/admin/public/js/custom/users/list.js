/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
		$("#l2").addClass('active');
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
		var limit = 10, uri = config.api_url + '/accounts?limit='+limit;
        get_users(uri);        

        //click on next page link
		$('body').delegate('#next', 'click',function(){			
			var page = $(this).data('page')+1;
			var page_url = $(this).data('next');
			get_users(page_url);
		});
		
		//click on previous page link
		$('body').delegate('#previous', 'click',function(){
			var page = $(this).data('page')-1;
			var page_url = $(this).data('previous');
			get_users(page_url);
		});	
		 
    // Custom Functions
    function get_users(url) {
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
                        data: "first_name"
                    },
                    {                     
                        data: "last_name"
                    },
                    {                     
                        data: "role",
						render: function(data, type, full, meta){
                            if(full.role == "LEARNER"){
                                return '<span class="label label-info">'+data+'</span>';    
                            }else if(full.role == "INSTRUCTOR"){
                                return '<span class="label label-success">'+data+'</span>';
                            }else if(full.role == "ADMINISTRATOR"){
                                return '<span class="label label-danger">'+data+'</span>';
                            }
                            
                        }
                    },
                    {                     
                        data: "email"
                    },
					{                     
                        data: "verified_status",
						render: function(data, type, full, meta){
                            if(full.verified_status=="VERIFIED"){
                                return '<span class="label label-success">'+data+'</span>';    
                            }else{
                                return '<span class="label label-warning">'+data+'</span>';
                            }
                            
                        }
                    },
					{                     
                        data: "date_created"
                    },
					{                     
                        data: "phone"
                    },
					{                     
                        data: "is_active",
						render: function(data, type, full, meta){
                            if(data == "1"){
                                return '<span class="label label-success">online</span>';    
                            }else{
                                return '<span class="label label-danger">offline</span>';
                            }
                            
                        }
                    },
					{                     
                        data: "subscription",
						render: function(data, type, full, meta){
                            if(full.subscription=="PAID"){
                                return '<span class="label label-success">'+data+'</span>';    
                            }else{
                                return '<span class="label label-warning">'+data+'</span>';
                            }
                            
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
                            html+='<li><a href="user/'+full.id+'/edit">Edit</a></li>';                            
                            //html+='<button class="btn btn-danger"><i class="fa fa-times"></i>delete</button>';
                            html+='<li><a href="user/'+full.id+'/delete">delete</a></li>';
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