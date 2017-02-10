@extends('layouts.master')

@section('header-title')
SmartSchool :: Instructor All Courses
@stop
    
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('styles/theme-default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/custom.css')}}">    
@stop

@section('content')
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">            
            <!-- PAGE CONTENT -->
            <div class="page-content">                                
                @include('instructors/partials.header')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{url('/instructors/dashboard')}}">{{trans('instructor.all-5')}}</a></li>
                    <li class="active">{{trans('instructor.all-1')}}</li>
                </ul>
                <!-- END BREADCRUMB -->   
                <!-- PAGE TITLE -->
                <div class="row">                                  
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <div class="response-message"></div>
                    </div>                
                </div>

                <div class="page-title">                    
                    <h2><span class="fa fa-folder-open-o"></span> {{trans('instructor.all-1')}}</h2>
                </div>
                <!-- END PAGE TITLE -->                     
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                    <div class="row">                                  
                        <div class="col-md-2">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item"><span class="fa fa-inbox"></span> {{trans('instructor.all-2')}} <span class="badge badge-success">0</span></a>
                                <a href="#" class="list-group-item"><span class="fa fa-star"></span> {{trans('instructor.all-3')}} <span class="badge badge-warning">0</span></a>                                
                            </div>
                        </div>
                        <div class="col-md-10">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_basic"><span class="fa fa-plus"></span>{{trans('instructor.all-4')}}</button>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-actions display table-hover" id="course" width="100%">                                    
                                        <thead>
                                            <tr>
                                                <th width="30%">Name</th>
                                                <th>Short Name</th>
                                                <th width="8%">Status</th>
                                                <th>Category</th>
                                                <th width="5%">Language</th>
                                                <th width="18%">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="panel-footer">                            
                                    <div class="row">
                                        <div class="col-md-2  pull-right">
                                            <button type="button" class="btn btn-default active hide" id="prev">Previous</button>
                                            <button type="button" class="btn btn-default active hide" id="next">Next</button>
                                        </div>                                        
                                    </div>                                    
                                </div>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        </div>
                     </div>                                                    
                </div>
                <!-- MODALS -->        
        <div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead"><span class="fa fa-pencil"></span> Create course</h4>                
                    </div>
                    <div class="modal-body">
                        <form role="form" class="form-horizontal" id="new-course"  action="javascript:void" method="post">                            
                            <div class="row">         
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <label class="control-label">Name</label>
                                            <input class="form-control" type="text" name="name" id="name" placeholder="Course Title" />
                                            <span class="help-block">Example: Mathematic</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10">                                    
                                            <label class="control-label">Short Name</label>
                                            <input class="form-control" type="text" name="shortname" id="shortname" placeholder="Course short name" />
                                            <span class="help-block">Example: Math</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <label class="control-label">Course Categories</label>
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
                                            <textarea id="summernote_course" name="shortdescription">                 
                                            </textarea>                            
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </form>                        
                    </div>
                    <div class="modal-footer">
                         <button id="create-course" class="btn btn-success pull-left"><span class="fa fa-plus"></span> Create Course</button>
                         <span class="pull-left loader">
                            <img src="{{asset('img/loaders/default.gif')}}">
                        </span>
                        <button type="button" class="btn btn-danger" id="close" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                    </div>
                </div>
            </div>
        </div>                                          
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
@stop   

@section('scripts')
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/actions.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/instructors/courses/all.js')}}"></script>
<script>
    $('#summernote_course').summernote({height: 200, focus: false,
        toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['strikethrough']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']]                                                          
        ]
    });
</script>
@stop