@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('List of Courses')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.min.css')}}">
@stop
@section('content')
	<div class="notification-container"></div>
	@include('partials/instructor/header')
   
    <section id="main_content">
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
				  <div class="response-message"></div>
				  <!-- Button trigger modal -->
					<a class="button_medium btn-round" href="<?php echo URL::to('/instructor/courses/add'); ?>"><span class="icon-plus"></span>
					  {{__('Create New Course')}}
					</a>
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
		<!-- modals . create course and edit course -->
		
		@include('instructor/partials/edit-course-modal')
		</div><!-- End row -->       
        </div><!-- End container -->
    </section><!-- End main_content -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>	
	<script src="{{asset('js/custom/custom.js')}}"></script>
	<script src="{{asset('js/custom/user/instructor/common-tasks.js')}}"></script>
	<script src="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.js')}}"></script>
	<script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
	<script> 
		//CKEDITOR.replace( 'course_description', {height : 500, width : '100%'} );
		CKEDITOR.replace( 'edit-course_description', {height : 500, width : '100%'} );
	</script>
   <script src="{{asset('js/custom/user/instructor/courses.js')}}"></script>
@stop

@stop 