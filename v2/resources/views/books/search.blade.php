@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Search Results')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->   
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<style>
		.myIframe {
			position: relative;
			padding-bottom: 52.00%;
			padding-top: 30px;
			height: 100%;
			overflow: auto; 
			-webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
			border: solid black 1px;
		} 
		.myIframe iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
		
		.modal-dialog {
  width: 96%;
  height: 100%;
  padding: 0;
}

.modal-content {
  height: 100%;
}

	</style>
@stop

@section('content')
<div class="notification-container"></div>
 @include('partials/header')
  	
<section id="sub-header">
  	<div class="container">
    
    	<div class="row">
        	<div class="col-md-12 text-center" id="book_title">
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
	  <li><a href="<?php echo URL::to('/Books/catalog'); ?>">{{__('Courses Catalog')}}</a></li>
      <li class="active">{{__('Search Results')}}</li>
    </ol>

	 <div class="row">
		<div class="col-md-6">                   
			<h3>Search results</h3>
			<p class="no_result hide">No Result Found.</p>
			<ul class="list_1" id="result">				 
			</ul>
			<span></span>   
		</div><!-- End col-md-8  -->
		<div class="col-lg-9 col-md-8 col-sm-9">
			<div class="row" id="book_list">                                               
			</div><!-- End row -->
		</div><!-- End col-lg-9--> 
     </div><!-- End row -->         
  </div><!-- End container -->
  <!-- Modal -->
	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header bg-warning">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title book-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body book-content">			  
		  </div>		  
		</div>
	  </div>
	</div>
  </section>
 
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
   <script src="{{asset('js/custom/books/search.js')}}"></script>
@stop

@stop 
