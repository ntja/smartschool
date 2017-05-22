@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Courses Catalog')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop
@section('content')

@include('partials/header')

    <section id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1>{{__('Courses Catalog')}}</h1>      
                <p class="lead">
                   {{__('Explore new interests and career opportunities with courses in Mathematics, Computer Science, Chemistry, Physics, Biology and more...')}}
                </p>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
    <div class="divider_top"></div>
    </section><!-- End sub-header -->
    
    
    <section id="main_content">
    	<div class="container">
        
        <ol class="breadcrumb">
		  <li><a disabled href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
		  <li class="active">{{__('Courses Catalog')}}</li>
		</ol>
        
        <div class="row">
        
        <aside class="col-lg-3 col-md-4 col-sm-3">
            <div class="box_style_1">
            	<h4>{{__('Subjects')}}</h4>
				<ul class="submenu-col subject">										
					<li><a href="#" id="active">{{__('All Courses')}}</a></li>
				</ul>
            </div>
        </aside>
        
        <div class="col-lg-9 col-md-8 col-sm-9">
        	<div class="row" id="course_list">                                               
       		</div><!-- End row -->
        </div><!-- End col-lg-9-->                        
        </div><!-- End row -->
        
        <div class="row">
        	<div class="col-md-12 text-right">
            	<ul class="pagination">                  
                </ul>
            </div>
        </div>
            	
        </div><!-- End container -->
    </section><!-- End main_content -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
   <script src="{{asset('js/custom/courses/catalog.js')}}"></script>
@stop

@stop 