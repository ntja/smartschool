/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//#action_approve_reject > ul > li:nth-child(3) > a

(function($){
    $(document).ready(function(){
    	//$("#l3").addClass('active');
        if(localStorage.admin_token){			
            /* Get Current URL */
            var url = $.url();

            /* Get id skill from URL */
            cmp_id = url.segment(-2);

            //get_companies('next');
             //calling get_job function
            get_jobs(null);
            
            // Filter by status
                $('#status_opened').click(function() {
                    $(this).toggleClass('filter-status selected');
                    $('#status_closed').removeClass('filter-status selected');
                    $('#status_closed').parent().removeAttr('class');

                    $(this).parent().addClass('loading');                
                    if ($(this).hasClass('filter-status')) {
                        //calling get_job function
                        get_jobs("OPEN");
                        $(this).parent().addClass('success');
                        $(this).parent().removeClass('loading');
                    } else {
                        //calling get_job function
                        get_jobs(null);
                        $(this).parent().removeClass('success');
                        $(this).parent().removeClass('loading');
                    }
                });

                $('#status_closed').click(function() {
                    $(this).toggleClass('filter-status selected');
                    $('#status_opened').removeClass('filter-status selected');

                    $('#status_opened').parent().removeAttr('class');

                    $(this).parent().addClass('loading');                
                    if ($(this).hasClass('filter-status')) {
                        //calling get_job function
                        get_jobs("CLOSED");
                        $(this).parent().addClass('success');
                        $(this).parent().removeClass('loading');
                    } else {
                        //calling get_job function
                        get_jobs(null);
                        $(this).parent().removeClass('success');
                        $(this).parent().removeClass('loading');
                    }
                });
            
            /*
            // Filter by status
            $('#status_opened').click(function () {
                    $(this).toggleClass('filter-status selected');
                    $('#status_closed').removeClass('filter-status selected');

                    $('#status_closed').parent().removeAttr('class');

                    $(this).parent().addClass('loading');
                    filter();
                    if($(this).hasClass('filter-status')){
                            $(this).parent().addClass('success');
                            $(this).parent().removeClass('loading');
                    }else{
                            $(this).parent().removeClass('success');
                            $(this).parent().removeClass('loading');
                    }
            });
            */
            
            /*
            $('#status_closed').click(function () {
                    $(this).toggleClass('filter-status selected');
                    $('#status_opened').removeClass('filter-status selected');

                    $('#status_opened').parent().removeAttr('class');

                    $(this).parent().addClass('loading');
                    filter();
                    if($(this).hasClass('filter-status')){
                            $(this).parent().addClass('success');
                            $(this).parent().removeClass('loading');
                    }else{
                            $(this).parent().removeClass('success');
                            $(this).parent().removeClass('loading');
                    }
            });
            */
            /*
            // Bouton suivant
            $('#next').click(function(){
                    get_companies('next');
            });

            // Bouton précédent
            $('#previous').click(function(){
                    get_companies('previous');
            });
            */
            /*
            // Get ads id of the reject line clicked
            $('#listJobs').delegate('#action_detail_delete > ul > li:nth-child(3) > a', 'click', function(){
                    id_user = $(this).attr('data-reject');
                    role_user = $(this).attr('data-role');
                    line = $(this).attr('data-line');
                    // lower case +s
                    role = role_user.toLowerCase(role_user)+'s';
            });
            */
            /*
            // Rejeter un utilisateur
            $('#deleteUser').click(function(){
                    $(this).parent().addClass('loading');
                    $(this).parent().removeClass('success');
                    $(this).parent().removeClass('fail');

                    console.log(id_user);
                    console.log(role);
                    console.log(line);
                    //if($(this).parent().hasClass('loading'))
                    delete_user(id_user, role, line);
            });			
            */
        }else{
            //Redirection vers la page de login
            window.location.href = root_admin + '/login';
        }  
        
        function get_jobs(param){
                $.fn.dataTable.ext.errMode = 'throw';
                //table.destroy();
                console.log(param);
                table = $('#listJobs').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "pagingType": "simple",
                    "destroy": true,
                    "lengthChange": false,
                    "searching": true,
                    "info" : false,
                    ajax:{
                        url: "../../js/jobs/server-side-processing.php", // Change this URL to where your json data comes from
                        type: "GET", // This is the default value, could also be POST, or anything you want.
                        data: function(d) {
                            d.company = cmp_id;
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
                                if(row[4] == 0.00){
                                    return 'Below $'+parseInt(row[5]);
                                }else if(row[5] == 1000000.00){
                                    return 'Above $'+parseInt(row[4]);
                                }else{
                                    return '$'+parseInt(row[4])+' - $'+ parseInt(row[5]);
                                }                            
                            },
                            "targets": 3
                        },
                        {
                            // The `data` parameter refers to the data for the cell (defined by the
                            // `data` option, which defaults to the column being worked with, in
                            // this case `data: 0`.
                            "render": function ( data, type, row ) {
                                if(row[8] == "OPEN"){
                                    return '<span class="label label-success">' + row[8] + '</span>';
                                }else{
                                    return '<span class="label label-default">' + row[8] + '</span>';
                                }                                                          
                            },
                            "targets": 8
                        },
                        {
                            // The `data` parameter refers to the data for the cell (defined by the
                            // `data` option, which defaults to the column being worked with, in
                            // this case `data: 0`.
                            "render": function ( data, type, row ) {
                                return '<a href="companies/'+row[9]+'">'+row[0]+'</a>';                                                                                        
                            },
                            "targets": 0
                        },
                        { 
                            'orderData':[4], 
                            'targets': [3] 
                        },
                        { 
                            "visible": false,  
                            "targets": [ 4,5,9] 
                        }
                    ]
                } );               

            }
            
    /*
    function get_companies(direction){
        try{
            if($('#'+direction).attr('data-url')){
            
				var url = $('#'+direction).attr('data-url');
				//console.log(url);
				//console.log(root_api+url);
				$.ajax({
					url: config.api_url+url,
					async: true,
					headers: {
						"x-access-token": localStorage.admin_token,
						"x-client-id": "0000"
					},
					method: "GET",
					crossDomain: true
				})
					.done(function(data, textStatus, jqXHR){
						//console.log(data);
						
						if(data.next){
							$('#next').attr('data-url', data.next);
							$('#next').removeAttr('hidden');
						}else{
							$('#next').attr('hidden', 'hidden');
						}
						
						if(data.back){
							$('#previous').attr('data-url', data.back);
							$('#previous').removeAttr('hidden');
						}else{
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
						
						//prev_list = root_api+data.back ;
						
						$("#listJobs").DataTable().destroy();
						 // Utilisation de jQueryTemplate
						$("#listJobs>tbody").loadTemplate($("#Ads"), data.items);

						$('#listJobs').dataTable( {
							"deferRender": true,
							"columnDefs": [
								{ "targets": 7, "orderable": false }
							],
							"autoWidth": true, // largeur des colonnes automatique
							"lengthChange": false, // utilisateur peut modifier le nombre de items per page
							"paging": false,     // Disable pagination
							"processing": true,      // Indicate the processing
							"ordering": true,
							"info": false,
							"searching": false
						} );
						
						// Formattage du rendu
						var items = data.count;
						formattage(items);
					})
					.fail(function(jqXHR, textStatus, errorThrown){
						if(jqXHR.status == '400'){

						}
					})
					.always();
			}else{
				$.ajax({
					url: config.api_url+'/companies/'+cmp_id+'/jobs',
					method: "GET",
					headers: {
							"x-client-id": "0000",
							"x-access-token": localStorage.admin_token
					},
					crossDomain: true
				})
					.done(function(data, textStatus, jqXHR){
						
						console.log(data);
						$('#next').attr('data-url', data.next);
						
						if(data.next){
							$('#next').attr('data-url', data.next);
							$('#next').removeAttr('hidden');
						}else{
							$('#next').attr('hidden', 'hidden');
						}

						if(data.back){
							$('#previous').attr('data-url', data.back);
							$('#previous').removeAttr('hidden');
						}else{
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

						$("#listJobs").DataTable().destroy();
						// Utilisation de jQueryTemplate
						$("#listJobs>tbody").loadTemplate($("#Ads"), data.items);

						$('#listJobs').dataTable( {
							"deferRender": true,
							"columnDefs": [
								{ "targets": 7, "orderable": false }
							],
							"autoWidth": true, // largeur des colonnes automatique
							"lengthChange": false, // utilisateur peut modifier le nombre de items per page
							"paging": false,     // Disable pagination
							"processing": true,      // Indicate the processing
							"ordering": true,
							"info": false,
							"searching": false
						} );

						// Formattage du rendu
						var items = data.count;
						formattage(items);


					})
					.fail(function(jqXHR, textStatus, errorThrown){
						if(jqXHR.status == '400'){

						}
					});
			}
        }catch(error){
            console.log(error);
        }
    }
    */
    /*
    function formattage(count){
        try{
            for(i=1; i<=count; i++){

                var id_company = $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > a').attr('value');
				var id_employer = $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(2) > a').attr('value');
				var status_selector = $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7)');
				var status_value = status_selector.text();
				//console.log(status_value);

				// Set links in the first, second and last column
				$('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > a').attr('href', root_admin+'/companies/'+id_company);
				$('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(2) > a').attr('href', root_admin+'/users/'+id_employer);
				$('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(1) > a').attr('href', root_admin+'/companies/'+id_company);
				$('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve > ul > li:nth-child(2) > a').attr('href', root_admin+'/companies/'+id_company+'/jobs');
				$('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job > ul > li:nth-child(1) > a').attr('href', root_admin+'/companies/'+id_company);
				$('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job > ul > li:nth-child(2) > a').attr('href', root_admin+'/companies/'+id_company+'/jobs');
				
				
				// make label in active status
                if(status_value == "CLOSE"){
                    status_selector.html('<span class="label label-default">'+status_value+'</span>');
					// $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve').attr('style', 'display:block;');
					// $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job').attr('style', 'display:none;');
                }
                if(status_value == "OPEN"){
                    status_selector.html('<span class="label label-success">'+status_value+'</span>');
					// $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job_approve').attr('style', 'display:none;');
					// $('#listJobs > tbody > tr:nth-child(' + i + ') > td:nth-child(7) > #action_detail_job').attr('style', 'display:blcok;');
                }
                // End
            }
        }catch(error){
            console.log('error');
        }
    }
    */
    /*
    function filter() {
        try {
            var url, params, status;

			status = '';

			status = $('.filter-status.selected').text();
            url = '/companies/'+cmp_id+'/jobs';
            params = [];

            
			if (status.length > 0) {
                params.push('status=' + status);
            }

            url = url + '?' + params.join('&');

            console.log(url);

            $('#next').attr('data-url', url);

            $('#next').trigger('click');
        } catch(error){
            console.log(error);
        }
    }
    */
	/*
	function approve_company(id, role, line){
		try{
			var uri;
			
			uri = config.api_url+'/'+role+'/'+id;
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
						
                .done(function(data, textStatus, jqXHR){
                        console.log(data);


                        if(data.code == 200){
                                $('#deleteUser').parent().addClass('success');
                                $('#deleteUser').parent().removeClass('loading');
                                $('#deleteUser').parent().removeClass('fail');

                                $('.close').trigger('click');

                                $('#listJobs > tbody > tr:nth-child('+line+')').attr('hidden', 'hidden');
                        }
                })
                .fail(function(jqXHR, textStatus, errorThrown){
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                });
		}catch(error){
			console.log(error);
		}
	}
        */
      });
})(jQuery);