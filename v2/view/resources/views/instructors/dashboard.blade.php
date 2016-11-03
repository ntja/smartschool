@extends('layouts.master')

@section('header-title')
SmartSchool :: {{trans('instructor.dashboard-7')}}
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
                @include('instructors/partials.header')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START WIDGETS -->                    
                    <div class="row">
                        <div class="col-md-3">
                            
                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-default widget-carousel">
                                <div style="opacity: 1; display: block;" class="owl-carousel owl-theme" id="owl-example">
                                    <div class="owl-wrapper-outer">
                                        <div style="width: 1452px; left: 0px; display: block; transition: all 400ms ease 0s; transform: translate3d(-242px, 0px, 0px);" class="owl-wrapper">
                                            <div style="width: 242px;" class="owl-item">
                                            <div>
                                                <div class="widget-title">{{trans('instructor.dashboard-8')}}</div>
                                                <div class="widget-subtitle">27/08/2014 15:23</div>
                                                <div class="widget-int">0</div>
                                            </div>
                                        </div>
                                        <div style="width: 242px;" class="owl-item">
                                        <div>                                    
                                            <div class="widget-title">{{trans('instructor.dashboard-9')}}</div>
                                            <div class="widget-subtitle">{{trans('instructor.dashboard-2')}}</div>
                                            <div class="widget-int">0</div>
                                        </div>
                                    </div>
                                    <div style="width: 242px;" class="owl-item">
                                    <div>                                    
                                        <div class="widget-title">New</div>
                                        <div class="widget-subtitle">Visitors</div>
                                        <div class="widget-int">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                        
                        <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page"><span class=""></span></div><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div></div></div>                            
                        <div class="widget-controls">                                
                            <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                        </div>                             
                    </div>         
                    <!-- END WIDGET SLIDER -->
                            
                    </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-folder-open"></span>
                                </div>                             
                                <div class="widget-data">
                                    <div class="widget-int num-count">0</div>
                                    <div class="widget-title">{{trans('instructor.dashboard-1')}}</div>
                                    <div class="widget-subtitle">{{trans('instructor.dashboard-10')}}</div>
                                </div>      
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">0</div>
                                    <div class="widget-title">{{trans('instructor.dashboard-2')}}</div>
                                    <div class="widget-subtitle">{{trans('instructor.dashboard-11')}}</div>
                                </div>
                                <div class="widget-controls">                                
                                    <a data-original-title="Remove Widget" href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title=""><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-default widget-padding-sm">
                                <div class="widget-big-int plugin-clock">22<span>:</span>04</div>                            
                                <div class="widget-subtitle plugin-date">Thursday, September 8, 2016</div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#"><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                            
                        </div>
                    </div>
                    <!-- END WIDGETS --> 

                    <!-- START WIDGETS -->                    
                    <div class="row">        
                        <div class="col-md-4">                        
                            <a href="{{url('/instructors/courses/all')}}" class="tile tile-primary tile-valign">{{trans('instructor.dashboard-1')}}
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-folder-open"></span></div>
                            </a>                                                    
                        </div>
                        <div class="col-md-4">                        
                            <a href="#" class="tile tile-success tile-valign">{{trans('instructor.dashboard-6')}}
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-certificate"></span></div>                                
                            </a>                                                    
                        </div>
                        <div class="col-md-4">                        
                            <a href="#" class="tile tile-danger tile-valign">{{trans('instructor.dashboard-3')}}
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-earphone"></span></div>
                            </a>                                                    
                        </div>                        
                        <div class="col-md-4">                        
                            <a href="#" class="tile tile-success tile-valign">{{trans('instructor.dashboard-2')}}
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-user"></span></div>
                            </a>                                                    
                        </div>                        
                        <div class="col-md-4">                        
                            <a href="#" class="tile tile-primary tile-valign">{{trans('instructor.dashboard-4')}}
                                <div class="informer informer-default dir-tr"><span class="glyphicon glyphicon-phone-alt"></span></div>
                            </a>                                                    
                        </div>
                            
                        <div class="col-md-4">                        
                            <a href="{{url('/instructors/settings')}}" class="tile tile-info tile-valign">{{trans('instructor.dashboard-5')}}
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
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/actions.js')}}"></script>
<script src="{{asset('js/instructors/dashboard.js')}}"></script>
@stop