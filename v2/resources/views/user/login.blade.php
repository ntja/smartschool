@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Log in')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop
@section('header-scripts')
	<!--
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/lib/prototype.js')}}"></script>
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/src/scriptaculous.js')}}"></script>
	-->
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
			<form id="login-form" method="post">
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
					<input type="email" class=" form-control required" name="email" id="email" placeholder="{{__('Email')}}" required>
					<span class="input-icon"><i class="icon-email"></i></span>
				</div>
				<div class="form-group">
					<input type="password" class=" form-control required" name="password" id="password" placeholder="{{__('Password')}}" required>
					<span class="input-icon"><i class=" icon-lock"></i></span>
				</div>
				<div class="form-group">
					<input type="number" id="verify_human" name="verify_human" class="form-control" placeholder="{{__('Are you human ?')}} 3 + 1 =" required>
				</div>
				<p class="small">
					<a href="<?php echo URL::to('/forgot-password'); ?>">{{__('Forgot Password')}} ?</a>
					<span class="pull-right">
						<a href="<?php echo URL::to('/register'); ?>">{{__('Register')}}</a>
					</span>
				</p>				
				{{ csrf_field() }}
				<button id="submit_btn" class="button_fullwidth">{{__('Log in')}}</button>
			</form>
		</div>
	</div>
</div>
</div>
</section> <!-- End login -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
   <script src="{{asset('js/custom/user/login.js')}}"></script>
@stop

@stop 