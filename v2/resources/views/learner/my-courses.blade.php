@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('My Courses')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">	
@stop
@section('header-scripts')

@stop
@section('content')
	@include('partials/learner/header')
  <section id="main_content">
	<div class="container">
	<ol class="breadcrumb">
	   <li><a disabled href="<?php echo URL::to('/learner/dashboard'); ?>">{{__('Dashboard')}}</a></li>
	  <li class="#">{{__('My Courses')}}</li>
	</ol>   
    
    <div class="row">
        <div class="col-md-12">
     
			<!--  Tabs -->   
			<ul class="nav nav-tabs" id="mytabs">				
				<li class="active"><a href="#">{{__('My Courses')}}</a></li>
				<li><a href="#">{{__('Profile')}}</a></li>
				<li><a href="#">{{__('Discussion')}}</a></li>
				<li><a href="#">{{__('Plans')}} / {{__('Billing')}}</a></li>
			</ul>
			
			<div class="tab-content">
			
				<div class="tab-pane fade in active courses">
				   <h3>{{__('Courses you are following')}}</h3>
						<div class="table-responsive">
						  <table class="table">
							<thead>
							  <tr>
								<th>{{__('Category')}}</th>
								<th>{{__('Course Name')}}</th>
								<th>{{__('Joined Date')}}</th>
								<th>{{__('Progress')}}</th>
							  </tr>
							</thead>
							
						  </table>
						  </div>
				</div><!-- End tab-pane -->                                                                                                
         </div><!-- End col-md-8-->
      </div>   
    </div><!-- End row-->   

  </section>

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>		
   <script src="{{asset('js/custom/user/learner/my-courses.js')}}"></script>
@stop

@stop 