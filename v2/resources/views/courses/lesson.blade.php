@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Content of the lesson')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->   
    <link href="{{asset('css/single_course.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.min.css')}}">
	<script type="text/javascript" src="{{asset('js/jwplayer/jwplayer.js')}}"></script>
@stop

@section('content')
<div class="notification-container"></div>
 @include('partials/header')
<section id="main_content" data-course_id={{{ $course_id }}}>
  <div class="container">	
  <ol class="breadcrumb">
      <li><a href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
      <li class="active">Active page</li>
    </ol>
      <?php 
        //var_dump($sections_with_lessons);die();
      ?>
	<div class="row">
            <aside class="col-md-4" style="/*border-right: solid #EEEEEE 1px; */">
                <div class="box_style_4">           
                <div class="panel-group" id="accordion">
                    @for ($i = 0; $i < count($sections_with_lessons); $i++)
                        @if(count($sections_with_lessons[$i]->lessons)>0)
                            <div class="panel panel-info">
                              <div class="panel-heading">
                                <h6 class="panel-title">
                                  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#course{{{ $sections_with_lessons[$i]->id }}}">{{{ $sections_with_lessons[$i]->title }}}<i class="indicator icon-plus pull-right"></i></a>
                                </h6>
                              </div>                      
                              <div id="course{{{ $sections_with_lessons[$i]->id }}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="list_1">                                                            
                                        @for ($j = 0; $j < count($sections_with_lessons[$i]->lessons); $j++)
                                        <li><a href="{{{ $sections_with_lessons[$i]->lessons[$j]->slug_title }}}"><small>{{{ $sections_with_lessons[$i]->lessons[$j]->title }}}</small></a></li>
                                        @endfor
                                    </ul>
                                </div>
                              </div>                      
                            </div>
                        @endif
                    @endfor  
                </div>
           </div>           
         </aside> <!-- End col-md-4 -->
         
            <div class="col-md-8">
                <div class="clearfix text-center"><a href="#" class="pull-left button_medium_outline"> <i class="icon-left-open">{{__('Previous')}}</i></a><a href="#" class="button_medium_outline"><small>{{__('Mark as complete')}}</small></a>   <a href="#" class="pull-right button_medium_outline">{{__('Next')}}<i class="icon-right-open"></i></a></div>
                <hr>
            <h2>Simply dummy text</h2>
             <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
             <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
			<blockquote class="styled">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                    <small>Someone famous in <cite title="">Body of work</cite></small>
             </blockquote>
             <p><img src="{{asset('img/pic_1.jpg')}}" width="800" height="400" alt="Pic" class="img-responsive"></p>
             <h4>Text of the printing</h4>
             <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
             <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
            <hr>
            <div class="clearfix text-center"><a href="#" class="pull-left button_medium_outline"> <i class="icon-left-open">{{__('Previous')}}</i></a><a href="#" class="button_medium_outline"><small>{{__('Mark as complete')}}</small></a>   <a href="#" class="pull-right button_medium_outline">{{__('Next')}}<i class="icon-right-open"></i></a></div>
            </div><!-- End col-md-8  -->                        
     	
     </div><!-- End row -->
  </div><!-- End container -->
  </section>
 @include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.js')}}"></script>
@stop

@stop 
