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
	<link rel="stylesheet" href="{{asset('js/plugins/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('check_radio/skins/square/aero.css')}}">
	<link rel="stylesheet" href="{{asset('css/plugins/jqueryui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/plugins/jqueryui/jquery-ui.structure.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/plugins/jqueryui/jquery-ui.theme.min.css')}}">
	<!-- les couleurs peuvent définies au sein de la feuille di dessous-->
	<link rel="stylesheet" href="{{asset('css/plugins/jqueryui/jquery.ui.theme.css')}}">
@stop
@section('content')
	<div class="notification-container"></div>
	@include('partials/instructor/header')
   
  <section id="main_content">
	<div class="container">
		<ol class="breadcrumb">
          <li><a href="<?php echo URL::to('/instructor/dashboard'); ?>">{{__('Dashboard')}}</a></li>
		  <li><a href="<?php echo URL::to('/instructor/courses'); ?>">{{__('List of Courses')}}</a></li>
          <li class="active">{{__('Add a Course')}}</li>
        </ol>
	<!-- Start Survey container -->
	<div id="survey_container">
	
	<div id="top-wizard">	
		<div class="response-message"></div>
		<strong>Progress </strong>
		<div id="progressbar"></div>
		<div class="shadow"></div>
	</div><!-- end top-wizard -->
    
	<form name="example-1" id="create-course-form" action="#" method="POST" autocomplete="off" enctype="multipart/form-data">
		<div id="middle-wizard">
			<div class="step">
				<div class="box_style_2">					
							<div class="row">
								<h3 class="col-md-12 text-center text-info"><strong>{{__('Please fill out the form below to create your course')}}</strong></h3>
								<div class="col-md-6">
									<ul class="data-list">
										<li>
											<label class="control-label">{{__('Course Title')}}</label><i class="text-danger">*</i>
											<div class="form-group">
												<input type="text" name="course_title" id="course_title" class="required form-control" placeholder="{{__('Course Title')}}" required>
											</div>													
										</li>
										<li>
											<label class="control-label">{{__('Short Name')}}</label><i class="text-danger">*</i>
											<div class="form-group">
												<input type="text" name="short_name" id="short_name" class="required form-control" placeholder="{{__('Short Name')}}" required>
											</div></li>
										<li>
											<label class="control-label">{{__('Course Format')}}<small> ({{__('how your lessons will be organized')}})</small></label><i class="text-danger">*</i>
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
											<label class="control-label">{{__('Target Audience')}}</label><i class="text-danger">*</i>
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
											<label class="control-label">{{__('Course Subject')}}</label><i class="text-danger">*</i>
											<div class="styled-select">
												<select class="form-control required" name="category_list" id="category_list">
													<option value="">{{__('Select a Subject')}}</option>
												</select>														
											</div>
										</li>
										<li>
											<label class="control-label">{{__('Course Language')}}</label><i class="text-danger">*</i>
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
											<label class="control-label">{{__('Course Description')}} <small>( {{__('About the Course') }})</small></label><i class="text-danger">*</i>
											<textarea class="form-control required" name="course_description" id="course_description" rows="30" cols="100" required>
											</textarea>                            
										</div>
									</div>                                    
								</div>
							</div><!-- end row -->								
						</div><!-- end step-->
			</div><!-- end step-->
            
			<div class="step row">
				<div class="col-md-3 col-sm-6">
				<ul class="data-list">
					<li>
						<label class="control-label">{{__('Start Date')}}</label>
						<div class="form-group">
							<input type="date" name="start_date" id="start_date" class="form-control" placeholder="{{__('Start Date')}}">
						</div>													
					</li>												
				</ul>
			</div><!-- end col-md-3 -->			
			<div class="col-md-3 col-sm-6">
				<ul class="data-list">					
					<li>
						<label class="control-label">{{__('Expected Duration')}}</label>
						<div class="form-group">
							<input type="number" name="expected_duration" id="expected_duration" class="form-control" placeholder="{{__('Expected Duration')}}">
						</div>
					</li>
				</ul>
			</div><!-- end col-md-3 -->			
			<div class="col-md-3 col-sm-6">
				<ul class="data-list">
					<li>
						<label class="control-label">{{__('Expected Duration Unit')}}</label>
						<div class="styled-select">
							<select class="form-control" name="expected_duration_unit" id="expected_duration_unit">
								<option value="">{{__('Select a Duration Unit')}}</option>
								<option value="days">{{__('Days')}}</option>
								<option value="weeks">{{__('Weeks')}}</option>
								<option value="months">{{__('Months')}}</option>
							</select>														
						</div>
					</li>
				</ul>
			</div><!-- end col-md-3 -->
			<div class="col-md-3 col-sm-6">
				<div class="form-group">
					<label class="control-label">{{__('Course Cover')}}</label>
					<div class="dropzone dz-clickable" id="dropzone">
						<div class="dz-default dz-message">
							<span>{{__('Drop file here to upload')}}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="form-group">					
					<label class="control-label">{{__('Expected Learning')}} <small>( {{__('What student will learn through this course') }})</small></label>     
					<textarea class="form-control" name="expected_learning" id="expected_learning" rows="30" cols="100">
					</textarea>					
				</div>                                    
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="form-group">					
					<label class="control-label">{{__('Suggested Readings')}} <small>( {{__('Courses or books student might read in order to succeed in this course') }})</small></label>     
					<textarea class="form-control" name="suggested_readings" id="suggested_readings" rows="30" cols="100">
					</textarea>                            					
				</div>
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="form-group">					
					<label class="control-label">{{__('Recommended Background')}} <small>( {{__('Background needed to succeed in this Course') }})</small></label>     
					<textarea class="form-control" name="recommended_background" id="recommended_background" rows="30" cols="100">
					</textarea>					
				</div>                                    
			</div>
			<div class="col-md-12 col-sm-12">
				<div class="form-group">					
					<label class="control-label">{{__('Frequently Asked Questions (FAQ)')}} <small>( {{__('Questions that are often asked regarding this course') }})</small></label>     
					<textarea class="form-control" name="faq" id="faq" rows="30" cols="100">
					</textarea>					
				</div>                                    
			</div>								
			<div class="submit" id="complete">                    	
				<button type="submit" name="process" class="button_medium" id="submit_btn">{{__('Create your Course')}}</button>
			</div><!-- end submit-->				
		</div><!-- end step -->            			
            
		</div><!-- end middle-wizard -->
        
		<div id="bottom-wizard">
			<button type="button" name="backward" class="backward">Go Back</button>
			<button type="button" name="forward" class="forward">Next </button>
		</div><!-- end bottom-wizard -->
	</form>
    
</div><!-- end Survey container -->

</div>
</section><!-- end section main container -->

@include('partials/footer')

@section('scripts')
	<!-- Wizard-->
	<script src="{{asset('js/plugins/jqueryui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('js/jquery.wizard.js')}}"></script>
	<script src="{{asset('check_radio/jquery.icheck.js')}}"></script>
	<script src="{{asset('js/wizard_func.js')}}"></script>
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
	<script src="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.js')}}"></script>
	<script src="{{asset('jjs/plugins/dropzone/dropzone.min.js')}}"></script>
	<script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>	
	<script>
	$(function() {
		var local = $('body').data('locale');
		$.datepicker.setDefaults( $.datepicker.regional[ local ] );
		$( "#start_date" ).datepicker( {
			dateFormat: "DD, MM d, yy"
		} );
		$( "#end_date" ).datepicker( {
			dateFormat: "DD, MM d, yy"
		});
		//$( "#end_date" ).datepicker( $.datepicker.regional[ local ] );
		/*
		$( "#locale" ).change(function() {
			$( "#datepicker" ).datepicker( "option",
				$.datepicker.regional[ $( this ).val() ] );
		});
		*/
	});
	</script>
	<!---->
	<script> 
		CKEDITOR.replace( 'course_description',
			{
				height : 400, 
				width : '100%',		
				toolbarGroups: [
					{ name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
					{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
					'/',																// Line break - next group will be placed in new line.
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'links' },
					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
					{ name: 'styles' },
					{ name: 'colors' }
				]
			} 
		);
		CKEDITOR.replace( 'expected_learning', 
			{
				height : 200,
				width : '100%',		
				toolbarGroups: [
					{ name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
					{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
					'/',																// Line break - next group will be placed in new line.
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'links' }
				]
			} 
		);
		CKEDITOR.replace( 'faq', 
		{
			height : 100, 
			width : '100%',		
				toolbarGroups: [
					{ name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
					{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
					'/',																// Line break - next group will be placed in new line.
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'links' }
				]
			} 
		);
		CKEDITOR.replace( 'suggested_readings', 
			{
				height : 100, 
				width : '100%',		
				toolbarGroups: [
					{ name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
					{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
					'/',																// Line break - next group will be placed in new line.
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'links' }
				]
			} 
		);
		CKEDITOR.replace( 'recommended_background', 
			{
				height : 100, 
				width : '100%',		
				toolbarGroups: [
					{ name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
					{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
					'/',																// Line break - next group will be placed in new line.
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'links' }
				]
			} 
		);
		//CKEDITOR.replace( 'edit-course_description', {height : 400, width : '100%'} );
	</script>	
	
   <script src="{{asset('js/custom/user/instructor/courses/add-course.js')}}"></script>   
@stop

@stop 