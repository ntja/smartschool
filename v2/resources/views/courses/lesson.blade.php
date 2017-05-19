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
@stop

@section('content')
<div class="notification-container"></div>
 @include('partials/header')
<section id="main_content" data-course_id={{{ $course_id }}}>
  <div class="container-fluid">	
  <ol class="breadcrumb">
      <li><a href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
      <li class="active">Active page</li>
    </ol>
      <?php 
        //var_dump($sections_with_lessons);die();
      ?>
	<div class="row">
            <aside class="col-md-3" style="/*border-right: solid #EEEEEE 1px; */">
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
         
            <div class="col-md-9">
                <div class="clearfix text-center"><a href="#" class="pull-left button_medium_outline"> <i class="icon-left-open">{{__('Previous')}}</i></a><a href="#" class="button_medium_outline"><small>{{__('Mark as complete')}}</small></a>   <a href="#" class="pull-right button_medium_outline">{{__('Next')}}<i class="icon-right-open"></i></a></div>
                <hr>
            <h3 class="lesson_center_title text-center"></h3>
            <p class="lesson_content"></p>
			<div class="lesson_video" style="width:100%; background-color:transparent; overflow:hidden"></div>			
            <hr>
            <div class="clearfix text-center"><a href="#" class="pull-left button_medium_outline"> <i class="icon-left-open">{{__('Previous')}}</i></a><a href="#" class="button_medium_outline"><small>{{__('Mark as complete')}}</small></a>   <a href="#" class="pull-right button_medium_outline">{{__('Next')}}<i class="icon-right-open"></i></a></div>
            </div><!-- End col-md-9  -->                        
     	
     </div><!-- End row -->
  </div><!-- End container -->
  </section>
 @include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.1/mediaelement-and-player.min.js" integrity="sha256-VXINb/iKiiMYxnFBYOnciwGHHyMom8abZdQRJH+FrF8=" crossorigin="anonymous"></script>
	<script src="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.js')}}"></script>
	<script src="{{asset('js/custom/courses/lesson.js')}}"></script>
@stop

@stop 
