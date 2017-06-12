@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Content of the lesson')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->   
    <link href="{{asset('css/single_course.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.1/mediaelementplayer.min.css" integrity="sha256-WXx0FFqRfy9q9IjmwAEJqvBycVIwfemORECxUHP+o0g=" crossorigin="anonymous" />
	<style>
		.myIframe {
			position: relative;
			padding-bottom: 52.00%;
			padding-top: 30px;
			height: 0;
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

	</style>
@stop

@section('content')
<div class="notification-container"></div>
 @include('partials/header')
<section id="main_content" data-course_id={{{ $course_id }}}>

  <div class="container-fluid">	

  <ol class="breadcrumb">
      <li><a href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
	  <li><a href="<?php echo URL::to('/courses/catalog'); ?>">{{__('Courses Catalog')}}</a></li>
	  <li><a href="<?php echo URL::to('/course/'.$course_id); ?>">{{{ $course_id }}}</a></li>      
    </ol>
      <?php 
        //var_dump($sections_with_lessons);die();
      ?>
	<div class="row">
		<div class="col-md-9 col-md-push-3 col-sm-9 col-sm-push-3 col-lg-9 col-lg-push-3 col-xs-12">
			<!-- <div class="clearfix text-center"><a href="#" class="pull-left button_medium_outline"> <i class="icon-left-open">{{__('Previous')}}</i></a><a href="#" class="button_medium_outline"><small>{{__('Mark as complete')}}</small></a>   <a href="#" class="pull-right button_medium_outline">{{__('Next')}}<i class="icon-right-open"></i></a></div> <hr>-->			
			<h3 class="lesson_center_title text-center"></h3>
			<p class="lesson_content"></p>
			<div class="lesson_video" style="background-color:transparent; overflow:hidden"></div>
			<hr>
			<div class="clearfix text-center">
				<a href="#" class="pull-left button_medium_outline"> <i class="icon-left-open">{{__('Previous')}}</i></a>
				<!-- <a href="#" class="button_medium_outline"><small>{{__('Mark as complete')}}</small></a>   -->
				<a href="#" class="pull-right button_medium_outline">{{__('Next')}}<i class="icon-right-open"></i></a>
				<ul class="text-center social_team"> {{__('Share on')}} : 
					<li><a href="#"><i class="icon-facebook"></i></a></li>
					<li><a href="#"><i class="icon-twitter"></i></a></li>
					<li><a href="#"><i class=" icon-google"></i></a></li>
					<li><a href="#"><i class=" icon-linkedin"></i></a></li>
				</ul>
			</div>
		</div><!-- End col-md-9  -->
		
		<aside class="col-md-3 col-md-pull-9 col-sm-3 col-sm-pull-9 col-lg-3 col-lg-pull-9  col-xs-12" style="/*border-right: solid #EEEEEE 1px; */">
			<div class="box_style_4">
			<div class="panel-group" id="accordion">
				@for ($i = 0; $i < count($sections_with_lessons); $i++)
					@if(count($sections_with_lessons[$i]->lessons)>0)
						<div class="panel panel-default">
						  <div class="panel-heading">
							<h5 class="panel-titl">
							  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#course{{{ $sections_with_lessons[$i]->id }}}">{{{ $sections_with_lessons[$i]->title }}}<i class="indicator icon-plus pull-right"></i></a>
							</h5>
						  </div>                      
						  <div id="course{{{ $sections_with_lessons[$i]->id }}}" class="panel-collapse collapse">
							<div class="panel-body">
								<ul class="list_1">                                                            
									@for ($j = 0; $j < count($sections_with_lessons[$i]->lessons); $j++)
									<li><a class="lesson_title" href="javascript:void(0);" data-href="{{{ $sections_with_lessons[$i]->lessons[$j]->slug_title }}}" data-lesson_id="{{{ $sections_with_lessons[$i]->lessons[$j]->id }}}"><small>{{{ $sections_with_lessons[$i]->lessons[$j]->title }}}</small></a></li>
									@endfor
								</ul>
							</div>
						  </div>                      
						</div>
					@endif
				@endfor  
			</div>
	   </div>           
	 </aside> <!-- End col-md-3 -->                        
     	
     </div><!-- End row -->
  </div><!-- End container -->
  </section>
 @include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.1/mediaelement-and-player.min.js" integrity="sha256-VXINb/iKiiMYxnFBYOnciwGHHyMom8abZdQRJH+FrF8=" crossorigin="anonymous"></script>
	<script src="{{asset('js/plugins/purl/purl.js')}}"></script>
	<script src="{{asset('js/custom/courses/lesson.js')}}"></script>
@stop

@stop 
