@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Register')}}
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
	<script src="{{asset('js/custom/custom.js')}}"></script>
   <script src="{{asset('js/custom/user/activate.js')}}"></script>
@stop

@stop 