/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function($) {    
    var sort_field, sort_direction;
    sort_field = 'id';
    sort_direction = 'asc';
    $(document).ready(function() {   
        if (localStorage.admin_token)  {
            var table;
            
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
            //salary_ordering();
            $("#l4").addClass('active');
            
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
                    ajax:{
                        url: "js/jobs/server-side-processing.php", // Change this URL to where your json data comes from
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
        }
    });  
})(jQuery);