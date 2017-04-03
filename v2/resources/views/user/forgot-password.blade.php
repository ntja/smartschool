@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Forgot Password')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
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
			<div class="response-message"></div>
			<form id="forgot-password-form" method="post">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<h2>{{__('Forgot Password')}} ?</h2>
						<small>{{__('Please enter your email address')}}. {{__('We will send you an email with details on how to reset your password')}}.</small>
					</div>				
				</div> <!-- end row -->
				<div class="form-group">
					<input type="text" class="form-control required" id="email" name="email"  placeholder="{{__('Email')}}"  required>
					<span class="input-icon"><i class="icon-email"></i></span>
				</div>						
				{{ csrf_field() }}
				<button id="submit_btn" class="button_fullwidth">{{__('Send')}}</button>
			</form>
		</div>
	</div>
</div>
</div>
</section> <!-- End login -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
   <script src="{{asset('js/custom/user/forgot-password.js')}}"></script>
@stop

@stop