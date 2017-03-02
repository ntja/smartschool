@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Course Details')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop
@section('header-styles')
	<!--
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/lib/prototype.js')}}"></script>
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/src/scriptaculous.js')}}"></script>
	-->
	<link href="{{asset('fontello/css/fontello.css')}}" rel="stylesheet">
    <link href="{{asset('css/single_course.css')}}" rel="stylesheet">
@stop
@section('content')

 @include('partials/header')
  	
<section id="sub-header" data-course_id=<?php echo $course_id; ?>>
  	<div class="container">
    
    	<div class="row">
        	<div class="col-md-12 text-center" id="course_title">
                <p class="lead subject"></p>
            </div>
        </div><!-- End row -->
        
        <div class="row course_desc" id="sub-header-features-2">
        	<div class="col-md-6 summary">
            	<h2>{{__('A brief summary')}}</h2>               
            </div>            
        </div><!-- End row -->
    </div><!-- End container -->
    <div class="divider_top"></div>
  </section>
  
  <section id="main_content">
  <div class="container">
  
	<ol class="breadcrumb">
      <li><a href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
      <li class="active">{{__('Course Details')}}</li>
    </ol>

	 <div class="row">
     		<div class="col-md-8">
                    
                    <h3 class="chapter_course no_margin_rop">Chapter 1: Welcome.</h3>
                    <div class="strip_single_course">
                        <h4><a href="course_detail_page_txt.html">Lorem ipsum dolor sit amet, case saepe impetus sed ut.</a></h4>
                        <ul>
                              <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-doc"></i>Text reading</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course">
                        <h4><a href="course_detail_page_video.html">Oportere efficiantur usu ad.</a></h4>
                        <ul>
                            <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-video"></i> Video lesson</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course">
                        <h4><a href="#">Oportere efficiantur usu ad.</a></h4>
                        <ul>
                            <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-mic"></i> Audio lesson</li>
                        </ul>
                    </div><!-- end strip single course -->
                                      
                    <h3 class="chapter_course">Chapter 2: Case aeque melius duo ut, porro ridens habemus quo in.</h3>
                    <div class="strip_single_course">
                        <h4><a href="#">Et has suscipit probatus.</a></h4>
                        <ul>
                              <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-doc"></i>Text reading</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course">
                        <h4><a href="#">Quo ea feugiat saperet vulputate</a></h4>
                        <ul>
                              <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-doc"></i>Text reading</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course">
                        <h4><a href="#">Legere sanctus perfecto at eos</a></h4>
                        <ul>
                              <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-doc"></i>Text reading</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course">
                        <h4><a href="#">Mei habemus voluptua ex, utroque instructior.</a></h4>
                        <ul>
                              <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-doc"></i>Text reading</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <h3 class="chapter_course">Chapter 3: Case aeque melius duo ut, porro ridens habemus quo in.</h3>
                    <div class="strip_single_course">
                        <h4><a href="#">Ysu suavitate adversarium philosophia.</a></h4>
                        <ul>
                            <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-video"></i> Video</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course">
                        <h4><a href="#">Eu sit causae elaboraret efficiendi.</a></h4>
                        <ul>
                            <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-video"></i> Video</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course">
                        <h4><a href="#">Moderatius efficiantur eu mei.</a></h4>
                        <ul>
                            <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-video"></i> Video</li>
                        </ul>
                    </div><!-- end strip single course -->
                    
                    <div class="strip_single_course add_bottom_30">
                        <h4><a href="#">Diam assentior sententiae eu duo.</a></h4>
                        <ul>
                            <li><i class="icon-clock"></i> 00:58</li>
                              <li><i class="icon-video"></i> Video</li>
                        </ul>
                    </div><!-- end strip single course -->
                
            </div><!-- End col-md-8  -->
            
            <aside class="col-md-4">
            	<a href="#" class=" button_fullwidth-3">Start learning</a> 
            	<div class="box_style_1">
         			<h4>Lessons <span class="pull-right">17</span></h4>
         			<h4>Hours <span class="pull-right">12</span></h4>
                    <h4>Rates <span class="pull-right rating_2"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i></span></h4>
                    <h4>Single purchase<span class="pull-right">120$</span></h4><br>
                	<h4>Speakers</h4>
                    <div class="media">
                        <div class="pull-right">
                            <img src="img/avatar1.jpg" class="img-circle" alt="">
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Marc Twain</a></h5>
                            <p>
                                Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. 
                            </p>
                        </div>
                    </div>
                    
                    <div class="media">
                        <div class="pull-right">
                            <img src="img/avatar1.jpg" class="img-circle" alt="">
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="#">Marc Twain</a></h5>
                            <p>
                                Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in.
                            </p>
                        </div>
                    </div>
           </div>
           
           <div class="box_style_1">
                    <h4>Related content</h4>
                    <ul class="list_1">
                          <li><a href="#">Ceteros mediocritatem</a></li>
                          <li><a href="#">Labore nostrum</a></li>
                          <li><a href="#">Primis bonorum</a></li>
                          <li><a href="#">Ceteros mediocritatem</a></li>
                     </ul>
           </div>
         </aside> <!-- End col-md-4 -->
     	
     </div><!-- End row -->         
  </div><!-- End container -->
  </section>
 
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
   <script src="{{asset('js/custom/courses/details.js')}}"></script>
@stop

@stop 
