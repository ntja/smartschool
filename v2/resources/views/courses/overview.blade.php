@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Course Details')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
   <!--
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/lib/prototype.js')}}"></script>
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/src/scriptaculous.js')}}"></script>
	-->
    <link href="{{asset('css/single_course.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.min.css')}}">
@stop

@section('content')
<div class="notification-container"></div>
 @include('partials/header')
  	
<section id="sub-header" data-course_id=<?php echo $course_id; ?>>
  	<div class="container">
    
    	<div class="row">
        	<div class="col-md-12 text-center" id="course_title">
                <p class="lead subject"></p>
            </div>
        </div><!-- End row -->
        
        <div class="row course_desc" id="sub-header-features-2">
        	<div class="col-md-12 summary">
            	<h2>{{__('A brief summary')}}</h2>               
            </div> 
			<div class="col-md-12">
            	<h2>What you will learn</h2>
                <ul class="list_ok">
                    <li><strong>Certified</strong> and expert teachers</li>
                    <li><strong>Extensive</strong> doumentation provided</li>
                    <li><strong>Money back</strong> garantee</li>
                    <li><strong>Became an exeprt</strong> in only 6 days</li>
                </ul>
           </div>
        </div><!-- End row -->		
    </div><!-- End container -->
    <div class="divider_top"></div>
  </section>
  
  <section id="main_content">
  <div class="container">
  
	<ol class="breadcrumb">
      <li><a href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
      <li class="active">{{__('Course Overview')}}</li>
    </ol>

	 <div class="row">
     		<div class="col-md-8" id="course_content">                   
                <span></span>   
            </div><!-- End col-md-8  -->
            
            <aside class="col-md-4">
            	<a href="javascript:;" class="enroll button_fullwidth">{{__('Enroll Now')}}</a> 
            	<div class="box_style_1">
         			<h4>length: <span class="length pull-right"></span></h4>
         			<h4>Effort: <span class="effort pull-right"></span></h4>
                    <h4>Review:  <span class="review pull-right rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i></span></h4>
                    <h4>Price: <span class="price pull-right">Free</span></h4>
					<h4>Subject: <span class="subject pull-right"></span></h4>
					<h4>Level: <span class="level pull-right"></span></h4>
					<h4>Language: <span class="language pull-right"></span></h4><br>
                	<h4>Teachers</h4>
                    <div class="media">
                        <div class="pull-right">
                            <img src="{{asset('img/avatar3.jpg')}}" class="photo img-circle" alt="">
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#" class="user_name"></a></h5>
                            <p>
                                Bio: 
                            </p>
                        </div>
                    </div>                    
				</div>
           
				<div class="box_style_1">
                    <h4>Related content</h4>
					<p>No related content found.</p>
					<!--
                    <ul class="list_1">
					  <li><a href="#">Ceteros mediocritatem</a></li>
					  <li><a href="#">Labore nostrum</a></li>
					  <li><a href="#">Primis bonorum</a></li>
					  <li><a href="#">Ceteros mediocritatem</a></li>
					</ul>-->
				</div>
			</aside> <!-- End col-md-34 -->
     	
     </div><!-- End row -->         
  </div><!-- End container -->
  </section>
 
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.js')}}"></script>
   <script src="{{asset('js/custom/courses/overview.js')}}"></script>
@stop

@stop 
