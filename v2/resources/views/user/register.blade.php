@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Register')}}
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
					<div class="col-md-6 col-sm-6 login_social">
						<a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
					</div>
					<div class="col-md-6 col-sm-6 login_social">
						<a href="#" class="btn btn-danger btn-block "><i class="icon-google"></i>Google+</a>
					</div>
				</div> <!-- end row -->
				<div class="login-or"><hr class="hr-or"><span class="span-or">{{__('or')}}</span></div>
				<div class="form-group">
					<input type="text" class="form-control required" name="first_name" id="first_name" placeholder="{{__('First Name')}}">
					<span class="input-icon"><i class="icon-user"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required"  name="last_name" id="last_name"  placeholder="{{__('Last Name')}}">
					<span class="input-icon"><i class="icon-user"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required" name="email"  placeholder="{{__('Email')}}">
					<span class="input-icon"><i class="icon-email"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required" name="password" id="password" placeholder="{{__('Password')}}">
					<span class="input-icon"><i class="icon-lock"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required" name="confirm_password" id="confirm_password" placeholder="{{__('Re-type your password')}}">
					<span class="input-icon"><i class="icon-lock"></i></span>
				</div>
				<div class="form-group">
					<input type="text" id="verify_human" class="form-control" placeholder="{{__('Are you human ?')}} 3 + 1 =">
				</div>
				{{ csrf_field() }}
                <div id="pass-info" class="clearfix"></div>
				<button class="button_fullwidth">{{__('Register')}}</button>
			</form>
		</div>
	</div>
</div>
</div>
</section><!-- End register -->

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