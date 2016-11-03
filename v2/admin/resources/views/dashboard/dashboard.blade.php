@extends('layouts.master')

@section('header-title')
Dashboard
@stop

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="total_users"></h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                    <a href="{{url('users')}}" class="small-box-footer">List <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id="total_companies"></h3>
                        <p>Companies</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-speakerphone"></i>
                    </div>
                    <a href="{{url('/companies')}}" class="small-box-footer">List <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->  
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="total_jobs"></h3>
                        <p>Jobs</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('/jobs')}}" class="small-box-footer">List <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->  
        </div><!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-8 connectedSortable">
                <!-- Custom table -->            
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pending companies</h3>
                    </div>
                    <div class="box-body">
                        <div class="table table-responsive">
                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="tableLastCpanies_wrapper">
                                <div class="row"><div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>                                        
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table  id="tableLastCpanies" role="grid" class="table no-margin dataTable no-footer">
                                            <thead>
                                                <tr role="row">
                                                    <th>Name</th>
                                                    <th>Phone Number</th>
                                                    <th>Description</th>
                                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th> 
                                                </tr>
                                            </thead>                                
                                        </table>                        
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer clearfix">
                                <a href="{{ url('/companies') }}" class="btn btn-sm btn-default btn-flat pull-right" id="allAds">See All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)--> 
            <section class="col-lg-4 connectedSortable">
                <!-- Tables de commandes-->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pending tags</h3>
                    </div>
                    <div class="box-body">
                        <ul class="nav nav-stacked">
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/skills') }}">Skills <span class="pull-right badge bg-aqua" id="totalSkills"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/job-titles') }}">Job titles <span class="pull-right badge bg-aqua" id="totalJobTitles"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/institution-names') }}">Institution names <span class="pull-right badge bg-aqua" id="totalIN"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/industry') }}">Industries <span class="pull-right badge bg-aqua" id="totalIndustry"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/honors') }}">Honors <span class="pull-right badge bg-aqua" id="totalHonors"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/job-types') }}">Job types <span class="pull-right badge bg-aqua" id="totalJobTypes"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/education-majors') }}">Education majors <span class="pull-right badge bg-aqua" id="totalEducationMajors"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/course-names') }}">Course names <span class="pull-right badge bg-aqua" id="totalCourseNames"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/education-degrees') }}">Education degrees <span class="pull-right badge bg-aqua" id="totalEducationDegrees"></span></a>
                            </li>
<!--                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/company-names') }}">Company names <span class="pull-right badge bg-aqua" id="totalCompanyNames"></span></a>
                            </li>-->
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/course-fields') }}">Course fields <span class="pull-right badge bg-aqua" id="totalCourseFields"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/education-minors') }}">Education minors <span class="pull-right badge bg-aqua" id="totalEducationMinors"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/certification-titles') }}">Certification titles <span class="pull-right badge bg-aqua" id="totalCertificationTitles"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/languages') }}">Languages <span class="pull-right badge bg-aqua" id="totalLanguages"></span></a>
                            </li>
                        </ul>
                    </div> 
<!--                    <div class="box-footer text-center">
                        <a class="uppercase" id="allTags" href="#">See All</a>
                    </div> -->
                </div>
            </section>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop
@section('script-footer')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/i18n.js')}}"></script>
<script src="{{asset('plugins/jquery.loadTemplate-1.5.0.min.js')}}"></script>
<script src="{{asset('js/dashboard/dashboard.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- Template jQuery -->
<script type="text/html" id="Ads">
    <tr>
        <td><a data-content="company_name_name" data-id="id"></a></td>
        <td data-content="phone_number"></td>
        <td data-content="description"></td>
        <td>
            <div class="btn-group" style="display:block;" id="action_detail_job_approve">
                <button class="btn btn-default" type="button">Actions</button>
                <button class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#" class="userProfil">Details</a>
                    </li>
                    <li>
                        <a href="#" class="userProfil">Jobs</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#approved" data-toggle="modal">Approve</a>
                    </li>
                </ul>
            </div>
            <div class="btn-group" style="display:none;" id="action_detail_job">
                <button class="btn btn-default" type="button">Actions</button>
                <button class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#" class="userProfil">Details</a>
                    </li>
                    <li>
                        <a href="#" class="userProfil">Jobs</a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
</script>
@stop