/**
 * Script to count the number of active ads and list last ads
 */

(function($) {
    $(document).ready(function() {
        //$("li.active").removeClass("active");
        $("#l1").addClass('active');
        if (localStorage.admin_token) {
            //console.log(localStorage.role);
            number_of_users(); // retrieve number of all users
            number_of_companies(); // list 
            number_of_jobs();
            list_companies(10);

            certification_titles();
            skills();
            job_titles();
            institution_names();
            industry();
            honors();
            job_types();
            education_majors();
            course_names();
            education_degrees();
//            company_names();
            course_fields();
            education_minors();
            languages();

            // Get ads id of the reject line clicked
            $('#tableLastCpanies').delegate('#action_detail_job_approve > ul > li:nth-child(4) > a', 'click', function() {
                id = $(this).attr('data-approve');
                line = $(this).attr('data-line');

                approve_company(id, line);
            });


            $('a.pending_task_link').click(function() {
                localStorage.setItem('admin_sort_status', 0);
            });
        } else {
            window.location.href = root_admin + '/login';
        }
    });

// Number of active ads
    function number_of_users() {
        try {
            var url, number_of_ads;
            url = config.api_url + '/accounts';
            $.ajax({
                url: url,
                method: "GET",
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
                        $("#total_users").text(data.count);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function number_of_companies() {
        try {
            var url, number_of_ads;
            url = config.api_url + '/companies';
            $.ajax({
                url: url,
                method: "GET",
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
                        $("#total_companies").text(data.count);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }





    function number_of_jobs() {
        try {
            var url, number_of_ads;
            url = config.api_url + '/companies/jobs';
            $.ajax({
                url: url,
                method: "GET",
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
                        $("#total_jobs").text(data.count);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }



    function list_companies(limit) {
        try {
            var url, number_of_ads;
            url = config.api_url + '/companies';
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    "limit": limit,
                    "status": "PENDING"
                },
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
                        $("#tableLastCpanies").DataTable().destroy();
                        // Utilisation de jQueryTemplate
                        $("#tableLastCpanies>tbody").loadTemplate($("#Ads"), data.items);

                        $('#tableLastCpanies').dataTable({
                            "deferRender": true,
                            "columnDefs": [
                                {"targets": 3, "orderable": false}
                            ],
                            "autoWidth": true, // largeur des colonnes automatique
                            "lengthChange": false, // utilisateur peut modifier le nombre de items per page
                            "paging": false, // Disable pagination
                            "processing": true, // Indicate the processing
                            "ordering": true,
                            "info": false,
                            "searching": false
                        });


                        formattage(data.count);
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }

    function formattage(count) {
        try {
            for (i = 1; i <= count; i++) {
                var id_company = $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > a').attr('id');

                // Set links in the first, second and last column
                $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(1) > a').attr('href', root_admin + '/companies/' + id_company);

                $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(4) > #action_detail_job_approve > ul > li:nth-child(1) > a').attr('href', root_admin + '/companies/' + id_company);
                $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(4) > #action_detail_job_approve > ul > li:nth-child(2) > a').attr('href', root_admin + '/companies/' + id_company + '/jobs');
                $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(4) > #action_detail_job > ul > li:nth-child(1) > a').attr('href', root_admin + '/companies/' + id_company);
                $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(4) > #action_detail_job > ul > li:nth-child(2) > a').attr('href', root_admin + '/companies/' + id_company + '/jobs');

                // marqueurs sur l'action "approve"
                $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(4) > #action_detail_job_approve > ul > li:nth-child(4) > a').attr('data-approve', id_company);
                $('#tableLastCpanies > tbody > tr:nth-child(' + i + ') > td:nth-child(4) > #action_detail_job_approve > ul > li:nth-child(4) > a').attr('data-line', i);
            }
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

                            list_companies(10);
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

    function certification_titles() {
        try {
            var url, number_of_ads;
            url = config.api_url + '/certification-titles';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        console.log(data);
                        if (data.total > 0)
                            $("#totalCertificationTitles").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function skills() {
        try {
            var url;
            url = config.api_url + '/skills';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        if (data.total > 0)
                            $("#totalSkills").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function job_titles() {
        try {
            var url;
            url = config.api_url + '/job-titles';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalJobTitles").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }

    function institution_names() {
        try {
            var url;
            url = config.api_url + '/institution-names';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        if (data.total > 0)
                            $("#totalIN").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function honors() {
        try {
            var url;
            url = config.api_url + '/honors';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalHonors").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function job_types() {
        try {
            var url;
            url = config.api_url + '/job-types';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalJobTypes").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function education_majors() {
        try {
            var url;
            url = config.api_url + '/education-majors';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalEducationMajors").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function course_names() {
        try {
            var url;
            url = config.api_url + '/course-names';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalCourseNames").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function education_degrees() {
        try {
            var url;
            url = config.api_url + '/education-degrees';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalEducationDegrees").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function company_names() {
        try {
            var url;
            url = config.api_url + '/company-names';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalCompanyNames").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }

    function course_fields() {
        try {
            var url;
            url = config.api_url + '/course-fields';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        if (data.total > 0)
                            $("#totalCourseFields").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function education_minors() {
        try {
            var url;
            url = config.api_url + '/education-minors';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        if (data.total > 0)
                            $("#totalEducationMinors").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }


    function languages() {
        try {
            var url;
            url = config.api_url + '/languages';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        if (data.total > 0)
                            $("#totalLanguages").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }

    function industry() {
        try {
            var url;
            url = config.api_url + '/industry';
            $.ajax({
                url: url,
                method: "GET",
                headers: {
                    "x-client-id": "0000",
                    "Content-Type": "application/json",
                    "cache-control": "no-cache",
                    "x-access-token": localStorage.admin_token
                },
                data: {status: 0},
                crossDomain: true
            })
                    .done(function(data, textStatus, jqXHR) {
                        var pending_count;
                        if (data.total > 0)
                            $("#totalIndustry").text(data.total);
                        //console.log(data);                    
                    })

                    // Si les params de connexion ne sont pas les bonnes
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('request failed !');
                        console.log(errorThrown);
                        console.log(jqXHR);
                    })
                    .always(function() {
                    });
        } catch (error) {
            console(error);
        }
    }
})(jQuery);