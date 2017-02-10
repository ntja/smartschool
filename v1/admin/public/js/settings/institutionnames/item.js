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
            var url = $.url();

            /* Get id skill from URL */
            inID = url.segment(-1);

            /* Get skill info */
            get_in(inID);

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
                required: 'Champ requis',
            });

            // Declaration des variables
            var validation;

            // Set rules validation
            $('#edit_in').validate({
                rules: {
                    'input_name': {
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
                edit_in(inID);
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


    function get_in(id) {
        try {
            var uri = config.api_url + '/institution-names/' + id;

            $.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000"
                },
                method: "GET",
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        console.log(data);
                        $('#input_name').attr('value', data.name);
                        if (data.logo) {
                            $('#logo').parent().append('<div><img src="' + data.logo + '" width="100px" height="70px"/></div>');
                            $('#photo').val(data.logo);
                        }
                        // $('#objective').html('<b> '+data.objective+'</b>');
                        // $('.pub_name').text(data.name);
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {

                    });
        } catch (error) {
            console.log(error);
        }
    }

    function edit_in(id) {
        try {
            var uri, name, logo;
            name = $('#input_name').val();
            logo = $('#photo').val();
            uri = config.api_url + '/institution-names/' + id;
            data = {"name": name, "logo": logo};
            $.ajax({
                url: uri,
                async: true,
                headers: {
                    "x-access-token": localStorage.admin_token,
                    "x-client-id": "0000",
                    "Content-Type": "x-www-url-formurlencoded"
                },
                method: "PUT",
                data: JSON.stringify(data),
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        console.log(data);
                        if (data.code == 200) {
                            $("#save_btn").parent().addClass('success');
                            $("#save_btn").parent().removeClass('loading');
                            $("#save_btn").parent().removeClass('fail');

                            $('#flash_info').attr('hidden', "hidden");
                            $('#flash_info').removeClass('alert-danger').addClass('alert-success');
                            $("#msg").text(settings.i18n.translate('setting.item.1'));
                            $('#flash_info').removeAttr('hidden');

                            // Redirection vers la page
                            window.location.href = root_admin + '/settings/institution-names';
                        }

                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        $("#save_btn").parent().addClass('fail');
                        $("#save_btn").parent().removeClass('loading');
                        $("#save_btn").parent().removeClass('success');

                        if (jqXHR.responseJSON.code == 400 && jqXHR.responseJSON.description == "Currency alraidy exist") {
                            $('#flash_info').attr('hidden', "hidden");
                            $('#flash_info').removeClass('alert-success').addClass('alert-danger');
                            $("#msg").text("Erreur : Cette devise existe déjà.");
                            $('#flash_info').removeAttr('hidden');
                        } else {
                            $('#flash_info').attr('hidden', "hidden");
                            $('#flash_info').removeClass('alert-success').addClass('alert-danger');
                            $("#msg").text("Erreur : ...");
                            $('#flash_info').removeAttr('hidden');
                        }
                    });
        } catch (error) {
            console.log(error);
        }
    }
})(jQuery);