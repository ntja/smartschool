var settings, config, environment;
settings = {
    environments: {
        development: {
            api_url: 'http://192.168.254.254/jobsd8/api'
        },
        staging: {
            api_url: 'http://sw.ai/staging/squirrel/public'
        }
    }
};

environment = 'staging';
config = settings.environments[environment];

(function($) {
    $(document).ready(function() {        
        root_admin = $('body').attr('data-base-url');
        // Renew token. 
        if (localStorage.getItem("renew_token") == 1) {
            renew_token();
        }

        if(localStorage.admin_id){
            var admin_id = localStorage.admin_id;
            $('#admin_profile').click(function() {
                window.location.href = root_admin + '/users/'+ admin_id;
            });
        }

        $('#deconnexion').click(function() {
            localStorage.clear();
            window.location.href = root_admin + '/login';
        });
    });

    //function to renew token store in localStorage
    // Renew token
    function renew_token() {
        var url;
        try {
            url = config.api_url + '/persons/renew-token';
			console.log(url);
            $.ajax({
                url: url,
                method: "Get",
                headers: {
                    "x-client-id": "0000",
                    "x-access-token": localStorage.token
                }
            })
                    .done(function(data, textStatus, jqXHR) {
                        console.log(data);
                        if (data.code == 200 || data.code == 201) {
                            localStorage.setItem('token', data.token);
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        return null;
                    });
        } catch (error) {
            console.log(error)
        }
    }    
})(jQuery);