/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function($) {
    $(document).ready(function() {
        $("#l5").addClass('active');
        $("#l22").addClass('active');
        if (localStorage.admin_token) {
            // set up of ajouter user
            $("#ajouter").attr('href', root_admin + '/settings/security-clearances/add');

            getSecurityClearances(null);
            
            $('#listJobs').delegate('#action_edit_delete > ul > li:nth-child(5) > a', 'click', function() {
                id_status = $(this).attr('data-reject');
                line = $(this).attr('data-line');
            });
            $('#listJobs').delegate('a.activate_link', 'click', function() {
                id_ct = $(this).attr('data-reject');
                line = $(this).attr('data-line');
            });
            // disable a security clearance
            $('#deleteJob').click(function() {
                $(this).parent().addClass('loading');
                $(this).parent().removeClass('success');
                $(this).parent().removeClass('fail');
                console.log(id_status);
                console.log(line);
                disable_security_clearances(id_status, line);
            });                                
       
            $('#activateCt').click(function() {
                $(this).parent().addClass('loading');
                $(this).parent().removeClass('success');
                $(this).parent().removeClass('fail');
                console.log(id_ct);
                console.log(line);
                //if($(this).parent().hasClass('loading'))
                activate_security_clearances(id_ct, line);
            });
        
    $('span#status_approved').click(function(e) {
        e.preventDefault();
        $(this).parent().addClass('loading');
        console.info($(this));       
        $(this).toggleClass('filtered');
        $(this).parent().toggleClass('success');
        $('span#status_pending').removeClass('filtered');
        $('span#status_pending').parent().removeAttr('class');
        if ($(this).hasClass('filtered')) {
            getSecurityClearances(1);
            $(this).parent().addClass('success');
            $(this).parent().removeClass('loading');
        }else{
            getSecurityClearances(null);
            $(this).parent().removeClass('success');
            $(this).parent().removeClass('loading');
        }
    });
    $('span#status_pending').click(function(e) {
         e.preventDefault();
        $(this).parent().addClass('loading'); 
        console.info($(this));       
        $(this).toggleClass('filtered');
        $(this).parent().toggleClass('success');
        $('span#status_approved').removeClass('filtered');
        $('span#status_approved').parent().removeAttr('class');
        if ($(this).hasClass('filtered')) {
            getSecurityClearances(0);
            $(this).parent().addClass('success');
            $(this).parent().removeClass('loading');
        }else{
            getSecurityClearances(null);
            $(this).parent().removeClass('success');
            $(this).parent().removeClass('loading');
        }
    });       
     } else {
        //Redirection vers la page de login
        window.location.href = root_admin + '/login';
    } 
    function getSecurityClearances(param){
        //var table;
        $.fn.dataTable.ext.errMode = 'throw'; //throw error on console
        
           var table = $('#listJobs').DataTable( {
                "processing": true,
                "serverSide": true,
                'info': true,
                "pagingType": "simple",
                "lengthChange": false,
                "searching": true,
                ajax:{
                    url: "../js/settings/securityclearances/server-side-processing.php", // Change this URL to where your json data comes from
                    type: "GET", // This is the default value, could also be POST, or anything you want.
                    data: function(d) {
                        if(param!=null){
                            d.is_active = param;
                        }
                    }

                },
                "destroy": true,               
                "order": [[0, 'asc']],
                "columnDefs": [                            
                    {
                        // The `data` parameter refers to the data for the cell (defined by the
                        // `data` option, which defaults to the column being worked with, in
                        // this case `data: 0`.
                        "render": function ( data, type, row ) { 
                            var html = "<div class='btn-group' style='display:block;' id='action_edit_delete'>";
                            html += "<button class='btn btn-default' type='button'>Actions</button>";
                            html += "<button class='btn btn-default btn-flat dropdown-toggle' data-toggle='dropdown' type='button' aria-expanded='false'>";
                            html += "<span class='caret'></span>";
                            html +="<span class='sr-only'>Toggle Dropdown</span></button>";
                            html += "<ul class='dropdown-menu' role='menu'>";
                            html += "<li><a href='"+root_admin+"/settings/security-clearances/"+row[2]+"' class='userProfil'>Edit</a></li>";
                            html += " <li class='divider unactive'></li>";
                            //if(row[1]==0){
                                html += "<li class='unactive'><a href='#activate' class='activate_link' data-toggle='modal'>Activate</a></li>";
                           // }else{
                                html += "<li class='divider activ'></li><li class='activ'><a href='#declined'data-toggle='modal'>Disable</a></li>";
                           // }                                                        
                            html += "</ul>";
                            html += "<span class='activate_status' data-content='"+row[1]+"' style='display:none'></span></div>";
                            //return '<span class="label label-success">' + row[1] + '</span>';  
                            return html;
                        },
                        "targets": 2 ,
                        "orderable": false
                   },
                    {
                        // The `data` parameter refers to the data for the cell (defined by the
                        // `data` option, which defaults to the column being worked with, in
                        // this case `data: 0`.
                        "render": function ( data, type, row ) {
                            if(row[1] == 1){
                                return '<span class="label label-success">ACTIVE</span>';
                            }else{
                                return '<span class="label label-default">PENDING</span>';
                            }                                                          
                        },
                        "targets": 1
                    }
                ]
                ,
                "fnDrawCallback": function( oSettings ) {
                    //var record_count = this.fnSettings().fnRecordsTotal();                    
                    var data = oSettings.json.data;
                    for(var i =0;i<data.length;i++){
                        //console.info(data[i][2]);
                        formattage(i+1,data[i][2]);
                    }
                    console.log(oSettings.json.data);
                }
            } );
            //console.log(table);
    }
            function formattage(i, id_security_clearance) {
                try {            
                    var is_active = $('#listJobs > tbody > tr:nth-child(' + i + ')').find('.activate_status').data('content');
                    console.log(is_active);
                    if (is_active != 0) {
                        $('#listJobs > tbody > tr:nth-child(' + i + ')').find('.unactive').css('display', 'none');
                        $('#listJobs > tbody > tr:nth-child(' + i + ')').find('.activ').css('display', 'block');

                    } else {
                        $('#listJobs > tbody > tr:nth-child(' + i + ')').find('.unactive').css('display', 'block');
                        $('#listJobs > tbody > tr:nth-child(' + i + ')').find('.activ').css('display', 'none');
                    }
                    // Placement des marqueurs sur les boutons
                    $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(3) > #action_edit_delete > ul > li:nth-child(5) > a').attr('data-reject', id_security_clearance);
                    $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(3) > #action_edit_delete > ul > li:nth-child(3) > a').attr('data-reject', id_security_clearance);            
                    $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(3) > #action_edit_delete > ul > li:nth-child(5) > a').attr('data-line', i);
                    $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(3) > #action_edit_delete > ul > li:nth-child(3) > a').attr('data-line', i);
                } catch (error) {
                    console.log('error');
                }
            }
    function disable_security_clearances(id, line) {
        try {
            var uri;

            uri = config.api_url + '/security-clearance-levels/' + id + '/disapprove';
            console.log(uri);
            $.ajax({
                url: uri,
                method: "POST",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                crossDomain: true
            })
            .done(function(data, textStatus, jqXHR) {
                console.log(data);
                if (data.code == 200) {
                    $('#deleteJob').parent().addClass('success');
                    $('#deleteJob').parent().removeClass('loading');
                    $('#deleteJob').parent().removeClass('fail');

                    $('.close').trigger('click');
                    $('#listJobs > tbody > tr:nth-child(' + line + ')').find('.unactive').css('display', 'block');
                    $('#listJobs > tbody > tr:nth-child(' + line + ')').find('.activ').css('display', 'none');                   
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            });
        } catch (error) {
            console.log(error);
        }
    }
    function activate_security_clearances(id, line) {
        try {
            var uri;

            uri = config.api_url + '/security-clearance-levels/' + id + '/approve';
            console.log(uri);
            $.ajax({
                url: uri,
                method: "POST",
                data: {"id": id},
                dataType: "json",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                crossDomain: true
            })
            .done(function(data, textStatus, jqXHR) {
                console.log(data);

                $('#deleteUser').parent().addClass('success');
                $('#deleteUser').parent().removeClass('loading');
                $('#deleteUser').parent().removeClass('fail');

                $('.close').trigger('click');

                $('#listJobs > tbody > tr:nth-child(' + line + ')').find('.unactive').css('display', 'none');
                $('#listJobs > tbody > tr:nth-child(' + line + ')').find('.activ').css('display', 'block');
                //getLanguages(null);
                //$('span#status_pending').parent().removeClass('success');
                //$('span#status_approved').parent().removeClass('success');
                //$('#listJobs > tbody > tr:nth-child(' + line + ')>td:nth-child(2)>span').removeClass('label-default').addClass('label-success');
                //$('#listJobs > tbody > tr:nth-child(' + line + ')>td:nth-child(2)>span').text("ACTIVE");
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $('#profile_photo').removeClass('loading');
                $('#profile_photo').removeClass('success');
                $('#profile_photo').addClass('fail');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            });
        } catch (error) {
            console.log(error);
        }
    }
          
    function filter() {
        try {
            var role, url, params, status, state;

            paiement = '';
            role = '';
            state = '';
            status = '';

            role = $('.filter-role.selected').text();
            state = $('.filter-state.selected').text();
            status = $('.filter-status.selected').text();
            url = '/security-clearances';
            params = [];

            if (role.length > 0) {
                params.push('role=' + role);
            }
            if (state.length > 0) {
                params.push('active_status=' + state);
            }
            if (status.length > 0) {
                params.push('verified_status=' + status);
            }

            url = url + '?' + params.join('&');

            console.log(url);

            $('#next').attr('data-url', url);

            $('#next').trigger('click');
        } catch (error) {
            console.log(error);
        }
    }       
    });
})(jQuery);