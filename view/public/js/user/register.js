/**
 * Script for registering user in using AJAX
 */

(function($) {
    $(document).ready(function() {
        //"/accounts/verify?email=jephte@sw.ai&verify_token=rVOZWw22dyZooa3mY4G9NTWQeYrliLXvLYjTsyMRo5k9bLoFar"
        ///accounts/verify?email=jephte.ndongmou@gmail.com&verify_token=qFlCISoPXvucFqdTShegsCHsiS6gQGOUxbPlACl2qrbId0C9hf"
        $('.loader').hide();
        console.log($('body').attr('data-base-url') + '/register');
        var form, base_url, role;
        form = $("#register");
        base_url = $('body').attr('data-base-url');
        //default user role
        role = 'LEARNER';
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
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            }
        });

        function validate() {
            var valid = form.valid();
            return valid;
        }

        $('[name="role"]').click(function() {
            role = $(this).val();
            console.log(role);
        })

        $('#submit_btn').click(function(e) {
            e.preventDefault();
            $('.loader').fadeIn();            
            /*
            var panel = $(this).parents(".login-body");
            console.log(panel);
            panel_refresh(panel);
            setTimeout(function(){
            panel_refresh(panel);
            },65000);
            */
            if (validate()) {
                var url, email, password, firstname, lastname, password, data;
                url = config.api_url + '/accounts';
                console.log(url);
                firstname = $('#first_name').val();
                lastname = $('#last_name').val();
                email = $('#email').val();
                password = $('#password').val();                

                data = {
                    "email": email,
                    "password": password,
                    "first_name": firstname,
                    "last_name": lastname,
                    "role": role
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
                    $('.loader').hide();
                    //alertNotify("Well done ! Your account has been created", 'success');
                    console.log(data);
                    /* MESSAGE BOX */
                    var box = $($(".mb-control").data("box"));
                    if(box.length > 0){
                        box.toggleClass("open");
                    }        
                    console.info($(this).parents(".message-box"));
                    ///return false;                    
                    $(".mb-control-close").on("click",function(){
                       $(this).parents(".message-box").removeClass("open");
                       uri = $('body').attr('data-base-url') + '/login';
                        window.location.assign(uri);
                       //return false;
                    }); 
                     /* END MESSAGE BOX */
                    //uri = $('body').attr('data-base-url') + '/login';
                    //window.location.assign(uri);
                })

                .fail(function(jqXHR, textStatus, errorThrown) {
                    $('.loader').hide();
                    var response = JSON.parse(jqXHR.responseText);
                    if(response.code == 4000 || response.code == 4001){
                        alertNotify(response.description, 'error');
                    }else{
                        alertNotify("An error occured. Please try again later", 'error');
                    }
                    console.info(response.description);
                    //console.error(jqXHR);
                })
            }
        })
    });
})(jQuery);