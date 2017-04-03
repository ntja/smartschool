@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Learner Dashboard')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop
@section('header-scripts')
	<!--
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/lib/prototype.js')}}"></script>
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/src/scriptaculous.js')}}"></script>
	-->
@stop
@section('content')
	@include('partials/learner/header')
  <section id="strips-course" class="shadow">  
  <div class="container">
      <ol class="breadcrumb">
      <li><a disabled href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
      <li class="active">{{__('Dashboard')}}</li>
    </ol>      
  </div>    
    
    <article>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 text-center">
					<a href="#"><div class="col-md-3 col-sm-3 text-center"><img width="100px" src="{{asset('img/number_1_small.png')}}" alt="" ></div>
					<div class="col-md-8 col-md-offset-1 col-sm-8 col-md-offset-1">
					<h3>{{__('Courses Catalog')}}</h3></a>		
					</div>
				</div>
				<div class="col-md-4 col-sm-6 text-center">
					<a href="#"><div class="col-md-3 col-sm-3 text-center"><img width="100px" src="{{asset('img/number_2_small.png')}}" alt="" ></div>
					<div class="col-md-8 col-md-offset-1 col-sm-8 col-md-offset-1">
					<h3>{{__('E-books Library')}}</h3></a>		
					</div>
				</div>
				<div class="col-md-4 col-sm-6 text-center">
					<a href="<?php echo URL::to('/learner/my-courses'); ?>"><div class="col-md-3 col-sm-3 text-center"><img width="100px" src="{{asset('img/number_3_small.png')}}" alt="" ></div>
					<div class="col-md-8 col-md-offset-1 col-sm-8 col-md-offset-1">
					<h3>{{__('My Courses')}}</h3></a>		
					</div>
				</div>	
			</div><!-- End row  -->
		</div><!-- End container  -->
    </article><!-- End strip-program  -->
	<article>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 text-center">
					<a href="#"><div class="col-md-3 col-sm-3 text-center"><img width="100px" src="{{asset('img/number_4_small.png')}}" alt="" ></div>
					<div class="col-md-8 col-md-offset-1 col-sm-8 col-md-offset-1">
					<h3>{{__('Questions & Answers')}}</h3></a>		
					</div>
				</div>
				<div class="col-md-4 col-sm-6 text-center">
					<a href="#"><div class="col-md-3 col-sm-3 text-center"><img width="100px" src="{{asset('img/number_5_small.png')}}" alt="" ></div>
					<div class="col-md-8 col-md-offset-1 col-sm-8 col-md-offset-1">
					<h3>{{__('My Matches')}}</h3></a>		
					</div>
				</div>
				<div class="col-md-4 col-sm-6 text-center">
					<a href="#"><div class="col-md-3 col-sm-3 text-center"><img width="100px" src="{{asset('img/number_6_small.png')}}" alt="" ></div>
					<div class="col-md-9 col-sm-9">
					<h3>{{__('Private Tutoring')}}</h3></a>		
					</div>
				</div>	
			</div><!-- End row  -->
		</div><!-- End container  -->
    </article><!-- End strip-program  -->      
    
  </section>

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
   <script src="{{asset('js/custom/user/learner/dashboard.js')}}"></script>
@stop

@stop 