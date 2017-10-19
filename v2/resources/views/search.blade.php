@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Search Results')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->       
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">
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
      <li class="active">{{__('Search Results')}}</li>
    </ol>

	<!-- <div class="row">
		<div class="col-md-6">                   
			<h3>Search results</h3>
			<p class="no_result hide">No Result Found.</p>
			<ul class="list_1" id="result">				 
			</ul>
			<span></span>   
		</div> End col-md-8  -->
		
		<!--<aside class="col-md-4">            	
		</aside>  End col-md-34 -->
     	
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
			<div class="row">
				<div class="col-md-12 text-right">
					<ul class="pagination pagination-course">                  
					</ul>
				</div>
			</div>
			<hr>
			<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="row" id="book_list"> 				
			</div><!-- End row -->
			<div class="row">
				<div class="col-md-12 text-right">
					<ul class="pagination pagination-book">                  
					</ul>
				</div>
			</div>
		</div><!-- End col-lg-12--> 
     </div><!-- End row -->	
        </div>   <!-- End container -->
    </section><!-- End section gray -->  
  </div><!-- End container -->
  </section>
 
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/custom/jquery.fancybox.min.js')}}"></script>
	<script src="{{asset('js/plugins/purl/purl.js')}}"></script>
   <script src="{{asset('js/custom/search.js')}}"></script>
@stop

@stop 
