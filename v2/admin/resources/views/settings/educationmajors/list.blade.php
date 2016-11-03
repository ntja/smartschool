@extends('layouts.master')

@section('header-title')
Education majors
@stop

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/profile_page.css')}}">
<link rel="stylesheet" href="{{ asset('css/edit_user.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('css/custom.css')}}">

@stop

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <!-- D�but de tableau -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Education majors</h3>
                    </div><!-- /.box-header -->
                    <div class="alert alert-danger alert-dismissable" id="error400" hidden="hidden">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>
                        <h4>
                            <i class="icon fa fa-ban"></i>
                            Alert!
                        </h4>
                        <span id="msg_error"></span>
                    </div>
                    <div class="box-body">
                        <div class="table table-responsive">
                            <div id="listJobs_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <a class="btn btn-primary btn-sm" id="ajouter" href="#" >Add</a><br>
                                        <ul class="list-unstyled">
                                            <li><b class="fa fa-filter"></b> <span><span class="filter-item label filter_label label-default" id="status_pending">PENDING</span></span>&nbsp;<span><span class="filter-item filter_label label label-default" id="status_approved">ACTIVE</span></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <table id="listJobs" class="table dataTable display" role="grid" aria-describedby="listJobs_info" cellspacing="0" width="100%">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="listJobs" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MODALS declined  -->
    <div class="modal fade" id="declined">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Disabling education major</h4>
                </div>
                <div class="modal-body">
                    Do you really want to disable this education major ?
                </div>
                <div class="modal-footer">
                    <span class="pull-left"><button class="btn btn-danger pull-left" id="deleteJob">Yes</button></span>
                    <button class="btn btn-default" data-dismiss="modal"  id="cancel_delete">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="activate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Education Major Activation</h4>
                </div>
                <div class="modal-body">
                    Do you really want to activate this education major ?
                </div>
                <div class="modal-footer">
                    <span class="pull-left"><button class="btn btn-success pull-left" id="activateCt">Yes</button></span>
                    <button class="btn btn-default" data-dismiss="modal"  id="cancel_approve">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script-footer')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('plugins/jquery.loadTemplate-1.5.0.min.js')}}"></script>
<script src="{{asset('js/settings/educationmajors/list.js')}}"></script>
<script src="{{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('/plugins/fastclick/fastclick.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- Template jQuery -->
<!--<script type="text/html" id="Ads">
    <tr>
        <td data-content="name" data-id="id"></td>        
        <td>
            <div class="btn-group" style="display:block;" id="action_edit_delete">
                <button class="btn btn-default" type="button">Actions</button>
                <button class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#" class="userProfil">Edit</a>
                    </li>
                    <li class="divider unactive"></li>
                    <li class="unactive">
                        <a href="#activate" class="activate_link" data-toggle="modal">Activate</a>
                    </li>
                    <li class="divider activ"></li>
                    <li class="activ">
                        <a href="#declined" data-toggle="modal">Disable</a>
                    </li>
                </ul>
                <span class="activate_status" data-content="is_active" style="display:none"></span>
            </div>
        </td>        
    </tr>
</script>-->
@stop