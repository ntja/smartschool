@extends('layouts.master')
 
@section('header-title')
    SmartSchool | Users
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
                        <h3 class="box-title">Users</h3>
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
                            <div id="listUsers_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
									
                                    <div class="col-sm-12">
										<!--<a class="btn btn-primary btn-sm" id="ajouter" href="#" >Ajouter</a><br>-->
                                        <ul class="list-unstyled">
                                            <li><b class="fa fa-filter"></b> <span><span class="filter-item label label-default" id="role_administrator">ADMINISTRATOR</span></span>&nbsp;<span><span class="filter-item label label-default" id="role_instructor">INSTRUCTORS</span></span>&nbsp;<span><span class="filter-item label label-default" id="role_learner">LEARNERS</span></span></li>
											<li><b class="fa fa-filter"></b> <span><span class="filter-item label label-default" id="subs_paid">PAID</span></span>&nbsp;<span><span class="filter-item label label-default" id="subs_unpaid">UNPAID</span></span></li>
											<li><b class="fa fa-filter"></b> <span><span class="filter-item label label-default" id="state_disabled">DISABLED</span></span>&nbsp;<span><span class="filter-item label label-default" id="state_active">ACTIVE</span></span></li>
                                        </ul>
                                    </div>
                                </div>
								<div class="row">
									<div class="col-sm-6"></div>
<!--                                    <div class="col-sm-6">
										<div id="listUsers_filter" class="dataTables_filter">
											<label>Search:<input type="search" id="search" class="form-control input-sm" placeholder="" aria-controls="listUsers"></label>
										</div>
                                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <table id="listUsers" class="table dataTable" role="grid" aria-describedby="listAds_info" cellspacing="0" width="100%">
                                            <thead>
                                                <tr role="row">
                                                    <th>Email</th>
                                                    <th>Firstname</th>
                                                    <th>Lastname</th>
                                                    <th>Role</th>
                                                    <th>Subscription</th>
                                                    <th>Verified Status</th>
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
                    <h4 class="modal-title">Deleting user</h4>
                </div>
                <div class="modal-body">
					Are you sure you want to delete this user ?
                </div>
                <div class="modal-footer">
                    <span class="pull-left"><button class="btn btn-danger pull-left" id="deleteUser">Yes</button></span>
                    <button class="btn btn-default" data-dismiss="modal"  id="cancel_delete">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop

@section('script-footer')
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('plugins/jquery.loadTemplate-1.5.0.min.js')}}"></script>
    <script src="{{asset('js/users/list.js')}}"></script>
	<script src="{{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('/plugins/fastclick/fastclick.min.js')}}"></script>
    <script src="{{asset('js/app.min.js')}}"></script>
    <script src="{{asset('js/demo.js')}}"></script>
    <script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <!-- Template jQuery -->
<script type="text/html" id="Ads">
    <tr>
        <td><span data-content="email" data-id="id"></span></td>
        <td><span data-content="first_name"></span></td>
		<td><span data-content="honorific"></span>&nbsp; <b data-content="last_name"></b></td>
        <td data-content="role"></td>
		<td data-content="subscription"></td>
		<td data-content="verified_status"></td>
        <td>
            <div class="btn-group" style="display:block;" id="action_detail">
                <button class="btn btn-default" type="button">Actions</button>
                <button class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#" class="userProfil">Details</a>
                    </li>
					<!--
                    <li>
                        <a href="#" class="userProfil">Edit</a>
                    </li>
                    <li class="divider"></li>
                    -->					
					<!--
                    <li>
                        <a href="#declined" data-toggle="modal">Delete</a>
                    </li>
                    -->
                </ul>
            </div>
		</td>
    </tr>
</script>
@stop