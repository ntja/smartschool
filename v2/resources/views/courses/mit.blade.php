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
        	<div class="col-md-12 text-center" id="course_title">
                <p class="lead subject"></p>
            </div>
        </div><!-- End row -->
        
        <div class="row course_desc" id="sub-header-features-2">
        	<div class="col-md-12 summary">
            	<!--<h2>{{__('A brief summary')}}</h2>-->
            </div> 
            <div class="col-md-12">
            	<!--
                <h2>{{__('What you will learn')}}</h2>
                <ul class="list_ok">
                    <li><strong>Certified</strong> and expert teachers</li>
                    <li><strong>Extensive</strong> doumentation provided</li>
                    <li><strong>Money back</strong> garantee</li>
                    <li><strong>Became an exeprt</strong> in only 6 days</li>
                </ul>
                -->
           </div>
        </div><!-- End row -->		
    </div><!-- End container -->
    <div class="divider_top"></div>
  </section>
  
  <section id="main_content">
  <div class="container">
  
	<ol class="breadcrumb">
      <li><a href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
	  <li><a href="<?php echo URL::to('/courses/catalog'); ?>">{{__('Courses Catalog')}}</a></li>
      <li class="active">{{__('MIT Courses')}}</li>
    </ol>
     	
     </div><!-- End row -->
	 <section id="main_content_gray">
    	<div class="container">
        	<div class="row">
				<div class="col-md-12 text-center">
					<h3><!--{{__('Search results')}}--><span class="total"> </span></h3>
					<p class="no_result hide lead">No Result Found.</p>
				</div>
			</div><!-- End row -->
			<div id="course_list">
			</div>			                                           
			</div><!-- End row -->
		</div><!-- End col-lg-12--> 
     </div><!-- End row -->
	 <div class="row">
		<div class="col-md-12 text-left">
			<ul class="pagination">                  
			</ul>
		</div>
	</div>
        </div>   <!-- End container -->
    </section><!-- End section gray -->  
  </div><!-- End container -->
  </section>
 
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>	
   <script src="{{asset('js/custom/courses/mit.js')}}"></script>
@stop

@stop 
