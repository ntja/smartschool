@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Courses, Education')}}
@stop

@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop

@section('content')

@include('partials/header')

<section id="sub-header" >
  	<div class="container">
    	<div class="row">
        	
			<div class="col-md-6">
			<!---->
            	<h1> {{__('LEARN EVERYTHING FROM ANYWHERE') }}</h1>
                <h2 class="hidden-xs">{{__('For free. For everyone. Forever') }}</h2>
				
            </div>
			
            <div class="col-md-6">
            <div id="subscribe_home" class="login">           
			<form method="post" id="register-form">
				<div class="response-message"></div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="first_name" name="first_name" placeholder="{{__('First Name')}}" required>
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="last_name" name="last_name" placeholder="{{__('Last Name')}}" required>
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-group">
							<input type="email" id="email" name="email" class="form-control style_2" placeholder="{{__('Email')}}" required>
                            <span class="input-icon"><i class="icon-email"></i></span>
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="password" id="password" name="password" class="form-control style_2" placeholder="{{__('Password')}}">
                            <span class="input-icon"><i class="icon-lock"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="password" id="confirm_password" name="confirm_password" class="form-control style_2" placeholder="{{__('Re-type your password')}}" required>
                            <span class="input-icon"><i class="icon-lock"></i></span>
						</div>
					</div>
				</div>                
                <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="number" id="verify_human" class="form-control" placeholder="{{__('Are you human ?')}} 3 + 1 =" required>
						</div>
				</div>
				 {{ csrf_field() }}
                <div class="col-md-6">
						<button id="submit_btn" class="button_fullwidth">{{__('Register')}}</button>
				</div>
                </div>
                </form>
            </div>
            </div>
        </div><!-- End row -->
    </div>
  </section><!-- End sub-header -->

    
    <section id="main-features">
    <div class="divider_top_black"></div>
    <div class="container">
        <div class="row">
            <div class=" col-md-10 col-md-offset-1 text-center">
                <h2>{{__('Why Join SmartSchool') }}</h2>
                <p class="lead">
                    {{__('We provide awesome courses & hundreds of free books! Don\'t miss out join us today!') }}
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-user"></i>
                    <a href="#"><h3>{{__('Expert teachers')}}</h3></a>
                    <p>
                        Smartskul.com allows teachers to build online courses on topics of their choosing by uploading video, PowerPoint presentations, PDFs, audio, zip files and live classes. 
						Smartskul.com allows teachers to create classes, assign practice exercises, videos and articles to students, and track student progress
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-comments"></i>
                   <a href="#"> <h3>{{__('Questions & Answers')}}</h3></a>
                    <p>
                        Smartskul.com, through Questions & Answers, connects learners and teachers so that learners can get the help they need when they need it. 
						Users can publicly and anonymously ask questions, answer questions, and post notes. Each question can be answered by any user and other users are allowed to contribute to each answer
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-book"></i>
                    <a href="#"><h3>{{__('Thousands of Free E-Books')}}</h3></a>
                    <p>
                        Smartskul.com offers free e-books in various subjects such as: mathematics, physical sciences, social sciences, computer science, engineering, accounting, finance, economics, and more. 
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-graduation-cap"></i>
                    <a href="#"><h3>{{__('Unlimited Free Courses')}}</h3></a>
                    <p>
                        For Millions of learners from all over the world, Smartskul.com offers courses taught in world top universities, in PDF and/or video formats. 
						Some of the courses include lectures, assignments & practice exercises with corrections, and exams with corrections that allow learners to study at their own pace, alone in the comfort of their room or in a group in the comfort of a classroom.
                    </p>
                </div>
            </div>
			<div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-laptop "></i>
                    <a href="#"><h3>{{__('Online Tutoring')}}</h3></a>
                    <p>
                        Millions of students from all over the world who either couldn’t turn to their parents for homework help or couldn't afford a private tutor, now have, through Smartskul.com’ videos, e-books, peers, and expert teachers, 
						the help they need for their homework and also the opportunity to learn anything they want to learn at their own pace.
                    </p>
                </div>
            </div>
			<div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-briefcase"></i>
                    <a href="#"><h3>{{__('Professional Training')}}</h3></a>
                    <p>
                        As a means of improving job-related skills, Smartskul.com offers resources for a personalized learning and training for all ages such as videos lectures, PDFs lectures, and e-books, in areas such as: business and entrepreneurship, language, design, management, programming, information technology, digital marketing, and hand on training in MS office suite (Word, Excel, Access, and more). 
						Smartskul.com also allows instructors and corporate trainers to create coursework for employees.
                    </p>
                </div>
            </div>
            </div><!-- End row -->
            </div><!-- End container -->
    </section><!-- End main-features -->
    
    <section id="main_content_gray">
    	<div class="container">
        	<div class="row">
				<div class="col-md-12 text-center">
					<h2>{{__('Latest Courses')}}</h2>
					<p class="lead">{{__('Enroll now in the latest courses')}}.</p>
				</div>
			</div><!-- End row -->
			<div id="course_list">
			</div>        
			<div class="row hide view_all">
				<div class="col-md-12">
					 <a href="<?php echo URL::to('/courses/catalog'); ?>" class="button_medium_outline pull-right">{{__('View All Courses')}}</a>
				</div>
			</div>
        </div>   <!-- End container -->
    </section><!-- End section gray -->                
    
	@include('partials/footer')
  
	@section('scripts')
		<script src="{{asset('js/custom/config/config.js')}}"></script>
		<script src="{{asset('js/localization/i18n.js')}}"></script>
		<script src="{{asset('js/custom/functions.js')}}"></script>
	   <script src="{{asset('js/custom/user/register.js')}}"></script>
	   <script src="{{asset('js/custom/home.js')}}"></script>
	@stop
@stop 
