@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Search Results')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->   
    <link href="{{asset('css/single_course.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="notification-container"></div>
 @include('partials/header')
  	
 <section id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h2>{{__('OCW Courses Catalog')}}</h2>
                <p class="lead">
                   {{__('Explore new interests and career opportunities with courses in Mathematics, Computer Science, Chemistry, Physics, Biology and more...')}}
                </p>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
    <div class="divider_top"></div>
    </section><!-- End sub-header -->
  
  <section id="main_content">
    	<div class="container-fluid">
        
        <ol class="breadcrumb">
		  <li><a disabled href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
		  <li class="active">{{__('OCW Courses Catalog')}}</li>
		</ol>
        
        <div class="row">        
			<aside class="col-lg-3 col-md-4 col-sm-3">
				<div class="box_style_2">
					<h4>{{__('Subjects')}}</h4>
					<ul class="submenu-col subject">										
						<li><a href="#" class="latest_courses" id="active">{{__('Latest Courses')}}</a></li>
					</ul>
				</div>
			</aside>
			
			<div class="col-lg-7 col-md-7 col-sm-9 col-lg-offset-1 col-md-offset-1">
				<h3 class="title  text-success">Latest Courses</h3>
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
   <script src="{{asset('js/custom/courses/mit.js')}}"></script>
@stop

@stop 
