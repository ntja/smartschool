/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//#action_approve_reject > ul > li:nth-child(3) > a

(function($) {
    $(document).ready(function() {
        $("#l2").addClass('active');
        if (localStorage.admin_token) {
            //if(localStorage.admin_role == "ADMINISTRATOR"){
            limit = 10;
            page = 1;
            //get_accounts('next');
            var param = new Object;
            getUsers(null);

            // Filter by role
            $('#role_administrator').click(function() {
                param.role = "ADMINISTRATOR";
                if ($('#subs_paid').hasClass('filter-subs')) {
                     param.subscription = "PAID";
                }
                if ($('#subs_unpaid').hasClass('filter-subs')) {
                     param.subscription = "UNPAID";
                }
                if ($('#state_disabled').hasClass('filter-state')) {
                    param.active_status = "DISABLED";
                }
                if ($('#state_active').hasClass('filter-state')) {
                    param.active_status = "ACTIVE";
                }
                $(this).toggleClass('filter-role selected');
                $('#role_employer').removeClass('filter-role selected');
                $('#role_candidate').removeClass('filter-role selected');

                $('#role_employer').parent().removeAttr('class');
                $('#role_candidate').parent().removeAttr('class');
                $(this).parent().addClass('loading');
                
                getUsers(param);
                //filter();
                
                if ($(this).hasClass('filter-role')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    delete param.role;
                    getUsers(param);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }

            });


            $('#role_employer').click(function() {
                param.role = "EMPLOYER";
                if ($('#subs_paid').hasClass('filter-subs')) {
                     param.subscription = "PAID";
                }
                if ($('#subs_unpaid').hasClass('filter-subs')) {
                     param.subscription = "UNPAID";
                }
                if ($('#state_disabled').hasClass('filter-state')) {
                    param.active_status = "DISABLED";
                }
                if ($('#state_active').hasClass('filter-state')) {
                    param.active_status = "ACTIVE";
                }
                $(this).toggleClass('filter-role selected');
                $('#role_administrator').removeClass('filter-role selected');
                $('#role_candidate').removeClass('filter-role selected');

                $('#role_administrator').parent().removeAttr('class');
                $('#role_candidate').parent().removeAttr('class');

                $(this).parent().addClass('loading');
                getUsers(param);
                //filter();
                if ($(this).hasClass('filter-role')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    delete param.role;
                    getUsers(param);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });


            $('#role_candidate').click(function() {
                param.role = "CANDIDATE";
                if ($('#subs_paid').hasClass('filter-subs')) {
                    param.subscription = "PAID";
                }
                if ($('#subs_unpaid').hasClass('filter-subs')) {
                     param.subscription = "UNPAID";
                }
                if ($('#state_disabled').hasClass('filter-state')) {
                    param.active_status = "DISABLED";
                }
                if ($('#state_active').hasClass('filter-state')) {
                    param.active_status = "ACTIVE";
                }
                if ($('#role_administrator').hasClass('filter-role')) {
                    param.role = "ADMINISTRATOR";
                }
                $(this).toggleClass('filter-role selected');
                $('#role_administrator').removeClass('filter-role selected');
                $('#role_employer').removeClass('filter-role selected');

                $('#role_administrator').parent().removeAttr('class');
                $('#role_employer').parent().removeAttr('class');

                $(this).parent().addClass('loading');
                getUsers(param);
                //filter();
                if ($(this).hasClass('filter-role')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    delete param.role;
                    getUsers(param);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });

            // Filter by status
            $('#subs_paid').click(function() {
                param.subscription = "PAID";
                if ($('#state_disabled').hasClass('filter-state')) {
                    param.active_status = "DISABLED";
                }
                if ($('#state_active').hasClass('filter-state')) {
                    param.active_status = "ACTIVE";
                }
                if ($('#role_administrator').hasClass('filter-role')) {
                    param.role = "ADMINISTRATOR";
                }
                if ($('#role_employer').hasClass('filter-role')) {
                    param.role = "EMPLOYER";
                }
                if ($('#role_candidate').hasClass('filter-role')) {
                    param.role = "CANDIDATE";
                }
                
                $(this).toggleClass('filter-subs selected');
                $('#subs_unpaid').removeClass('filter-subs selected');

                $('#subs_unpaid').parent().removeAttr('class');

                $(this).parent().addClass('loading');
                getUsers(param);
                //getUsers("subscription","PAID");
                //filter();
                if ($(this).hasClass('filter-subs')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    delete param.subscription;
                    getUsers(param);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });


            $('#subs_unpaid').click(function() {
                param.subscription = "UNPAID";
                if ($('#state_disabled').hasClass('filter-state')) {
                    param.active_status = "DISABLED";
                }
                if ($('#state_active').hasClass('filter-state')) {
                    param.active_status = "ACTIVE";
                }
                if ($('#role_administrator').hasClass('filter-role')) {
                    param.role = "ADMINISTRATOR";
                }
                if ($('#role_employer').hasClass('filter-role')) {
                    param.role = "EMPLOYER";
                }
                if ($('#role_candidate').hasClass('filter-role')) {
                    param.role = "CANDIDATE";
                }
                $(this).toggleClass('filter-subs selected');
                $('#subs_paid').removeClass('filter-subs selected');

                $('#subs_paid').parent().removeAttr('class');

                $(this).parent().addClass('loading');
                getUsers(param);
                //getUsers("subscription","UNPAID");
                //filter();
                if ($(this).hasClass('filter-subs')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    delete param.subscription;
                    getUsers(param);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });

            // Filter by state
            $('#state_disabled').click(function() {
                param.active_status = "DISABLED";
                if ($('#role_administrator').hasClass('filter-role')) {
                    param.role = "ADMINISTRATOR";
                }
                if ($('#role_employer').hasClass('filter-role')) {
                    param.role = "EMPLOYER";
                }
                if ($('#role_candidate').hasClass('filter-role')) {
                    param.role = "CANDIDATE";
                }
                if ($('#subs_paid').hasClass('filter-subs')) {
                    param.subscription = "PAID";
                }
                if ($('#subs_unpaid').hasClass('filter-subs')) {
                     param.subscription = "UNPAID";
                }
                
                $(this).toggleClass('filter-state selected');
                $('#state_active').removeClass('filter-state selected');

                $('#state_active').parent().removeAttr('class');

                $(this).parent().addClass('loading');
                getUsers(param);
                //getUsers("active_status","DISABLED");
                //filter();
                if ($(this).hasClass('filter-state')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    delete param.active_status;
                    getUsers(param);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });

            $('#state_active').click(function() {
                param.active_status = "ACTIVE";
                if ($('#role_administrator').hasClass('filter-role')) {
                    param.role = "ADMINISTRATOR";
                }
                if ($('#role_employer').hasClass('filter-role')) {
                    param.role = "EMPLOYER";
                }
                if ($('#role_candidate').hasClass('filter-role')) {
                    param.role = "CANDIDATE";
                }
                if ($('#subs_paid').hasClass('filter-subs')) {
                    param.subscription = "PAID";
                }
                if ($('#subs_unpaid').hasClass('filter-subs')) {
                     param.subscription = "UNPAID";
                }
                $(this).toggleClass('filter-state selected');
                $('#state_disabled').removeClass('filter-state selected');

                $('#state_disabled').parent().removeAttr('class');

                $(this).parent().addClass('loading');
                getUsers(param);
                //getUsers("active_status","ACTIVE");
                //filter();
                if ($(this).hasClass('filter-state')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    delete param.active_status;
                    getUsers(param);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });



            /*
            // Bouton suivant
            $('#next').click(function() {
                get_accounts('next');
            });

            // Bouton précédent
            $('#previous').click(function() {
                get_accounts('previous');
            });
            */
            /* Admin cannot delete an account
            // Get ads id of the reject line clicked
            $('#listUsers').delegate('#action_detail > ul > li:nth-child(4) > a', 'click', function() {
                id_user = $(this).attr('data-delete');
                line = $(this).attr('data-line');
            });
            
            */

            /* we disabled this functionality 
            // Rejeter un utilisateur
            $('#deleteUser').click(function() {
                $(this).parent().addClass('loading');
                $(this).parent().removeClass('success');
                $(this).parent().removeClass('fail');

                console.log(id_user);
                console.log(line);
                //if($(this).parent().hasClass('loading'))
                delete_user(id_user, line);
            });
            */
            /*
            if (localStorage.admin_role == "MODERATOR") {
                $("#ajouter").attr('style', 'display:none');
            }
            */
            
            /* set up of ajouter user
            $("#ajouter").attr('href', root_admin + '/users/add');
            */
   
            /*
            // activer la recherche
            $("#search").keypress(function(e) {
                if (e.keyCode == 13) {
                    query = $("#search").val();
                    if (query.length == 0) {
                        get_accounts('next');
                    } else {
                        search(query);
                    }
                }
            });
            */
            //}else{
            // Redirection vers la page de login
            //window.location.href = root_admin + '/dashboard';
            //}
        } else {
            //Redirection vers la page de login
            window.location.href = root_admin + '/login';
        }    
        
    function getUsers(param){
        $.fn.dataTable.ext.errMode = 'throw';
        //table.destroy();
        console.log(param);
        table = $('#listUsers').DataTable( {
            "processing": true,
            "serverSide": true,
            "pagingType": "simple",
            "destroy": true,
            "lengthChange": false,
            "searching": true,
            ajax:{
                url: "js/users/server-side-processing.php", // Change this URL to where your json data comes from
                type: "GET", // This is the default value, could also be POST, or anything you want.
                data: function(d) {
                    if(param!=null){
                        if("role" in param){
                            d.role = param.role;   
                        } 
                        if("active_status" in param){
                            d.active_status = param.active_status;   
                        }
                        if("subscription" in param){
                            d.subscription = param.subscription;   
                        }                        
                    }
                }
            },
            "columnDefs": [
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        if(row[3] == "CANDIDATE"){
                            return '<span class="label label-success">' + row[3] + '</span>';
                        }else if(row[3] == "EMPLOYER"){
                            return '<span class="label label-warning">' + row[3] + '</span>';
                        }else if(row[3] == "ADMINISTRATOR"){
                            return '<span class="label label-danger">' + row[3] + '</span>';
                        }else{
                            return '<span class="label label-info">' + row[3] + '</span>';
                        }                                                          
                    },
                    "targets": 3
                },
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        if(row[4] == "PAID"){
                            return '<span class="label label-success">' + row[4] + '</span>';
                        }else{
                            return '<span class="label label-default">' + row[4] + '</span>';
                        }                                                          
                    },
                    "targets": 4
                },
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        if(row[5] == "ACTIVE"){
                            return '<span class="label label-success">' + row[5] + '</span>';
                        }else{
                            return '<span class="label label-default">' + row[5] + '</span>';
                        }                                                          
                    },
                    "targets": 5
                },
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) { 
                        var html = "<div class='btn-group' style='display:block;' id='action_detail'>";
                        html += "<button class='btn btn-default' type='button'>Actions</button>";
                        html += "<button class='btn btn-default btn-flat dropdown-toggle' data-toggle='dropdown' type='button' aria-expanded='false'>";
                        html += "<span class='caret'></span>";
                        html +="<span class='sr-only'>Toggle Dropdown</span></button>";
                        html += "<ul class='dropdown-menu' role='menu'>";
                        html+= "<li><a href='"+root_admin+"/users/"+row[6]+"' class='userProfil'>Details</a></li>";
                        html += "</ul></div>";
                        return html;
                    },
                    "targets": 6 ,
                    "orderable": false
               },
                { 
                    "visible": false,  
                    "targets": [] 
                }
            ],
            "fnDrawCallback": function( oSettings ) {
            //var record_count = this.fnSettings().fnRecordsTotal();                    
            var data = oSettings.json.data;
            for(var i =0;i<data.length;i++){
                //console.info(data[i][2]);
                formattage(i+1,data[i][6]);
            }
            console.log(data);
            /*
            if ($('#listUsers tr').length < 11) {
                $('.dataTables_paginate').hide();
            }    
            */
         }
    });               

    }
    function formattage(i, id_company) {
        try {               
            var status_selector = $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(6)');
            var status_value = status_selector.text();
            console.log(status_value);
            //            
            // marqueurs sur l'action "approve"
            $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(4) > a').attr('data-approve', id_company);
            $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(4) > a').attr('data-line', i);

            // make label in active status
            if (status_value == "PENDING") {
                //status_selector.html('<span class="label label-default">' + status_value + '</span>');
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve').attr('style', 'display:block;');
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job').attr('style', 'display:none;');
            }
            if (status_value == "APPROVED") {
               // status_selector.html('<span class="label label-success">' + status_value + '</span>');
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve').attr('style', 'display:none;');
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job').attr('style', 'display:block;');
            }
            // End
        } catch (error) {
            console.log('error');
        }
    }
    function get_accounts(direction) {
        try {
            if ($('#' + direction).attr('data-url')) {

                var uri = config.api_url + $('#' + direction).attr('data-url');
                //console.log(url);
                //console.log(root_api+url);
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
                            //console.log(data);

                            if (data.next) {
                                $('#next').attr('data-url', data.next);
                                $('#next').removeAttr('hidden');
                            } else {
                                $('#next').attr('hidden', 'hidden');
                            }

                            if (data.back) {
                                $('#previous').attr('data-url', data.back);
                                $('#previous').removeAttr('hidden');
                            } else {
                                $('#previous').attr('hidden', 'hidden');
                            }


                            // if((data.pagination.page + 1) <= data.pagination.last_page){
                            // //page = data.pagination.page+1;
                            // $('#next').attr('data-url', '/persons?page='+(data.pagination.page + 1));
                            // $('#next').removeAttr('hidden');
                            // }else{
                            // $('#next').attr('hidden', 'hidden');
                            // }

                            // if((data.pagination.page - 1) > 0){
                            // page = data.pagination.page-1;
                            // $('#previous').attr('data-url', '/persons?page='+(data.pagination.page - 1));
                            // $('#previous').removeAttr('hidden');
                            // }else{
                            // $('#previous').attr('hidden', 'hidden');
                            // }

                            //prev_list = root_api+data.previous ;

                            $("#listUsers").DataTable().destroy();
                            // Utilisation de jQueryTemplate
                            $("#listUsers>tbody").loadTemplate($("#Ads"), data.items);

                            $('#listUsers').dataTable({
                                "deferRender": true,
                                "columnDefs": [
                                    {"targets": 6, "orderable": false}
                                ],
                                "autoWidth": true, // largeur des colonnes automatique
                                "lengthChange": false, // utilisateur peut modifier le nombre de items per page
                                "paging": false, // Disable pagination
                                "processing": true, // Indicate the processing
                                "ordering": true,
                                "info": false,
                                "searching": false
                            });

                            // Formattage du rendu
                            var items = data.items.length;
                            formattage(items);
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == '400') {

                            }
                        })
                        .always();
            } else {
                $.ajax({
                    url: config.api_url + '/accounts',
                    method: "GET",
                    headers: {
                        "x-client-id": "0000",
                        "x-access-token": localStorage.admin_token
                    },
                    data: {
                        "limit": limit
                    },
                    crossDomain: true
                })
                        .done(function(data, textStatus, jqXHR) {

                            console.log(data);
                            $('#next').attr('data-url', data.next);

                            if (data.next) {
                                $('#next').attr('data-url', data.next);
                                $('#next').removeAttr('hidden');
                            } else {
                                $('#next').attr('hidden', 'hidden');
                            }

                            if (data.back) {
                                $('#previous').attr('data-url', data.back);
                                $('#previous').removeAttr('hidden');
                            } else {
                                $('#previous').attr('hidden', 'hidden');
                            }

                            // if((data.pagination.page + 1) <= data.pagination.last_page){
                            // //page = data.pagination.page+1;
                            // $('#next').attr('data-url', '/persons?page='+(data.pagination.page + 1));
                            // $('#next').removeAttr('hidden');
                            // }else{
                            // $('#next').attr('hidden', 'hidden');
                            // }

                            // if((data.pagination.page - 1) > 0){
                            // //page = data.pagination.page-1;
                            // $('#previous').attr('data-url', '/persons?page='+(data.pagination.page - 1));
                            // $('#previous').removeAttr('hidden');
                            // }else{
                            // $('#previous').attr('hidden', 'hidden');
                            // }

                            $("#listUsers").DataTable().destroy();
                            // Utilisation de jQueryTemplate
                            $("#listUsers>tbody").loadTemplate($("#Ads"), data.items);

                            $('#listUsers').dataTable({
                                "deferRender": true,
                                "columnDefs": [
                                    {"targets": 6, "orderable": false}
                                ],
                                "autoWidth": true, // largeur des colonnes automatique
                                "lengthChange": false, // utilisateur peut modifier le nombre de items per page
                                "paging": false, // Disable pagination
                                "processing": true, // Indicate the processing
                                "ordering": true,
                                "info": false,
                                "searching": false
                            });

                            // Formattage du rendu
                            var items = data.items.length;
                            formattage(items);


                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status == '400') {

                            }
                        });
            }
        } catch (error) {
            console.log(error);
        }
    }
    
    /*
    function formattage(count) {
        try {
            for (i = 1; i <= count; i++) {

                var id_account = $('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > span').attr('id');
                var login_user = $('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > a').text();
                var role_selector = $('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(4)');
                var role_value = role_selector.text();
                var subscription_selector = $('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(5)');
                var subscription_value = subscription_selector.text();
                var actv_status_selector = $('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(6)');
                var actv_status_value = actv_status_selector.text();
                //console.log(role_value);

                // Set a link in the ads options
                $('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail > ul > li:nth-child(1) > a').attr('href', root_admin + '/users/' + id_account);
                
                // edit user option - disabled
                //$('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail > ul > li:nth-child(2) > a').attr('href', root_admin + '/users/' + id_account + '/edit');

                // Placement des marqueurs sur les bouton approve
                //$('#listUsers > tbody > tr:nth-child('+i+') > td:nth-child(6) > #action_approve_reject > ul > li:nth-child(3) > a').attr('data-accept', id_ads );
                //$('#listUsers > tbody > tr:nth-child('+i+') > td:nth-child(6) > #action_approve_reject > ul > li:nth-child(3) > a').addClass('accpetUser');

                // Placement des marqueurs sur les bouton reject
                //$('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail > ul > li:nth-child(4) > a').attr('data-delete', id_account);
                // $('#listUsers > tbody > tr:nth-child('+i+') > td:nth-child(4) > #action_detail_delete > ul > li:nth-child(3) > a').attr('data-role', role_value);
                //$('#listUsers > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail > ul > li:nth-child(4) > a').attr('data-line', i);

                // make label in role
                if (role_value == "CANDIDATE") {
                    role_selector.html('<span class="label label-success">' + role_value + '</span>');
                    // $('#listUsers > tbody > tr:nth-child('+i+') > td:nth-child(4) > #action_detail_delete > ul > li:nth-child(2)').attr('style', "display:none;");
                    // $('#listUsers > tbody > tr:nth-child('+i+') > td:nth-child(4) > #action_detail_delete > ul > li:nth-child(3)').attr('style', "display:none;");
                }
                if (role_value == "ADMINISTRATOR") {
                    role_selector.html('<span class="label label-danger">' + role_value + '</span>');
                }
                if (role_value == "EMPLOYER") {
                    role_selector.html('<span class="label label-warning">' + role_value + '</span>');
                }
                // End

                // make label in verified status
                if (subscription_value == "PAID") {
                    subscription_selector.html('<span class="label label-success">' + subscription_value + '</span>');
                }
                if (subscription_value == "UNPAID") {
                    subscription_selector.html('<span class="label label-default">' + subscription_value + '</span>');
                }
                // End

                // make label in active status
                if (actv_status_value == "DISABLED") {
                    actv_status_selector.html('<span class="label label-danger">' + actv_status_value + '</span>');
                }
                if (actv_status_value == "ACTIVE") {
                    actv_status_selector.html('<span class="label label-success">' + actv_status_value + '</span>');
                }
                // End
            }
        } catch (error) {
            console.log('error');
        }
    }
    */
    function filter() {
        try {
            var role, url, params, status, state, subs;

            subs = '';
            role = '';
            state = '';
            status = '';

            role = $('.filter-role.selected').text();
            state = $('.filter-state.selected').text();
            status = $('.filter-status.selected').text();
            subs = $('.filter-subs.selected').text();
            url = '/accounts';
            params = [];

            if (role.length > 0) {
                params.push('role=' + role);
            }
            if (state.length > 0) {
                params.push('active=' + state);
            }
            if (status.length > 0) {
                params.push('verified=' + status);
            }
            if (subs.length > 0) {
                params.push('subscription=' + subs);
            }

            url = url + '?' + params.join('&');

            console.log(url);

            $('#next').attr('data-url', url);

            $('#next').trigger('click');
        } catch (error) {
            console.log(error);
        }
    }

    /*
     *
    function delete_user(id, line) {
        try {
            var uri;

            uri = config.api_url + '/accounts/' + id + '/decline';
            console.log(uri);
            $.ajax({
                url: uri,
                method: "DELETE",
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
                            $('#deleteUser').parent().addClass('success');
                            $('#deleteUser').parent().removeClass('loading');
                            $('#deleteUser').parent().removeClass('fail');

                            $('.close').trigger('click');

                            $('#listUsers > tbody > tr:nth-child(' + line + ')').attr('hidden', 'hidden');
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    })
        } catch (error) {
            console.log(error);
        }
    }
    
    */
    /*
    function search(query) {
        try {
            var uri;

            uri = config.api_url + '/accounts/search';
            $.ajax({
                url: uri,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                crossDomain: true,
                data: {
                    "query": query
                }
            })

                    .done(function(data, textStatus, jqXHR) {
                        console.log(data);
                        $("#listUsers").DataTable().destroy();
                        // Utilisation de jQueryTemplate
                        $("#listUsers>tbody").loadTemplate($("#Ads"), data);

                        $('#listUsers').dataTable({
                            "deferRender": true,
                            "columnDefs": [
                                {"targets": 5, "orderable": false}
                            ],
                            "autoWidth": true, // largeur des colonnes automatique
                            "lengthChange": false, // utilisateur peut modifier le nombre de items per page
                            "paging": false, // Disable pagination
                            "processing": true, // Indicate the processing
                            "ordering": true,
                            "info": false,
                            "searching": false
                        });

                        // Formattage du rendu
                        var items = data.length;
                        formattage(items);
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
    
    */
    });
})(jQuery);