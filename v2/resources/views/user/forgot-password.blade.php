@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Forgot Password')}}
@stop

@section('content')

@include('partials/header')

<section id="login_bg">
<div  class="container">
<div class="row">
	<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
		<div id="login">
			<p class="text-center">
				<img src="img/logo-smartschool.png" alt="">
			</p>
			<hr>
			<form>
            <div class="row">
				<div class="col-md-12 col-sm-12">
					<h2>{{__('Forgot Password')}}</h2>
					<small>{{__('Please enter your email address')}}. {{__('We will send you an email with details on how to reset your password')}}.</small>
				</div>				
			</div> <!-- end row -->
       
				<div class="form-group">
					<input type="text" class=" form-control required" name="email"  placeholder="{{__('Email')}}">
					<span class="input-icon"><i class="icon-email"></i></span>
				</div>						
				{{ csrf_field() }}
				<a href="#" class="button_fullwidth">{{__('Send')}}</a>
			</form>
		</div>
	</div>
</div>
</div>
</section> <!-- End login -->

<footer>
<hr>
<div class="container" id="nav-footer">
	<div class="row text-left">
		<div class="col-md-3 col-sm-3">
			<h4>{{__('Browse')}}</h4>
			<ul>
				<li><a href="prices_plans.html">Prices</a></li>
				<li><a href="courses_grid.html">Courses</a></li>
				<li><a href="blog.html">Blog</a></li>
				<li><a href="contacts.html">Contacts</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>{{__('Top Categories')}}</h4>
			<ul>
				<li><a href="course_details_1.html">Biology</a></li>
				<li><a href="course_details_2.html">Management</a></li>
				<li><a href="course_details_2.html">History</a></li>
				<li><a href="course_details_3.html">Litterature</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>{{__('About SmartSchool')}}</h4>
			<ul>
				<li><a href="about_us.html">About Us</a></li>
				<li><a href="apply_2.html">Join Courses</a></li>
				<li><a href="#">Terms and conditions</a></li>
				<li><a href="register.html">Register</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<ul id="follow_us">
				<li><a href="#"><i class="icon-facebook"></i></a></li>
				<li><a href="#"><i class="icon-twitter"></i></a></li>
				<li><a href="#"><i class=" icon-google"></i></a></li>
			</ul>
			<ul>
				<li><strong class="phone">+00237 655101101</strong><br><small>Mon - Fri / 9.00AM - 06.00PM</small></li>
				<li>Questions ? <a href="#">questions@smartskul.com</a></li>
			</ul>
		</div><!-- End col-md-4 -->
	</div><!-- End row -->
</div>
<div id="copy_right">© <?php echo date("Y"); ?></div>
</footer>

<div id="toTop">{{__('Back to top')}}</div>

@stop