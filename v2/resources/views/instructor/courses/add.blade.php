@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('List of Courses')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.min.css')}}">
	<!-- Toggle Switch -->
    <link rel="stylesheet" href="{{asset('css/jquery.switch.css')}}">
    <link href="{{asset('check_radio/skins/square/aero.css')}}" rel="stylesheet">
@stop
@section('content')
	<div class="notification-container"></div>
	@include('partials/instructor/header')
   
  <section id="wizard_bg">
	<div class="container">
	<!-- Start Survey container -->
	<div id="survey_container">


	<div id="top-wizard">
		<strong>Progress </strong>
		<div id="progressbar"></div>
		<div class="shadow"></div>
	</div><!-- end top-wizard -->
    
	<form name="example-1" id="wrapped" action="#" method="POST" autocomplete="off">
		<div id="middle-wizard">
			<div class="step">
				<div class="box_style_2">
							<div class="row">
								<h3 class="col-md-12 text-center text-info"><strong>{{__('Please Fill out the Form below to create your course')}}</strong></h3>
								<div class="col-md-6">
									<ul class="data-list">
										<li>
											<label class="control-label">{{__('Course Title')}}</label>
											<div class="form-group">
												<input type="text" name="course_title" id="course_title" class="required form-control" placeholder="{{__('Course Title')}}" required>
											</div>													
										</li>
										<li>
											<label class="control-label">{{__('Short Name')}}</label>
											<div class="form-group">
												<input type="text" name="short_name" id="short_name" class="required form-control" placeholder="{{__('Short Name')}}" required>
											</div></li>
										<li>
											<label class="control-label">{{__('Course Format')}} <small>({{__('how your lessons will be organized')}})</small></label>
											<div class="styled-select">
												<select class="form-control required" name="course_format" id="course_format">
													<option value="">{{__('Select a Format')}}</option>
													<option value="SECTIONS">{{__('SECTIONS')}}</option>
													<option value="CHAPTERS">{{__('CHAPTERS')}}</option>
													<option value="MODULES">{{__('MODULES')}}</option>
													<option value="PARTS">{{__('PARTS')}}</option>
												</select>
												
											</div>
										</li>
									</ul>
								</div><!-- end col-md-6 -->
								<div class="col-md-6">                        
									<ul class="data-list" style="margin:0; padding:0;">
										<li>
											<label class="control-label">{{__('Target Audience')}}</label>
											<div class="styled-select">
												<select class="form-control required" name="target_audience" id="target_audience">
													<option value="">{{__('Select an Audience')}}</option>
													<option value="0">{{__('Beginner')}}</option>
													<option value="1">{{__('Intermediate')}}</option>
													<option value="2">{{__('Advanced')}}</option>
													<option value="3">{{__('Other')}}</option>
												</select>														
											</div>
										</li>
										<li>
											<label class="control-label">{{__('Course Subject')}}</label>
											<div class="styled-select">
												<select class="form-control required" name="category_list" id="category_list">
													<option value="">{{__('Select a Subject')}}</option>
												</select>														
											</div>
										</li>
										<li>
											<label class="control-label">{{__('Course Language')}}</label>
											<div class="styled-select">
												<select class="form-control required" name="language" id="language">
													<option value="">{{__('Select a Language')}}</option>
													<option value="en">{{__('English')}}</option>
													<option value="fr">{{__('French')}}</option>
												</select>														
											</div>
										</li>
									</ul>									
								</div><!-- end col-md-6 -->
							</div><!-- end row -->
							<div class="row">         
								<div class="col-md-12">        
									<div class="form-group">
										<div class="col-md-12"> 
											<label class="control-label">{{__('Course Description')}} <small>( {{__('What student will learn through this course') }})</small></label>     
											<textarea class="form-control required" name="course_description" id="course_description" rows="30" cols="100" required>
											</textarea>                            
										</div>
									</div>                                    
								</div>
							</div><!-- end row -->								
						</div><!-- end step-->
                
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<ul class="data-list" id="terms">
							<li>
                            <strong>Do you accept <a href="#" data-toggle="modal" data-target="#terms-txt">terms and conditions</a> ?</strong>
                           <label class="switch-light switch-ios ">
                                    <input type="checkbox" name="terms" class="required fix_ie8" value="yes">
                                    <span>
                                        <span class="ie8_hide">No</span>
                                        <span>Yes</span>
                                    </span>
                                    <a></a>
                                </label>
							</li>
						</ul>
					</div>
				</div>
                
			</div><!-- end step-->
            
			<div class="step row">
				<div class="col-md-12">
					<h3>Your preferences</h3>
                     <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					
                    <ul class="data-list-2 clearfix">
						<li><input name="course_1[]" type="checkbox" class="required check_radio" value="Management: Build a Business Plan"><label>Management: Build a Business Plan</label></li>
						<li><input name="course_1[]" type="checkbox" class="required check_radio" value="Art: Impressionist "><label>Art: Impressionist </label></li>
						<li><input name="course_1[]" type="checkbox" class="required check_radio" value="Litteratture: Poetry"><label>Litteratture: Poetry</label></li>
						<li><input name="course_1[]" type="checkbox" class="required check_radio" value="Math: 12 Principles"><label>Math: 12 Principles</label></li>
					</ul>
				</div>
			</div><!-- end step -->
            
			<div class="step row">
				<div class="col-md-12">
					<h3>Additional message</h3>
                   <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<div class="form-group">
							<textarea rows="5" id="message_apply_1" name="message_apply_1" class="form-control" placeholder="Additional message" style="height:150px;"></textarea>
						</div>
				</div>
			</div><!-- end step -->
                        
			<div class="submit step" id="complete">
                    	<i class="icon-check"></i>
						<h3>Apply complete! Thank you for you time.</h3>
						<button type="submit" name="process" class="submit">Submit your apply</button>
			</div><!-- end submit step -->
            
		</div><!-- end middle-wizard -->
        
		<div id="bottom-wizard">
			<button type="button" name="backward" class="backward">Backward</button>
			<button type="button" name="forward" class="forward">Forward </button>
		</div><!-- end bottom-wizard -->
	</form>
    
</div><!-- end Survey container -->

</div>
</section><!-- end section main container -->

@include('partials/footer')

@section('scripts')
	<!-- Wizard-->
	<script src="{{asset('js/jquery-ui-1.8.12.min.js')}}"></script>
	<script src="{{asset('js/jquery.wizard.js')}}"></script>
	<script src="{{asset('js/jquery.validate.js')}}"></script>
	<script src="{{asset('check_radio/jquery.icheck.js')}}"></script>
	<script src="{{asset('js/wizard_func.js')}}"></script>
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
	<script src="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.js')}}"></script>
	<script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
	<!---->
	<script> 
		CKEDITOR.replace( 'course_description', {height : 400, width : '100%'} );
		CKEDITOR.replace( 'edit-course_description', {height : 400, width : '100%'} );
	</script>	
	
   <script src="{{asset('js/custom/user/instructor/courses.js')}}"></script>   
@stop

@stop 