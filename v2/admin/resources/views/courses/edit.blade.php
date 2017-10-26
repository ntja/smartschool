@extends('layouts.master')

@section('header-title')
Edit Course
@stop

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('plugins/dropzone/dropzone.min.css')}}">
@stop
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Course
        </h1>
    </section>
    <!-- Main content -->
    <section class="content course_id" data-course_id="<?php echo $course_id; ?>">
        <!-- Small boxes (Stat box) -->        
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-8 col-lg-offset-2 connectedSortable">
                <!-- general form elements -->
			  <div class="box box-primary">				
				<!-- form start -->
				<form role="form">
				  <div class="box-body">
					<div class="form-group">
					  <label for="course_title">Course Name</label>
					  <input type="text" class="form-control" id="course_title" placeholder="Enter course Name" disabled>
					</div>
					<div class="form-group">
					  <label for="short_name">Course Short Name</label>
					  <input type="text" class="form-control" id="short_name" placeholder="Enter Short Name" disabled>
					</div>					
					<div class="col-md-4 col-sm-6">
						<div class="form-group">
							<label class="control-label">Book Cover</label>
							<div class="dropzone dz-clickable" id="book_cover">
								<div class="dz-default dz-message">
									<span>Drop file here to upload</span>
								</div>
							</div>
						</div>
					</div>					
				  </div>
				  <!-- /.box-body -->

				  <div class="box-footer">
					<button type="submit" class="btn btn-primary" id="edit_btn">Save</button>
				  </div>
				</form>
			  </div>
			  <!-- /.box -->
            </section><!-- /.Left col -->            
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop
@section('script-footer')
<!-- Config -->
<script src="{{asset('js/custom/config/config.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('plugins/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('js/custom/courses/edit.js')}}"></script>

<script>
	/*--------- create remove function in dropzone --------*/
         Dropzone.autoDiscover = false;
         var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
         var fileList = new Array;
         var i = 0;
         $("#book_cover").dropzone({
           addRemoveLinks: true,
		   paramName: "image",
           maxFiles: 1, //change limit as per your requirements
		   //acceptedFiles: '.jpeg,.jpg,.png',
           dictMaxFilesExceeded: "Maximum upload limit reached",
		   dictDefaultMessage: "Add cover",
		   //previewsContainer: ".photo-thumb",
		   createImageThumbnails: true,
           acceptedFiles: acceptedFileTypes,
		   url: config.api_url + '/fileupload',
           dictInvalidFileType: "upload only JPG/PNG",
           init: function () {
               // Hack: Add the dropzone class to the element
               //$(this.element).addClass("dropzone");
			   this.on("success", function(file) {
                    var response = JSON.parse(file.xhr.responseText);
                    //$('.photo-thumb').html('<img src="' + $('body').attr('data-base-url') + '/public/'+ response["file_name"] + '" width="180px"/>');
                    $('#book_cover').data('cover', response["file_name"]);
					//$('#company_logo').addClass("hide");
                });
           }
         });
</script>
@stop