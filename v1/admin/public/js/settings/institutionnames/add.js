/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($) {
    $(document).ready(function() {
        $("#l5").addClass('active');
        $("#l8").addClass('active');
        if (localStorage.admin_token) {
            // if(localStorage.admin_role == "ADMINISTRATOR"){				
            /* Get Current URL */

            /* Get campaign info */
            $("#save_btn").click(function() {

                $(this).parent().addClass('loading');
                $(this).parent().removeClass('success');
                $(this).parent().removeClass('fail');
                if ($(this).parent().hasClass('loading')) {
                    validate_form();
                }
            });

            $("#cancel").click(function() {
                window.location.href = root_admin + '/settings/institution-names';
            });
            // }else{
            // // Redirection vers la page de login
            // window.location.href = root_admin + '/dashboard';
            // }
        } else {
            // Redirection vers la page de login
            window.location.href = root_admin + '/login';
        }
    });

    function validate_form() {
        /*
         *  Validation using Javascript
         */
        try {
            // Set error messages
            $.extend($.validator.messages, {
                required: 'Required Field',
            });

            // Declaration des variables
            var validation;

            // Set rules validation
            $('#edit_in').validate({
                rules: {
                    'input_name': {
                        required: true
                    },
                    'logo': {
                        required: true
                    }
                }
            });

            validation = $('#edit_in').valid();

            if (validation == false) {
                $('#save_btn').parent().addClass('fail');
                $('#save_btn').parent().removeClass('success');
                $('#save_btn').parent().removeClass('loading');
            } else {
                $('#save_btn').parent().addClass('loading');
                $('#save_btn').parent().removeClass('success');
                $('#save_btn').parent().removeClass('fail');
                add_job();
            }
        } catch (error) {
            console.log(error);
        }
    }

    $('#logo').change(function() {
        $('#logo').addClass('loading');
        $('#logo').removeClass('success');
        $('#logo').removeClass('fail');
        var file = upload_image('edit_in');
        console.log(file);
        if (file) {
            $('#logo').removeClass('loading');
            $('#logo').removeClass('fail');
            $('#logo').addClass('success');
            $('#logo').parent().children('div').remove();
            $('#logo').parent().append('<div><img src="' + file.file_name + '" width="100px" height="70px"/></div>');
            $('#photo').val(file.file_name);
        } else {
            $('#logo').removeClass('loading');
            $('#logo').removeClass('success');
            $('#logo').addClass('fail');
        }
        console.log(file);
    });

    function add_job() {
        try {
            var uri, name, logo;
            name = $('#input_name').val();
            logo = $('#photo').val();
            uri = config.api_url + '/institution-names';
            data = {
                "name": name,
                "logo": logo
            };
            $.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000",
                    "Content-Type": "application/json"
                },
                method: "POST",
                data: JSON.stringify(data),
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        console.log(data);
                        if (data.code == 201) {
                            $("#save_btn").parent().addClass('success');
                            $("#save_btn").parent().removeClass('loading');
                            $("#save_btn").parent().removeClass('fail');

                            $('#flash_info').attr('hidden', "hidden");
                            $('#flash_info').removeClass('alert-danger').addClass('alert-success');
                            $("#msg").text(settings.i18n.translate('setting.add.1'));
                            $('#flash_info').removeAttr('hidden');

                            // Redirection vers la page
                            window.location.href = root_admin + '/settings/institution-names';
                        }
                        if (data.code == 200) {
                            $('#flash_info').attr('hidden', "hidden");
                            $('#flash_info').removeClass('alert-success').addClass('alert-danger');
                            $("#msg").text("This institution name already exists");
                            $('#flash_info').removeAttr('hidden');
                            $("#save_btn").parent().removeClass('loading');
                        }

                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        $("#save_btn").parent().addClass('fail');
                        $("#save_btn").parent().removeClass('loading');
                        $("#save_btn").parent().removeClass('success');

                        var response = JSON.parse(jqXHR.responseText);
                        if (response.code == 4000 || response.code == 400) {
                            $('#flash_info').attr('hidden', "hidden");
                            $('#flash_info').removeClass('alert-success').addClass('alert-danger');
                            $("#msg").text("Failed to add new institution");
                            $('#flash_info').removeAttr('hidden');
                        } else {
                            $('#flash_info').attr('hidden', "hidden");
                            $('#flash_info').removeClass('alert-success').addClass('alert-danger');
                            $("#msg").text("Erreur : ");
                            $('#flash_info').removeAttr('hidden');
                        }
                    });
        } catch (error) {
            console.log(error);
        }
    }
})(jQuery);