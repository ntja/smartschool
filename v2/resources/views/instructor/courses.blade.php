@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('List of Courses')}}
@stop

@section('header-scripts')
	<!--
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/lib/prototype.js')}}"></script>
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/src/scriptaculous.js')}}"></script>
	-->
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
					<button class="button_medium" data-toggle="modal" data-target="#myModal"><span class="icon-plus"></span>
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
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel"><span class="icon-plus"> Add a Course</span></h4>
					  </div>
					  <div class="modal-body">
						   <form role="form" class="form-horizontal" id="new-course"  action="javascript:void" method="post">                            
                            <div class="row">         
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <label class="control-label">Course Name</label>
                                            <input class="form-control" type="text" name="name" id="name" placeholder="Course Title" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">                                    
                                            <label class="control-label">Short Name</label>
                                            <input class="form-control" type="text" name="shortname" id="shortname" placeholder="Course short name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <div class="col-md-10 styled-select">
                                            <label class="control-label">Course Category</label>
                                            <select class="form-control select" data-live-search="true" name="category">
                                                <option value="1">Computer Science</option>
                                                <option value="2">Mathematics</option>
                                                <option value="3">Physics</option>
                                                <option value="4">Chemistry</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <label class="control-label">Course Language</label>
                                            <select class="form-control select" data-live-search="true" name="language">
                                                <option value="fr">French</option>
                                                <option value="en">English</option>                                        
                                            </select>
                                        </div>
                                    </div>                               
                                </div>
                            </div>                      
                            <div class="row">         
                                <div class="col-md-12">        
                                    <div class="form-group">
                                        <div class="col-md-11"> 
                                            <label class="control-label">Course Description <small>(What student will learn through this course)</small></label>     
                                             <textarea name="course_description" id="course_description" rows="10" cols="80">                
                                            </textarea>                            
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
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