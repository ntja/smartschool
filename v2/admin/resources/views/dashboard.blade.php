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
            <div class="col-lg-3 col-xs-12 col-sm-6">
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
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id="total_courses"></h3>
                        <p>Courses</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-speakerphone"></i>
                    </div>
                    <a href="{{url('/courses')}}" class="small-box-footer">List <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->  
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="total_books"></h3>
                        <p>Books</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{url('/books')}}" class="small-box-footer">List <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->  
			<div class="col-lg-3 col-xs-12 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="total_questions"></h3>
                        <p>Questions</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                    <a href="{{url('questions')}}" class="small-box-footer">List <i class="fa fa-arrow-circle-right"></i></a>
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
                        <h3 class="box-title">Unpublished Courses</h3>
                    </div>
                    <div class="box-body">
                        <div class="table table-responsive">
                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="unpublished_courses">
                                <div class="row"><div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>                                        
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table  id="unpub_courses" role="grid" class="table no-margin dataTable no-footer">
                                            <thead>
                                                <tr role="row">
                                                    <th>Title</th>
                                                    <th>Slug Title</th>
                                                    <th>Course Type</th>
                                                    <th>&nbsp;&nbsp;&nbsp;</th> 
                                                </tr>
                                            </thead>                                
                                        </table>                        
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer clearfix">
                                <a href="{{ url('/courses') }}" class="btn btn-sm btn-default btn-flat pull-right" id="all_courses">See All</a>
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
                                <a class="pending_task_link" href="{{ url('/settings/skills') }}">Courses Categories <span class="pull-right badge bg-aqua" id="total_course_cat"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/job-titles') }}">Books Categories <span class="pull-right badge bg-aqua" id="total_book_cat"></span></a>
                            </li>
                            <li>
                                <a class="pending_task_link" href="{{ url('/settings/institution-names') }}">Tags <span class="pull-right badge bg-aqua" id="total_tag"></span></a>
                            </li>
                        </ul>
                    </div> 
                </div>
            </section>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop
@section('script-footer')
<!-- Config -->
<script src="{{asset('js/custom/config/config.js')}}"></script>
<script src="{{asset('js/custom/dashboard.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
@stop