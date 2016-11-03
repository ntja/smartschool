@extends('layouts.master')

@section('header-title')
SmartSchool :: learner dashboard
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
                   <li class="active">Dashboard</li>
                </ul>
                <!-- END BREADCRUMB -->                     
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">                            
                        <div class="col-md-4">                        
                            <a href="{{url('/courses/catalog')}}" class="tile tile-primary tile-valign">Courses Catalog
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-search"></span></div>                                
                            </a>                                                    
                        </div>
                            
                            <div class="col-md-4">                        
                            <a href="#" class="tile tile-success tile-valign">My Courses
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-folder-open"></span></div>
                            </a>                                                    
                        </div>
                        <div class="col-md-4">                        
                            <a href="{{url('/library/books')}}" class="tile tile-danger tile-valign">E-books Library
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-book"></span></div>
                            </a>                                                    
                        </div>                        
                        <div class="col-md-4">                        
                            <a href="#" class="tile tile-success tile-valign">On Demand Courses
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-phone-alt""></span></div>
                            </a>                                                    
                        </div>                        
                        <div class="col-md-4">                        
                            <a href="#" class="tile tile-primary tile-valign">Private Tutoring
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-earphone"></span></div>
                            </a>                                                    
                        </div>
                            
                        <div class="col-md-4">                        
                            <a href="{{url('/learners/settings')}}" class="tile tile-info tile-valign">Settings
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-cog"></span></div>
                            </a>                                                    
                        </div>
                    </div>
                    <!-- END WIDGETS -->                            
                            
                        </div>
                    </div>
                    
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
<script src="{{asset('js/learners/dashboard.js')}}"></script>
@stop