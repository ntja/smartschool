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
		<div id="login" class="login">
			<p class="text-center">
				<img src="img/logo-smartschool.png" alt="">
			</p>
			<hr>
			<form id="register-form" method="post">
				 <div class="row">
					<div class="col-md-6 col-sm-6 login_social">
						<a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
					</div>
					<div class="col-md-6 col-sm-6 login_social">
						<a href="#" class="btn btn-danger btn-block "><i class="icon-google"></i>Google+</a>
					</div>
				</div> <!-- end row -->
				<div class="login-or"><hr class="hr-or"><span class="span-or">{{__('or')}}</span></div>
				<div class="response-message"></div>
				<div class="form-group">
					<input type="text" class="form-control required" name="first_name" id="first_name" placeholder="{{__('First Name')}}" required>
					<span class="input-icon"><i class="icon-user"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required"  name="last_name" id="last_name"  placeholder="{{__('Last Name')}}" required>
					<span class="input-icon"><i class="icon-user"></i></span>
				</div>
				<div class="form-group">
					<input type="email" class="form-control required" name="email" id="email" placeholder="{{__('Email')}}" required>
					<span class="input-icon"><i class="icon-email"></i></span>
				</div>
				<div class="form-group">
					<input type="password" class="form-control required" name="password" id="password" placeholder="{{__('Password')}}" required>
					<span class="input-icon"><i class="icon-lock"></i></span>
				</div>
				<div class="form-group">
					<input type="password" class="form-control required" name="confirm_password" id="confirm_password" placeholder="{{__('Re-type your password')}}" required>
					<span class="input-icon"><i class="icon-lock"></i></span>
				</div>
				<div class="form-group">
					<input type="number" id="verify_human" class="form-control" placeholder="{{__('Are you human ?')}} 3 + 1 =" required>
				</div>
				{{ csrf_field() }}
                <div id="pass-info" class="clearfix"></div>
				<button id="submit_btn" class="button_fullwidth">{{__('Register')}}</button>
			</form>
		</div>
	</div>
</div>
</div>
</section><!-- End register -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
   <script src="{{asset('js/custom/user/register.js')}}"></script>
@stop

@stop 