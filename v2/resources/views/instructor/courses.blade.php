@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('List of Courses')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop
@section('content')
	@include('partials/header-connected-user')
   
    <section id="main_content" >
    	<div class="container">
        
        <ol class="breadcrumb">
          <li><a href="<?php echo URL::to('/instructor/dashboard'); ?>">{{__('Dashboard')}}</a></li>
          <li class="active">{{__('List of Courses')}}</li>
        </ol>
        
        <div class="row">
        
        <aside class="col-lg-3 col-md-4 col-sm-4">
			<div class="list-group border-bottom">
				<a href="#" class="list-group-item"><span class="icon-lock"></span> {{__('Published')}} <span class="badge badge-success count_publish">0</span></a>
				<a href="#" class="list-group-item"><span class="icon-lock-alt"></span> {{__('Unpublished')}} <span class="badge badge-warning count_unpublish">0</span></a>                                
			</div>
            
        </aside>
        
        <div class="col-lg-9 col-md-8 col-sm-8">
			<div class="row">
			  <div class="col-md-12">
				<!--  Modal -->     
				 
				  <!-- Button trigger modal -->
					<button class="button_medium btn-round" data-toggle="modal" data-target="#myModal"><span class="icon-plus"></span>
					  {{__('Create New Course')}}
					</button>
				</div>
			</div>
           <div class="panel panel-info filterable add_bottom_45">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('List of Courses')}}</h3>
                        <div class="pull-right">
                            <button class="btn-filter"><span class="icon-th-list"></span> {{__('Filter')}}</button>
                        </div>
                    </div>
					 <div class="table-responsive no-course">
						<table class="table table-striped">
							<thead>
								<tr class="filters">
									<th><input type="text" class="form-control" placeholder="{{__('ID')}}" disabled ></th>
									<th><input type="text" class="form-control" placeholder="{{__('Course Name')}}" disabled></th>
									<th><input type="text" class="form-control" placeholder="{{__('Short Name')}}" disabled ></th>
									<th><input type="text" class="form-control" placeholder="{{__('Category')}}" disabled ></th>
									<th><input type="text" class="form-control" placeholder="{{__('Status')}}" disabled ></th>
								</tr>
							</thead>
							<tbody class='course_list'>                                                    
							</tbody>
						</table>
					 </div>
                    </div><!-- End filterable -->  
					<div class="row">
						<div class="col-md-12 text-right">
							<ul class="pagination">					  
							</ul>
						</div>
					</div>					
        </div><!-- End col-lg-9-->  
		<div class="row">
			<div class="col-md-12">				
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">
					  <div class="modal-header bg-info">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel"><span class="icon-plus"> Add Course form</span></h4>
					  </div>
					  <div class="modal-body">							 
							<form name="example-1" id="wrapped" action="apply_send.php" method="POST" autocomplete="off">
								<div class="step">
									<div class="row">
										<h3 class="col-md-10">Enter the Information of Course</h3>
										<p class="col-md-12">Please FIll out the Form below to create your course</p>
										<div class="col-md-6">
											<ul class="data-list">
												<li>
													<label class="control-label">Course Title</label>
													<div class="form-group">
														<input type="text" name="course_title" class="required form-control" placeholder="Course Title">
														
													</div>													
												</li>
												<li>
													<label class="control-label">Short Name</label>
													<div class="form-group">
														<input type="text" name="short_name" class="required form-control" placeholder="Short Name">
														
													</div></li>
												<li>
													<label class="control-label">Course Format</label>
													<div class="styled-select">
														<select class="form-control required" name="format">
															<option value=""></option>
															<option value="1">SECTIONS</option>
															<option value="2">CHAPTERS</option>
															<option value="3">MODULES</option>
															<option value="4">PARTS</option>
														</select>
														
													</div>
												</li>
											</ul>
										</div><!-- end col-md-6 -->
										<div class="col-md-6">                        
											<ul class="data-list" style="margin:0; padding:0;">
												<li>
													<label class="control-label">Target Audience</label>
													<div class="styled-select">
														<select class="form-control required" name="target_audience">
															<option value=""></option>
															<option value="3">College</option>
															<option value="4">High School</option>
														</select>
														
													</div>
												</li>
												<li>
													<label class="control-label">Course Category</label>
													<div class="styled-select">
														<select class="form-control required" name="category" id="category_list">
															<option value=""></option>
															<option value="1">Computer Science</option>
															<option value="2">Mathematics</option>
															<option value="3">Physics</option>
															<option value="4">Chemistry</option>
														</select>
														
													</div>
												</li>
												<li>
													<label class="control-label">Course Language</label>
													<div class="styled-select">
														<select class="form-control required" name="language">
															<option value=""></option>
															<option value="1">English</option>
															<option value="4">French</option>
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
													<label class="control-label">Course Description <small>(What student will learn through this course)</small></label>     
													 <textarea name="course_description" id="course_description" rows="30" cols="100">                
													</textarea>                            
												</div>
											</div>                                    
										</div>
									</div>
										
								</div><!-- end step-->            			
						</form>
					</div>
					  <div class="modal-footer">
						<button type="button" class=" button_medium_outline" data-dismiss="modal"><span class="icon-cross"></span> Close</button>
						<button type="button" class="button_medium"><span class="icon-save"></span> Create Course</button>
					  </div>
					</div>
				  </div>
				</div>
			</div>
		</div>
        </div><!-- End row -->       
        </div><!-- End container -->
    </section><!-- End main_content -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
	<script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
	<script> CKEDITOR.replace( 'course_description' ); </script>
   <script src="{{asset('js/custom/user/instructor/courses.js')}}"></script>
@stop

@stop 