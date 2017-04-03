@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Account Activation')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop
@section('content')

@include('partials/header')

<section class="box_style_2">
	<div class="container">            
		<div class="row">
			<div class="col-md-12">   
				<div class="response-message text-center"></div>						
			</div>
		</div>
	</div>
</section><!-- End register -->

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
   <script src="{{asset('js/custom/user/activate.js')}}"></script>
@stop

@stop 