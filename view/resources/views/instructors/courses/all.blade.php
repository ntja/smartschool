@extends('layouts.master')

@section('header-title')
SmartSchool :: Instructor All Courses
@stop
    
@section('header-styles')
    
@stop

@section('content')
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">                
            
            <!-- PAGE CONTENT -->
            <div class="page-content">                                
                @include('instructors/partials.header')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{url('/instructors/dashboard')}}">Home</a></li>
                    <li class="active">My Courses</li>
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
                    <h2><span class="fa fa-folder-open-o"></span> My Courses</h2>
                </div>
                <!-- END PAGE TITLE -->                     
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                    <div class="row">                                  
                        <div class="col-md-2">
                            <div class="list-group border-bottom">
                                <a href="#" class="list-group-item"><span class="fa fa-inbox"></span> Unpublished <span class="badge badge-success">0</span></a>
                                <a href="#" class="list-group-item"><span class="fa fa-star"></span> Published <span class="badge badge-warning">0</span></a>                                
                            </div>
                        </div>
                        <div class="col-md-10">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_basic"><span class="fa fa-plus"></span>Create new course</button>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body panel-body-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-actions table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30%">Name</th>
                                                <th width="30%">Short Name</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>Language</th>
                                                <th width="10%">Number of Learners</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                            </tr>
                                            <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                            </tr>                                                                                                
                                            <tr>
                                                <td>Suki Burks</td>
                                                <td>Developer</td>
                                                <td>London</td>
                                                <td>53</td>
                                                <td>2009/10/22</td>
                                                <td>$114,500</td>
                                            </tr>
                                            <tr>
                                                <td>Prescott Bartlett</td>
                                                <td>Technical Author</td>
                                                <td>London</td>
                                                <td>27</td>
                                                <td>2011/05/07</td>
                                                <td>$145,000</td>
                                            </tr>
                                            <tr>
                                                <td>Gavin Cortez</td>
                                                <td>Team Leader</td>
                                                <td>San Francisco</td>
                                                <td>22</td>
                                                <td>2008/10/26</td>
                                                <td>$235,500</td>
                                            </tr>
                                            <tr>
                                                <td>Martena Mccray</td>
                                                <td>Post-Sales support</td>
                                                <td>Edinburgh</td>
                                                <td>46</td>
                                                <td>2011/03/09</td>
                                                <td>$324,050</td>
                                            </tr>
                                            <tr>
                                                <td>Unity Butler</td>
                                                <td>Marketing Designer</td>
                                                <td>San Francisco</td>
                                                <td>47</td>
                                                <td>2009/12/09</td>
                                                <td>$85,675</td>
                                            </tr>                                                               
                                        </tbody>
                                    </table>
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
<script src="{{asset('js/instructors/courses/all.js')}}"></script>
<script>
    $('#summernote_course').summernote({height: 220, focus: false,
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