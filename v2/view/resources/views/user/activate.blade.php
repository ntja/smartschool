@extends('layouts.master')

@section('header-title')
    SmartSchool | Account Activation
@stop
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">        
@stop
@section('content')

    <!-- START SITE -->
    <div id="wrapper">
        @include('partials/header')
        <section>
            <div class="container">            
                <div class="row">
                    <div class="col-md-12">   
						<div class="response-message text-center"></div>						
                    </div>
                </div>
            </div>
        </section>
    </div><!-- end wrapper -->

    <div class="dmtop">Scroll to Top</div>
    <!-- END SITE -->
@stop    
    @section('scripts')    
    <script src="{{asset('js/plugins.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
	<script src="{{asset('/plugins/purl/purl.js')}}"></script>
    <script src="{{asset('js/user/activate.js')}}"></script>
    @stop