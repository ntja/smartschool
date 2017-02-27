@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Subscription Plans')}}
@stop

@section('content')

@include('partials/header')

<section id="sub-header">
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<h1>{{__('Subscription Plans')}}</h1>
			<p class="lead">
                {{__('Please choose your subscription plan below')}} 
            </p>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
<div class="divider_top"></div>
</section><!-- End sub-header -->

<section id="main_content">
<div class="container">
    <ol class="breadcrumb">
      <li><a href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
      <li class="active">{{__('Subscription Plans')}}</li>
    </ol>
            <div class="row text-center plans">
            
                <div class="plan col-md-4">
                    <h2 class="plan-title">{{__('Courses')}} + {{__('E-books Library')}}</h2>
                    <p class="plan-price">{{__('Free')}}<span></span></p>
                    <ul class="plan-features">
                        <li><strong>{{__('Free access to all courses')}}</strong></li>
                        <li><strong>{{__('Free access to E-books Library')}}</strong></li>
                        <li><strong>{{__('Free acess to Q & A Platform')}}</strong></li>
						<li><strong>{{__('Free access to Course\'s Forum')}}</strong></li>
						<li><strong>{{__('Limited access to MCQs and assignments')}}</strong></li>
						
                    </ul>
                    <p class=" col-md-10 col-md-offset-1 text-center"><a href="javascript:void(0)" class="button_medium">{{__('Subscribe Now')}}</a></p>
                </div> <!-- End col-md-4 -->
                
                <div class="plan plan-tall col-md-4">
                <span class="ribbon"></span>
                    <h2 class="plan-title">{{__('Pack 1')}} + {{__('Unlimited Access to MCQs and Assignments')}}</h2>
                    <p class="plan-price">$1<span>/{{__('Month')}}</span></p>
                    <ul class="plan-features">
                    	<li><strong>{{__('Unlimited Access to MCQs')}}</strong></li>
                        <li><strong>{{__('Unlimited Access to assignments')}}</strong></li>
                        <li><strong>{{__('Online Discussion with Instructors')}}</strong></li>                        
                    </ul>
                    <p class=" col-md-10 col-md-offset-1 text-center"><a href="javascript:void(0)" class=" button_fullwidth">{{__('Subscribe Now')}}</a></p>
                </div><!-- End col-md-4 -->
                
                <div class="plan col-md-4">
                    <h2 class="plan-title">{{__('Pack 2')}} + {{__('Private Tutoring')}}</h2>
                    <p class="plan-price">$5.99<span>/{{__('Month')}}</span></p>
                    <ul class="plan-features">
                    	<li><strong>{{__('Video streaming with Instructors')}}</strong></li>
						<li><strong>{{__('Preparation for National Exams')}}</strong></li>
                        <li><strong>{{__('Preparation for entrance examination in Prestigious Schools')}}</strong></li>                        
                    </ul>
                    <p class=" col-md-10 col-md-offset-1 text-center"><a href="javascript:void(0)" class="button_medium">{{__('Subscribe Now')}}</a></p>
                </div><!-- End col-md-4 -->
                
            </div><!-- End row plans-->
            
            <hr>
			
            <div class="row">
                <div class="col-md-12">
                    <h3>{{__('Membership FAQ')}}</h3>
                </div>
            </div><!-- end row -->
            
            <div class="row">
            
                <div class="col-md-4">
                    <div class="question_box">
                        <h3>No sit debitis meliore postulant, per ex prompta alterum sanctus?</h3>
                        <p>
                            Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="question_box">
                        <h3>Autem putent singulis usu ea, bonorum suscipit eum?</h3>
                        <p>
                            Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="question_box">
                        <h3>Pro moderatius philosophia ad, ad mea mupercipitur?</h3>
                        <p>
                            Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.
                        </p>
                    </div>
                </div>
                
            </div><!-- end row -->
            
</div><!-- End container-->
</section>

@include('partials/footer')
  
	@section('scripts')
		<script src="{{asset('js/custom/config/config.js')}}"></script>
		<script src="{{asset('js/custom/custom.js')}}"></script>
	@stop
@stop 
