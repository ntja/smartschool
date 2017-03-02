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
        	<div class="col-md-6" id="subscribe">
            	<h1> {{__('LEARN EVERYTHING FROM ANYWHERE') }}</h1>
                <h2 class="hidden-xs">{{__('For free. For everyone. Forever') }}</h2>
            </div>
            <div class="col-md-6">
            <div id="subscribe_home"  class="login">           
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
							<input type="number" id="verify_contact_home" class=" form-control" placeholder="{{__('Are you human ?')}} 3 + 1 =" required>
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
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-comments"></i>
                   <a href="#"> <h3>{{__('Questions & Answers')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-book"></i>
                    <a href="#"><h3>{{__('Thousands of E-Books')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-graduation-cap"></i>
                    <a href="#"><h3>{{__('Unlimited Free Courses')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
			<div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-laptop "></i>
                    <a href="#"><h3>{{__('Online Tutoring')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
			<div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-briefcase"></i>
                    <a href="#"><h3>{{__('Professional Training')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
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
					<p class="lead">Lorem ipsum dolor sit amet, ius minim gubergren ad.</p>
				</div>
			</div><!-- End row -->
			<div id="course_list">
			</div>        
			<div class="row hide view_all">
				<div class="col-md-12">
					 <a href="#" class="button_medium_outline pull-right">{{__('View All Courses')}}</a>
				</div>
			</div>
        </div>   <!-- End container -->
    </section><!-- End section gray -->                
    
	@include('partials/footer')
  
	@section('scripts')
		<script src="{{asset('js/custom/config/config.js')}}"></script>
		<script src="{{asset('js/custom/custom.js')}}"></script>	   
	   <script src="{{asset('js/custom/user/register.js')}}"></script>
	   <script src="{{asset('js/custom/home.js')}}"></script>
	@stop
@stop 
