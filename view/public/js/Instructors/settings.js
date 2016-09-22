/**
 * Script for dashboard
 */
(function($) {
    $(document).ready(function() {
    	$('.loader').hide();
        var base_url = $('body').attr('data-base-url'), form = $("#profile-form"), account_id = Cookies.get('account_id'), token = Cookies.get('token');
        var user_role = window.localStorage.getItem('role'), honorific =$('select[name=honorific]').val();
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
        get_data(account_id);
        $("#logout").click(function(){        
            logout();
        });
        $('select[name=honorific]').change(function() {
            honorific = $(this).val();
            console.log(honorific);
        })
    $('#submit').click(function(e) {
        e.preventDefault();
        $('.loader').fadeIn();
        var data, url, firstname, lastname, email, password, tel, settings = [], token = Cookies.get('token');        
        if (validate()) {
            email = $('#email').val();
            firstname = $('#first_name').val();
            lastname = $('#last_name').val();
            tel = $('#tel').val();            
            password = $('#password').val();
            confirmation_password = $('#confirmation_password').val();
            photo = $('#photo').val();
            data = {entries: []};
            url = config.api_url + '/accounts/' + account_id + '/informations';
            settings.push({"field": "first_name", "value": firstname});
            settings.push({"field": "last_name", "value": lastname});
            settings.push({"field": "honorific", "value": honorific});
            if(password != ''){
                settings.push({"field": "password", "value": password});
                settings.push({"field": "confirmation_password", "value": confirmation_password});  
            }            
            if(tel != ''){
                settings.push({"field": "phone", "value": tel});
            }
            data['entries']  = settings;
            console.log(settings);
            console.log(JSON.stringify(data));
            update_data(data);             
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
                element.after(error);
                error.css({ 'color': '#E74300', 'font-size': '1.1em' });                                
            },
            onfocusout: function(element) {
                $(element).valid();
            },
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                tel: {
                    required: false
                },
                password: {
                    required: false,
                    minlength: 8
                },
                honorific: {
                    required: true
                },
                confirmation_password: {
                    required: false,
                    equalTo: "#password"
                }
            }
    });

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
    function update_data(data) {
        var url;
        url = config.api_url + '/accounts/' + account_id + '/informations';
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
            get_data(account_id);
            alertNotify("Well done ! Information has been successfully updated", 'success');
        })

        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.status)
            $('.loader').fadeOut();
            var response = JSON.parse(jqXHR.responseText);
            console.info(response);
            if(response.code == 4000 || response.code == 4007){
                alertNotify(response.description, 'error');
            }else{
                alertNotify("An error occurred. Please try again later", 'error');
            }
        })
    }
    });    
})(jQuery);