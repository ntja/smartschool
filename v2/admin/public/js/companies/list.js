/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//#action_approve_reject > ul > li:nth-child(3) > a

(function($) {
    $(document).ready(function() {
        $("#l3").addClass('active');
        if (localStorage.admin_token) {
            
            getCompanies(null);
            //get_companies('next');
            
            
            $('#status_approved').click(function(e) {
                e.preventDefault();
                $(this).parent().addClass('loading');
                console.info($(this));       
                $(this).toggleClass('filtered');
                $(this).parent().toggleClass('success');
                $('#status_pending').removeClass('filtered');
                $('#status_pending').parent().removeAttr('class');
                if ($(this).hasClass('filtered')) {
                    getCompanies("APPROVED");
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                }else{
                    getCompanies(null);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });
            $('#status_pending').click(function(e) {
                e.preventDefault();
                $(this).parent().addClass('loading'); 
                console.info($(this));       
                $(this).toggleClass('filtered');
                $(this).parent().toggleClass('success');
                $('#status_approved').removeClass('filtered');
                $('#status_approved').parent().removeAttr('class');
                if ($(this).hasClass('filtered')) {
                    getCompanies("PENDING");
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                }else{
                    getCompanies(null);
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });   
            
            /*
            // Filter by status
            $('#status_pending').click(function() {
                $(this).toggleClass('filter-status selected');
                $('#status_verified').removeClass('filter-status selected');
                $('#status_verified').parent().removeAttr('class');
                $(this).parent().addClass('loading');
                //filter();
                getCompanies("PENDING");
                if ($(this).hasClass('filter-status')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });


            $('#status_approved').click(function() {
                $(this).toggleClass('filter-status selected');
                $('#status_pending').removeClass('filter-status selected');
                $('#status_pending').parent().removeAttr('class');
                $(this).parent().addClass('loading');
                //filter();
                getCompanies("APPROVED");
                if ($(this).hasClass('filter-status')) {
                    $(this).parent().addClass('success');
                    $(this).parent().removeClass('loading');
                } else {
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('loading');
                }
            });
            */
            /*
            // Bouton suivant
            $('#next').click(function() {
                get_companies('next');
            });

            // Bouton précédent
            $('#previous').click(function() {
                get_companies('previous');
            });
            */

            // Get ads id of the reject line clicked
            $('#listCompanies').delegate('#action_detail_job_approve > ul > li:nth-child(4) > a', 'click', function() {
                id_cmp = $(this).attr('data-approve');
                line = $(this).attr('data-line');
            });


            // Rejeter un utilisateur
            $('#approveCmp').click(function() {
                $(this).parent().addClass('loading');
                $(this).parent().removeClass('success');
                $(this).parent().removeClass('fail');

                console.log(id_cmp);
                console.log(line);
                //if($(this).parent().hasClass('loading'))
                approve_company(id_cmp, line);
            });

            // set up of ajouter user
            $("#ajouter").attr('href', root_admin + '/companies/add');

        } else {
            //Redirection vers la page de login
            window.location.href = root_admin + '/login';
        }    
    function getCompanies(param){
        $.fn.dataTable.ext.errMode = 'throw';
        //table.destroy();
        console.log(param);
        table = $('#listCompanies').DataTable( {
            "processing": true,
            "serverSide": true,
            "pagingType": "simple",
            "destroy": true,
            "lengthChange": false,
            "searching": true,
            ajax:{
                url: "js/companies/server-side-processing.php", // Change this URL to where your json data comes from
                type: "GET", // This is the default value, could also be POST, or anything you want.
                data: function(d) {
                    if(param!=null){
                        d.status = param;
                    }
                }
            },
            "columnDefs": [
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        if(row[5] == "APPROVED"){
                            return '<span class="label label-success">' + row[5] + '</span>';
                        }else{
                            return '<span class="label label-default">' + row[5] + '</span>';
                        }                                                          
                    },
                    "targets": 5
                },
                {                            
                    "render": function ( data, type, row ) {
                        return '<a href="companies/'+row[6]+'">'+row[0]+'</a>';                                                                                        
                    },
                    "targets": 0
                },
                {                            
                    "render": function ( data, type, row ) {
                        return '<a href="users/'+row[7]+'">'+row[1]+'</a>';                                                                                        
                    },
                    "targets": 1
                },
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) { 
                        var html = "<div class='btn-group' style='display:none;' id='action_detail_job_approve'>";
                        html += "<button class='btn btn-default' type='button'>Actions</button>";
                        html += "<button class='btn btn-default btn-flat dropdown-toggle' data-toggle='dropdown' type='button' aria-expanded='false'>";
                        html += "<span class='caret'></span>";
                        html +="<span class='sr-only'>Toggle Dropdown</span></button>";
                        html += "<ul class='dropdown-menu' role='menu'>";
                        html+= "<li><a href='"+root_admin+"/companies/"+row[6]+"' class='userProfil'>Details</a></li>";
                        html+= "<li><a href='"+root_admin+"/companies/"+row[6]+"/jobs' class='userProfil'>Jobs</a></li>";                              
                        html+="<li class='divider'></li>";
                        html+="<li><a href='#approved' data-toggle='modal'>Approve</a></li>";
                        html += "</ul></div>";
                        html += "<div class='btn-group' style='display:none;' id='action_detail_job'>";
                        html += "<button class='btn btn-default' type='button'>Actions</button>";
                        html += "<button class='btn btn-default btn-flat dropdown-toggle' data-toggle='dropdown' type='button' aria-expanded='false'>";
                        html += "<span class='caret'></span>";
                        html +="<span class='sr-only'>Toggle Dropdown</span></button>";
                        html += "<ul class='dropdown-menu' role='menu'>";
                        html+= "<li><a href='"+root_admin+"/companies/"+row[6]+"' class='userProfil'>Details</a></li>";
                        html+= "<li><a href='"+root_admin+"/companies/"+row[6]+"/jobs' class='userProfil'>Jobs</a></li>";                                
                        html += "</ul></div>";
                        return html;
                    },
                    "width": "12%",
                    "targets": 6 ,
                    "orderable": false
               },
                { 
                    "visible": false,  
                    "targets": [7] 
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
            if ($('#listCompanies tr').length < 11) {
                $('.dataTables_paginate').hide();
            }            
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
            
    /*
    function get_companies(direction) {
        try {
            if ($('#' + direction).attr('data-url')) {

                var url = $('#' + direction).attr('data-url');
                //console.log(url);
                //console.log(root_api+url);
                $.ajax({
                    url: config.api_url + url,
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

                            $("#listCompanies").DataTable().destroy();
                            // Utilisation de jQueryTemplate
                            $("#listCompanies>tbody").loadTemplate($("#Ads"), data.items);

                            $('#listCompanies').dataTable({
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
                    url: config.api_url + '/companies',
                    method: "GET",
                    headers: {
                        "x-client-id": "0000",
                        "x-access-token": localStorage.admin_token
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

                            $("#listCompanies").DataTable().destroy();
                            // Utilisation de jQueryTemplate
                            $("#listCompanies>tbody").loadTemplate($("#Ads"), data.items);

                            $('#listCompanies').dataTable({
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

    */
   
   /*
    function formattage(count) {
        try {
            for (i = 1; i <= count; i++) {

                var id_company = $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > a').attr('value');
                var id_employer = $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(2) > a').attr('value');
                var status_selector = $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(6)');
                var status_value = status_selector.text();
                //console.log(status_value);

                // Set links in the first, second and last column
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > a').attr('href', root_admin + '/companies/' + id_company);
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(2) > a').attr('href', root_admin + '/users/' + id_employer);
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(1) > a').attr('href', root_admin + '/companies/' + id_company);
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(2) > a').attr('href', root_admin + '/companies/' + id_company + '/jobs');
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job > ul > li:nth-child(1) > a').attr('href', root_admin + '/companies/' + id_company);
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job > ul > li:nth-child(2) > a').attr('href', root_admin + '/companies/' + id_company + '/jobs');

                // marqueurs sur l'action "approve"
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(4) > a').attr('data-approve', id_company);
                $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(4) > a').attr('data-line', i);

                // make label in active status
                if (status_value == "PENDING") {
                    status_selector.html('<span class="label label-default">' + status_value + '</span>');
                    $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve').attr('style', 'display:block;');
                    $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job').attr('style', 'display:none;');
                }
                if (status_value == "APPROVED") {
                    status_selector.html('<span class="label label-success">' + status_value + '</span>');
                    $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve').attr('style', 'display:none;');
                    $('#listCompanies > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job').attr('style', 'display:block;');
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
            var url, params, status;

            status = '';

            status = $('.filter-status.selected').text();
            url = '/companies';
            params = [];


            if (status.length > 0) {
                params.push('status=' + status);
            }

            url = url + '?' + params.join('&');

            console.log(url);

            $('#next').attr('data-url', url);

            $('#next').trigger('click');
        } catch (error) {
            console.log(error);
        }
    }


    function approve_company(id, line) {
        try {
            var uri;

            uri = config.api_url + '/companies/' + id + '/approve';
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

                $('#approveCmp').parent().addClass('success');
                $('#approveCmp').parent().removeClass('loading');
                $('#approveCmp').parent().removeClass('fail');

                $('.close').trigger('click');

                $('#listCompanies > tbody > tr:nth-child(' + line + ') > td:nth-child(6)').html('<span class="label label-success">APPROVED</span>');

                // Modification du bouton d'action
                $('#listCompanies > tbody > tr:nth-child(' + line + ') > td:nth-child(7) > #action_detail_job_approve').attr('style', 'display:none;');
                $('#listCompanies > tbody > tr:nth-child(' + line + ') > td:nth-child(7) > #action_detail_job').attr('style', 'display:block;');
//							}
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
  });
})(jQuery);