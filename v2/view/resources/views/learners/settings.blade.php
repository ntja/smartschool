@extends('layouts.master')

@section('header-title')
SmartSchool :: learner settings
@stop
    
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('styles/theme-default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/custom.css')}}">
@stop

@section('content')      
    <!-- START PAGE CONTAINER -->
    <div class="page-container page-navigation-top">                            
        <!-- PAGE CONTENT -->
        <div class="page-content"> 
            @include('learners/partials.header')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{url('/learners/dashboard')}}">Dashboard</a></li>
                    <li class="active">Settings</li>
                </ul>
                <!-- END BREADCRUMB -->    
                <div class="page-content-wrap">  
                    <div class="row">               
                        <div class="col-md-3"></div>             
                        <div class="col-md-9">
                            <div class="response-message"></div>
                        </div>
                    </div>                                          
                    <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body profile">
                                    <div class="profile-image profile">
                                        <img src="#" alt="User photo"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name user-name"></div>
                                        <div class="profile-data-title"></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a href="#" class="profile-control-left twitter"><span class="fa fa-twitter"></span></a>
                                        <a href="#" class="profile-control-right facebook"><span class="fa fa-facebook"></span></a>
                                    </div>                                    
                                </div>                                
                                <div class="panel-body">                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-primary btn-rounded btn-block"><span class="fa fa-question"></span> Q&A Threads</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary btn-rounded btn-block"><span class="fa fa-comments"></span> Chat</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body list-group border-bottom">
                                    <a href="#" class="list-group-item"><span class="fa fa-bar-chart-o"></span> Activity<span class="badge badge-warning">0</span></a>                                
                                    <a href="#" class="list-group-item"><span class="fa fa-folder"></span> Courses<span class="badge badge-primary">0</span></a>                                
                                    <a href="#" class="list-group-item"><span class="fa fa-group"></span> Groups <span class="badge badge-default">0</span></a>                                
                                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> Friends <span class="badge badge-danger">0</span></a>                                    
                                </div>
                                <div class="panel-body"></div>                                
                            </div>                            
                            
                </div>
               <div class="col-md-9">                                                                                    
                    <div class="panel panel-default tabs">                            
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#tab-first" role="tab" data-toggle="tab"><span class="fa fa-user"></span> Profile</a></li>
                            <li><a href="#tab-second" role="tab" data-toggle="tab"><span class="fa fa-credit-card"></span> Subscriptions </a></li>
                        </ul>
                        <div class="panel-body tab-content">
                            <div class="tab-pane active" id="tab-first">
                                <form class="form-horizontal" method="post" action="javascript:void" id="profile-form">
                                    <div class="panel panel-default">                                           
                                        <div class="panel-body">
                                            <div class="row">         
                                                <div class="col-md-6">  
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Honorific</label>
                                                        <div class="col-md-9">                                        
                                                            <select class="form-control select"  name="honorific">
                                                                <option value="Mr" selected="selected">Mr</option>
                                                                <option value="Ms">Ms</option>
                                                            </select>
                                                        </div>
                                                    </div>                                                  
                                                    <div class="form-group">
                                                        <label for="email" class="col-md-3 control-label">Email Address</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                                                <input type="text" id="email" name="email" class="form-control" readonly />
                                                            </div>                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password" class="col-md-3 control-label">New Password</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                                                <input type="password" id="password" name="password" class="form-control" />
                                                            </div>                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                       <label for="confirmation_password" class="col-md-3 control-label">New password confirmation </label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                                                <input type="password" id="confirmation_password" name="confirmation_password" class="form-control"/>
                                                            </div>                                            
                                                        </div>
                                                    </div>          
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="first_name" class="col-md-3 control-label">First Name</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                <input type="text" name="first_name" id="first_name" class="form-control"/>
                                                            </div>                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="first_name" class="col-md-3 control-label">Last Name</label>
                                                        <div class="col-md-9">                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                <input type="text" id="last_name" name="last_name" class="form-control"/>
                                                            </div>                                            
                                                        </div>
                                                    </div>                                                    
                                                    <div class="form-group">                                        
                                                        <label for="tel" class="col-md-3 control-label">Telephone </label>
                                                        <div class="col-md-9 col-xs-12">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                                                <input type="number" id="tel" name="telephone" class="form-control"/>
                                                            </div>            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="photo" class="col-md-3 control-label">Photo</label>
                                                        <div class="col-md-9">
                                                            <input type="file" class="fileinput btn-primary" name="photo" id="photo" title="Upload a photo"/>
                                                        </div>
                                                    </div>                                            
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <button class="btn btn-primary pull-left" id="submit">Save Changes <span class="fa fa-floppy-o fa-right"></span></button>
                                            <div class="col-md-3 loader">
                                                <img src="{{asset('img/loaders/default.gif')}}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <div class="tab-pane" id="tab-second">
                            
                            <div class="row">
                        <!-- PRICING TABLE -->
                        <div class="col-md-4">

                            <div class="panel panel-success push-up-20">
                                <div class="panel-body panel-body-pricing">
                                    <h2>Free Plan<br/><small>CFA 0 / Per month</small></h2>                                
                                    <p><span class="fa fa-caret-right"></span> 2 domains</p>
                                    <p><span class="fa fa-caret-right"></span> 4 databases</p>
                                    <p><span class="fa fa-caret-right"></span> 5 e-mail Accounts</p>
                                    <p><span class="fa fa-caret-right"></span> 2GB amount of space</p>
                                    <p class="text-muted">For individuals</p>
                                </div>
                                <div class="panel-footer">                                 
                                    <button class="btn btn-success btn-block">Current Plan</button>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="panel panel-danger">
                                <div class="panel-body panel-body-pricing">
                                    <h2>Annual Plan<br/><small>CFA 9,999 / Per Year</small></h2>                                
                                    <p><span class="fa fa-caret-right"></span> 10 domains</p>
                                    <p><span class="fa fa-caret-right"></span> 20 databases</p>
                                    <p><span class="fa fa-caret-right"></span> unlimited e-mails</p>
                                    <p><span class="fa fa-caret-right"></span> 50GB amount of space</p>
                                    <p><span class="fa fa-caret-right"></span> 5h of FREE support</p>                                
                                    <p class="text-muted">For business websites and corporate</p>
                                </div>
                                <div class="panel-footer"> 
                                    <button class="btn btn-danger btn-block">Choose Plan</button>
                                </div>
                            </div>

                        </div>                    

                        <div class="col-md-4">

                            <div class="panel panel-warning push-up-20">
                                <div class="panel-body panel-body-pricing">
                                    <h2>Monthly Plan<br/><small>CFA 999 / Per month</small></h2>                                
                                    <p><span class="fa fa-caret-right"></span> 4 domains</p>
                                    <p><span class="fa fa-caret-right"></span> 8 databases</p>
                                    <p><span class="fa fa-caret-right"></span> 10 e-mail Accounts</p>
                                    <p><span class="fa fa-caret-right"></span> 10GB amount of space</p>
                                    <p class="text-muted">For blogs and small business websites</p>
                                </div>
                                <div class="panel-footer"> 
                                    <button class="btn btn-warning btn-block">Choose Plan</button>
                                </div>
                            </div>

                        </div>                          
                        <!-- END PRICING TABLE-->
                    </div>
                        </div>                                    
                    </div>                                
                </div>
                <!-- PAGE CONTENT WRAPPER -->                                
                </div>
                <!-- END PAGE CONTENT WRAPPER --> 
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->        
    
@stop   

@section('scripts')
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/actions.js')}}"></script>
<script src="{{asset('js/learners/settings.js')}}"></script>
@stop