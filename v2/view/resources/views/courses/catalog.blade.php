@extends('layouts.master')

@section('header-title')
SmartSchool :: Course Catalog
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
                <ul class="breadcrumb push-down-0">
                    <li><a href="{{url('/learners/dashboard')}}">{{trans('instructor.settings-1')}}</a></li>                    
                    <li class="active">Catalog</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">
                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-search"></span> Courses Catalog</h2>
                        </div>                                      
                        <div class="pull-right">
                            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
                        </div>                        
                    </div>
                    <!-- END CONTENT FRAME TOP -->                                       
                </div>
                <!-- END CONTENT FRAME -->    

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <div class="row">                    
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">                                    
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                        <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <p>Use search to find courses or lessons. You can search by: course name, course category or lesson title </p>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-search"></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="What are you looking for?"/>
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary">Search</button>
                                                    </div>
                                                </div>
                                            </div>                
                                            <div class="col-md-3"></div>                            
                                        </div>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading ui-draggable-handle">
                                    <h3 class="panel-title"><span class="fa fa-filter"></span> <i>Subjects</i></h3>                                
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>                                        
                                    </ul>                                   
                                </div>
                                <div class="panel-body">
                                    <form action="#" role="form" class="form-horizontal">
                                    	<div class="form-group">
	                                        <div class="col-md-12">                                    
	                                            <label class="check"><input type="checkbox" class="icheckbox"/> Computer Science</label>
	                                        </div>
                                        </div>
                                        <div class="form-group">
	                                        <div class="col-md-12">                                    
	                                            <label class="check"><input type="checkbox" class="icheckbox"/> Mathematics</label>
	                                        </div>
                                        </div>                                        
                                        <div class="form-group">
	                                        <div class="col-md-12">
	                                        	<label class="check"><input type="checkbox" class="icheckbox" checked="checked"/> Physics</label>
	                                        </div>
	                                    </div>                                         
                                        </form>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-lg btn-default"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>

                        </div>
                    <div class="row">
                        <div class="col-md-9">
                        <div class="col-md-12" id="catalog">                            
                        </div>                    
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination pagination-sm pull-right push-down-10 push-up-10">
                                <li class="hide" id="prev"><a href="#">Previous</a></li>
                                <li class="hide" id="next"><a href="#">Next</a></li>                                
                            </ul>                            
                        </div>
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
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('plugins/purl/purl.js')}}"></script
<script src="{{asset('js/actions.js')}}"></script>
<script src="{{asset('js/courses/catalog.js')}}"></script
@stop