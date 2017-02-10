/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
    	$('.loader').hide();
        var base_url = $('body').attr('data-base-url'), form = $("#new-course"), account_id = Cookies.get('account_id'), token = Cookies.get('token');
        var user_role = window.localStorage.getItem('role');
        var limit = 20;
        console.log(base_url);
    	if(!account_id || !token){
			window.location.assign(base_url+'/login');
		}                         
        get_data(account_id);
        get_courses(config.api_url + '/courses?limit='+limit);
        //console.info(table);

        $('body').delegate('.course_name', 'click', function(e) {
            e.preventDefault();
            $course_id = $(this).data('course_name');            
            window.location.assign(base_url+'/courses/'+$course_id);
        });


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

    // Custom Functions
    function get_courses(url) {                
        var html='';
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
            for(var i=0; i<data.data.length;i++){                
                html+='<div class="col-md-3"><div class="panel panel-default">';
                html+='<div class="panel-body profie"><div class="profile-image">';
                html+='<img src="../img/education/png/laptop.png" width="100%" alt="course photo"/>';
                html+='</div>';                
                //html+='<a href="#" class="profile-control-left"><span class="fa fa-info"></span></a>';
                //html+='<a href="#" class="profile-control-right"><span class="fa fa-phone"></span></a>';
                html+='</div><div class="panel-body"><div class="contact-info">';
                html+='<p><b>'+data.data[i].name.toUpperCase()+' : '+data.data[i].category_name+'</b></p><br>';
                html+= '<div class="row"><div class="col-md-12">';
                html+='<button class="btn btn-info  btn-block course_name" data-course_name='+data.data[i].shortname+'><span class="fa fa-eye"></span> View Lessons</button></div></div>';
                html+='</div></div>';  
                html+='</div></div></div></div>';                  
            }            
            $("#catalog").empty().append(html);
            $('#catalog .panel').css('min-height','360px');

        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        });        
    }    
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