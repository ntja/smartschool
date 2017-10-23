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
            List of Books
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->        
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <!-- Custom table -->            
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <div class="table table-responsive">
                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">                                
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="course_list" role="grid" class="table no-margin dataTable no-footer  table-bordered table-striped">
                                            <thead>
                                                <tr role="row">
                                                    <th>Title</th>
                                                    <th>Slug Title</th>
                                                    <th>Size</th>
													<th>Category</th>
													<th>Cover</th>
													<th>File Path</th>													
                                                    <th></th> 
                                                </tr>
                                            </thead>                                
                                        </table>                        
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer clearfix">
                                <div class="col-md-12 text-right">
									<ul class="pagination">                  
									</ul>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- /.Left col -->            
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop
@section('script-footer')
<!-- Config -->
<script src="{{asset('js/custom/config/config.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/custom/books/list.js')}}"></script>
@stop