@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Reset Password')}}
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
			<form id="reset-password-form" method="post">
				  <div class="row">
				<div class="col-md-12 col-sm-12">
					<h3>{{__('Reset Password')}}</h3>
				</div>				
			</div> <!-- end row -->				
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
				<button id="submit_btn" class="button_fullwidth">{{__('Save')}}</button>
			</form>
		</div>
	</div>
</div>
</div>
</section><!-- End register -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
   <script src="{{asset('js/custom/user/reset-password.js')}}"></script>
@stop

@stop