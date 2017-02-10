@extends('layouts.master')

@section('header-title')
Companies
@stop

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css/profile_page.css')}}">
<link rel="stylesheet" href="{{ asset('css/edit_user.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@stop

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <!-- Début de tableau -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Companies</h3>
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
                            <div id="listCompanies_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <!--<a class="btn btn-primary btn-sm" id="ajouter" href="#" >Ajouter</a><br>-->
                                        <ul class="list-unstyled">
                                            <li><b class="fa fa-filter"></b> <span><span class="filter-item label label-default" id="status_pending">PENDING</span></span>&nbsp;<span><span class="filter-item label label-default" id="status_approved">APPROVED</span></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                        <div class="col-sm-6"></div>
    <div class="col-sm-6">
                                                <div id="listCompanies_filter" class="dataTables_filter">
                                                        <label>Search:<input type="search" id="search" class="form-control input-sm" placeholder="" aria-controls="listUsers"></label>
                                                </div>
    </div>
</div> -->
                <div class="row">
                    <div class="col-sm-12">

                        <table id="listCompanies" class="table dataTable display" role="grid" aria-describedby="listCompanies_info" cellspacing="0" width="100%">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="listCompanies" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="listCompanies" rowspan="1" colspan="1" aria-label="Employer: activate to sort column ascending">Employer</th>
                                    <th class="sorting" tabindex="0" aria-controls="listCompanies" rowspan="1" colspan="1" aria-label="Phone Number: activate to sort column ascending">Phone Number</th>
                                    <th class="sorting" tabindex="0" aria-controls="listCompanies" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending">Description</th>
                                    <th class="sorting" tabindex="0" aria-controls="listCompanies" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="listCompanies" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th>
                                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
<!--                                <div class="row">
                                    <div class="col-sm-5">

                                    </div>
                                    <div class="col-sm-7">
                                        <div id="listCompanies_paginate" class="dataTables_paginate paging_simple_numbers">
                                            <ul class="pagination">
                                                <li id="listCompanies_previous" class="paginate_button previous">
                                                    <a href="#" id="previous"  hidden="hidden">Previous</a>
                                                </li>
                                                <li id="listCompanies_next" class="paginate_button next">
                                                    <a href="#" id="next"  hidden="hidden">Next</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MODALS declined  -->
    <div class="modal fade" id="approved">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">Company's approvment</h4>
                </div>
                <div class="modal-body">
                    Do you really want to approve this company ?
                </div>
                <div class="modal-footer">
                    <span class="pull-left"><button class="btn btn-success pull-left" id="approveCmp">Yes</button></span>
                    <button class="btn btn-default" data-dismiss="modal"  id="cancel_approve">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script-footer')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('plugins/jquery.loadTemplate-1.5.0.min.js')}}"></script>
<script src="{{asset('js/companies/list.js')}}"></script>
<script src="{{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('/plugins/fastclick/fastclick.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<!-- Template jQuery -->
<!--<script type="text/html" id="Ads">
    <tr>
        <td><a data-content="company_name_name" data-value="id"></a></td>
        <td><a data-content="employer_last_name" data-value="employer_id"></a></td>
        <td><span data-content="phone_number"></span></td>
        <td data-content="description"></td>
        <td><span data-content="email"></span></td>
        <td data-content="status"></td>
        <td>
            <div class="btn-group" style="display:none;" id="action_detail_job_approve">
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
</script>-->
@stop