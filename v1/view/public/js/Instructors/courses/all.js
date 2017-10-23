/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
    	$('.loader').hide();
        var base_url = $('body').attr('data-base-url'), form = $("#new-course"), account_id = Cookies.get('account_id'), token = Cookies.get('token');
        var user_role = window.localStorage.getItem('role'), category =$('select[name=category]').val(),language =$('select[name=language]').val();
        var limit = 10;
        console.log(base_url);
    	if(!account_id || !token){
			window.location.assign(base_url+'/login');
		}                
        if(user_role != "INSTRUCTOR"){
            Cookies.remove('token');
            Cookies.remove('account_id');        
            uri = base_url+'/login';
            window.location.assign(uri);
        } 
        get_data(account_id);
        //$('#course').css('min-height','400px');
        get_courses(config.api_url + '/accounts/'+account_id+'/courses?limit='+limit);
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
        
        $("#logout").click(function(){        
            logout();
        });
        
        $('select[name=language]').change(function() {
            language = $(this).val();
            console.log(language);
        });
        $('select[name=category]').change(function() {
            category = $(this).val();
            console.log(category);
        })
    $('#create-course').click(function(e) {
        e.preventDefault();
        $('.loader').fadeIn();
        var data, url, name,shortname, shortdescription;        
        if (validate()) {            
            name = $('#name').val();
            shortname = $('#shortname').val();
            shortdescription = $('#summernote_course').code();            
            //url = config.api_url + '/courses/';            
            data  = {
                "name":name,
                "shortname":shortname,
                "language":language,
                "instructor":account_id,
                "category":category,
                "shortdescription":shortdescription,
            };
            console.log(data);
            console.log(JSON.stringify(data));
            create_course(data);                         
        }else{
            $('.loader').fadeOut();
        }
    });
    
    function validate() {
        var valid = form.valid();
        return valid;
    }

    form.validate({           
            errorElement: 'div',
            errorClass: 'error',
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
                error.css({ 'color': '#E74300', 'font-size': '1.1em' });                                
            },
            onfocusout: function(element) {
                $(element).valid();
            },
            rules: {
                name: {
                    required: true
                },
                shortname: {
                    required: true
                },
                category: {
                    required: false
                },
                shortdescription: {
                    required: true
                }
            }
    });

    // Custom Functions
    function get_courses(url) {                
        $.ajax({
            url: url,
            type: "GET",
            crossDomain: true,
            dataType: "json",
            headers: {
                "x-client-id": "0000",
                "x-access-token": token
            }
        })
        .done(function(data, textStatus, jqXHR) {
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
            $('#course').DataTable({
                data: data.data,
                destroy: true,
                searching: false,
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
                        data: "category_name"
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
                            html+='<li><a href="'+full.id+'/edit">Edit</a></li>';
                            if(full.status=="PUBLISHED"){
                            //    html+='<button class="btn btn-success"><i class="fa fa-plus"></i>Unpublish</button>';
                               html+='<li><a href="#">Unpublish</a></li>';
                            }else{
                           //     html+='<button class="btn btn-info"><i class="fa fa-plus"></i>Publish</button>';
                                html+='<li><a href="#">Publish</a></li>';
                            }
                            //html+='<button class="btn btn-danger"><i class="fa fa-times"></i>delete</button>';
                            html+='<li><a href="'+full.id+'/delete">delete</a></li>';
                            html+='</ul></div>';                                                
                            return html;
                        },
                        orderable:false
                    }
                ]
            });            
            $('#course_wrapper').css('min-height','200px');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        });        
    }

    function create_course(data) {
        var url;
        url = config.api_url + '/courses';
        console.info(url);
        $.ajax({
            url: url,
            type: "POST",
            contentType: "application/json",
            crossDomain: true,
            dataType: "json",
            data: JSON.stringify(data),
            headers: {
                "x-client-id": "0000",
                "Content-Type": "application/json",
                "x-access-token": token
            }
        })
        // if everything is ok
        .done(function(data, textStatus, jqXHR) {
            console.log(data);
            $('.loader').fadeOut();
            $('#close').trigger('click');
            form[0].reset();
            //get_data(account_id);
            alertNotify("Well done ! Your course has been created. You can add your first lesson by clicing here : <a href='"+base_url+data.links[1].href+"'>add your first lesson</a>", 'success');
            get_courses(config.api_url + '/accounts/'+account_id+'/courses?limit='+limit);
        })

        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.status)
            $('.loader').fadeOut();
            var response = JSON.parse(jqXHR.responseText);
            console.info(response);
            if(response.code == 4001 || response.code == 4011 || response.code == 4012 || response.code == 4000){
                $('#close').trigger('click');
                alertNotify(response.description, 'error');                
            }else{
                $('#close').trigger('click');
                alertNotify("An internal error occurred. Please try again later", 'error');                
            }
        });
    }
    // Custom Functions
    function get_data(account_id) {
        url = config.api_url + '/accounts/' + account_id;
        $.ajax({
            url: url,
            type: "GET",
            crossDomain: true,
            dataType: "json",
            headers: {
                "x-client-id": "0000",
                "x-access-token": token
            }
        })
        .done(function(data, textStatus, jqXHR) {
            $('.user-name').text(data.account.first_name + ' ' + data.account.last_name);
            //console.info(base_url + '/img/avatar.gif');
            var user_photo = (data.account.photo != null && data.account.photo != "") ? data.account.photo : base_url + '/img/avatar/avatar.gif';
            $('.profile img').attr('src', user_photo);
            $('#first_name').val(data.account.first_name);
            $('#last_name').val(data.account.last_name);
            $('#email').val(data.account.email);
            $('#tel').val(data.account.phone);
            $('select[name=honorific]').val(data.account.honorific);
            //$('.xn-profile img').attr('src', user_photo);
            //$('.profile-data').append('<div class="profile-data-name">'+data.account.first_name + ' ' + data.account.last_name+'</div>');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log('failed');
        });
    }
    });    
})(jQuery);