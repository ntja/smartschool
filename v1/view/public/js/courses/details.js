/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
    	$('.loader').hide();
        var base_url = $('body').attr('data-base-url'), account_id = Cookies.get('account_id'), token = Cookies.get('token');
        var user_role = window.localStorage.getItem('role')        
        console.log(base_url);
    	/*
        if(!account_id || !token){
			window.location.assign(base_url+'/login');
		}
        
        if(user_role != "INSTRUCTOR"){
            Cookies.remove('token');
            Cookies.remove('account_id');        
            uri = base_url+'/login';
            window.location.assign(uri);
        } 
        */
        /* Get Current URL */
        var url = $.url();
        
        /* Get id course from URL - last segment */
        course_id = url.segment(-1);
        if(account_id){
            get_data(account_id);
        }        
        //$('#course').css('min-height','400px');
        get_course(config.api_url + '/courses/'+course_id);
        //console.info(table);
        
        $("#logout").click(function(){        
            logout();
        });

    // Custom Functions

    function get_course(url) {                
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
            $('#course-title').empty().html(data.name);
            $('#course-description').empty().html(data.shortdescription);
            $('#instructor').empty().html(data.first_name+'  '+data.last_name);
            $('#category').html(data.category_name);
            $('#language').html(data.language);
            $('.course-time span').text(data.start_date?data.start_date:'');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
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