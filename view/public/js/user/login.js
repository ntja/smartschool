/**
 * Script for authenticating user in using AJAX
 */

(function($) {
    $(document).ready(function() {
        var form, base_url;
        form = $("#signin");
        base_url = $('body').attr('data-base-url');
        // if user is already authenticated redirect him to dashboard
        var user_role = window.localStorage.getItem('role');
        if (Cookies.get("account_id") && Cookies.get("token")) {            
            if (user_role == "INSTRUCTOR") {
                window.location.assign(base_url + '/instructors/dashboard');
            }else if(user_role == "LEARNER") {
                window.location.assign(base_url + '/learners/dashboard');
            }
        }
        //"/accounts/verify?email=jephte@sw.ai&verify_token=rVOZWw22dyZooa3mY4G9NTWQeYrliLXvLYjTsyMRo5k9bLoFar"
        $('.loader').hide();
        //console.log($('body').attr('data-base-url') + '/login');        
        
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
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                }
            }
        });

        function validate() {
            var valid = form.valid();            
            return valid;
        }

        $('#submit_btn').click(function(e) {
            e.preventDefault();
            $('.loader').show();            
            if (validate()) {
                var url, email, password, data;
                url = config.api_url + '/accounts/authenticate';
                console.log(url);                
                email = $('#email').val();
                password = $('#password').val();                

                data = {
                    "email": email,
                    "password": password                
                };
                console.log(data);
                console.log(JSON.stringify(data))                
                $.ajax({
                    url: url,
                    type: "POST",
                    contentType: "application/json",
                    crossDomain: true,
                    dataType: "json",
                    data: JSON.stringify(data),
                    headers: {
                        "x-client-id": "0000",
                        "Content-Type": "application/json"
                    }
                })
                // if everything is ok
                .done(function(data, textStatus, jqXHR) {
                    //var uri;
                    $('.loader').hide();
                    alertNotify("Well done ! Successful authentication", 'success');
                    console.log(data);
                    Cookies.set("account_id", data.account_id, {expires: 15});
                    Cookies.set("token", data.token, {expires: 15});
                    window.localStorage.setItem('role', data.role);
                    if (data.role == "INSTRUCTOR") {                        
                        uri = base_url + '/instructors/dashboard';
                    } else if (data.role == "LEARNER"){
                        uri = base_url + '/learners/dashboard';
                    }
                    window.location.assign(uri);
                    //uri = $('body').attr('data-base-url') + '/login';
                    //window.location.assign(uri);
                })

                .fail(function(jqXHR, textStatus, errorThrown) {
                    $('.loader').hide();
                    var response = JSON.parse(jqXHR.responseText);
                    console.info(response.code);
                    if(response.code == 4000 || response.code == 4002 || response.code == 4003 || response.code == 4004){
                        alertNotify(response.description, 'error');
                    }else{
                        alertNotify("An error occurred. Please try again later", 'error');
                    }
                    console.info(response.description);
                    //console.error(jqXHR);
                })
            }
        })
    });
})(jQuery);