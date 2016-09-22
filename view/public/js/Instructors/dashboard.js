/**
 * Script for dashboard
 */
(function($) {
    $(document).ready(function() {
    	var base_url = $('body').attr('data-base-url'), account_id = Cookies.get('account_id'), token = Cookies.get('token');
    	var user_role = window.localStorage.getItem('role');
        //console.log(Cookies.get("account"));
    	if(!account_id || !token){
			window.location.assign(base_url+'/login');
		}                
        if(user_role != "INSTRUCTOR"){
            Cookies.remove('token');
            Cookies.remove('account_id');        
            uri = base_url+'/login';
            window.location.assign(uri);
        }        
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
        	//console.info(base_url + '/img/avatar.gif');
            //var user_photo = (data.account.photo != null && data.account.photo != "") ? data.account.photo : base_url + '/img/avatar/avatar.gif';
            $('.user-name').text(data.account.first_name + ' ' + data.account.last_name);
            //$('.profile img').attr('src', user_photo);
            //$('.xn-profile img').attr('src', user_photo);
            //$('.profile-data').append('<div class="profile-data-name">'+data.account.first_name + ' ' + data.account.last_name+'</div>');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log('failed');
        });
    });
     $("#logout").click(function(){        
        logout();
    });
})(jQuery);