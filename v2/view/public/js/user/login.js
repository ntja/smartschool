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
        
        form.validate({
            errorElement: 'span',
            errorClass: 'error',
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
                error.css({ 'color': '#E74300', 'font-size': '1.0em', });                                
            },
            /*
            onfocusout: function(element) {
                $(element).valid();
            },
            */
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
            //$('.loader').show();            
            if (validate()) {
                $('#loader').fadeIn();
                var url, email, password, data;
                url = config.api_url + '/accounts/authenticate';
                //console.log(url);                
                email = $('#email').val();
                password = $('#password').val();                

                data = {
                    "email": email,
                    "password": password                
                };
                //console.log(data);
                //console.log(JSON.stringify(data))                
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
                    $('#loader').fadeOut();
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
                    setTimeout(function(){
                        window.location.assign(uri);
                    },1500);                    
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    $('#loader').fadeOut();
                    var response = JSON.parse(jqXHR.responseText);
                    console.info(response.code);
                    if(response.code == 4000 || response.code == 4002 || response.code == 4003 || response.code == 4004){
                        alertNotify(response.description, 'error');
                    }else{
                        alertNotify("An error occurred. Please try again later", 'error');
                    }
                    console.info(response.description);
                    //console.error(jqXHR);
                });
            }else{
                $('#loader').fadeOut();
            }
        })		

    });
})(jQuery);