@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Instructor Dashboard')}}
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
          <li><a href="#">Dashboard</a></li>
          <li class="active">List of Courses</li>
        </ol>
        
        <div class="row">
        
        <aside class="col-lg-3 col-md-4 col-sm-4">
            <div class="box_style_1">
            	<h4>Categories</h4>
            <ul class="submenu-col">
                <li><a href="#">All Courses</a></li>
                <li><a href="course_details_1.html"  id="active">Biology (02)</a></li>
                <li><a href="course_details_1.html">Business (08)</a></li>
                <li><a href="course_details_1.html">Computing (08) </a></li>
                <li><a href="course_details_1.html">Counseling (04)</a></li>
                <li><a href="course_details_1.html">Education (06)</a></li>
                <li><a href="course_details_1.html">Engineering (08)</a></li>
            </ul>
            </div>
        </aside>
        
        <div class="col-lg-9 col-md-8 col-sm-8">
       
           <div class="panel panel-info filterable add_bottom_45">
                    <div class="panel-heading">
                        <h3 class="panel-title">List of courses</h3>
                        <div class="pull-right">
                            <button class="btn-filter"><span class="icon-th-list"></span> Filter</button>
                        </div>
                    </div>
                    <table class="table table-responsive table-striped">
                        <thead>
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="ID" disabled ></th>
                                <th><input type="text" class="form-control" placeholder="Course Name" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Short Name" disabled ></th>
                                <th><input type="text" class="form-control" placeholder="Category" disabled ></th>
								<th><input type="text" class="form-control" placeholder="Status" disabled ></th>
                            </tr>
                        </thead>
                        <tbody class='course_list'>                                                    
                        </tbody>
                    </table>
                    </div><!-- End filterable -->  
			<div class="row">
				<div class="col-md-12 text-right">
					<ul class="pagination">					  
					</ul>
				</div>
			</div>					
        </div><!-- End col-lg-9-->  
			
        </div><!-- End row -->       
        </div><!-- End container -->
    </section><!-- End main_content -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/custom.js')}}"></script>
   <script src="{{asset('js/custom/user/instructor/courses.js')}}"></script>
@stop

@stop 