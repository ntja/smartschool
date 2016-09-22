/**
 * Script for all courses
 */
(function($) {
    $(document).ready(function() {
    	$('.loader').hide();
        var base_url = $('body').attr('data-base-url'), form = $("#new-course"), account_id = Cookies.get('account_id'), token = Cookies.get('token');
        var user_role = window.localStorage.getItem('role'), category =$('select[name=category]').val(),language =$('select[name=language]').val();
        console.log(base_url);
    	if(!account_id || !token){
			window.location.assign(base_url+'/login');
		}                
        if(user_role != "INSTRUCTOR"){
            Cookies.remove('token');
            Cookies.remove('account_id');        
            uri = base_url+'/login';
            window.location.assign(uri);
        } 

        get_courses();
        
        $("#logout").click(function(){        
            logout();
        });
        
        $('select[name=language]').change(function() {
            language = $(this).val();
            console.log(language);
        });
        $('select[name=category]').change(function() {
            category = $(this).val();
            console.log(category);
        })
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
                name: {
                    required: true
                },
                shortname: {
                    required: true
                },
                category: {
                    required: false
                },
                shortdescription: {
                    required: true
                }
            }
    });

    // Custom Functions
    function get_courses() {
        url = config.api_url + '/courses';
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
            console.log(data);
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
        });
    }
    function create_course(data) {
        var url;
        url = config.api_url + '/courses';
        console.info(url);
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
            $('#close').trigger('click');
            form[0].reset();
            //get_data(account_id);
            alertNotify("Well done ! Your course has been created. You can add your first lesson by clicing here : <a href='"+base_url+data.links[1].href+"'>add your first lesson</a>", 'success');
        })

        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.status)
            $('.loader').fadeOut();
            var response = JSON.parse(jqXHR.responseText);
            console.info(response);
            if(response.code == 4001 || response.code == 4011 || response.code == 4012 || response.code == 4000){
                $('#close').trigger('click');
                alertNotify(response.description, 'error');                
            }else{
                $('#close').trigger('click');
                alertNotify("An internal error occurred. Please try again later", 'error');                
            }
        });
    }
    });    
})(jQuery);