@extends('layouts.master')

 

@section('header-title')

    Reset password

@stop



@section('stylesheets')

    <link rel="stylesheet" href="{{ asset('css/profile_page.css')}}">

    <link rel="stylesheet" href="{{ asset('css/edit_user.css')}}">

@stop



@section('content')

<div class="content-wrapper">

    <section class="content">

        <div class="row">
			
            <div class=" col-md-6">
			<h3>Reset password</h3>
                <!-- D?t de tableau -->

                <div class="box">

                    <div class="box-header with-border">

                        <h3 class="box-title">Details</h3>

                    </div><!-- /.box-header -->

                    <div class="box-body">
						<div class="alert alert-danger alert-dismissable" id="flash_info" hidden="hidden">
							<button class="close" aria-hidden="true" data-dismiss="alert" type="button">x</button>
							<h4>
								<i class="icon fa fa-ban"></i>
								Alert!
							</h4>
							<span id="msg"></span>
						</div>
						<form action="#" id="edit_user" onsubmit="return false;">
							<div class="form-group">
								<label for="input_password">Password*</label>
								<input type="password" class="form-control" name="input_password" id="input_password">
							</div>
							<div class="form-group">
								<label for="input_newpassword">New password*</label>
								<input type="password" class="form-control" name="input_newpassword" id="input_newpassword">
							</div>
							<div class="form-group">
								<label for="input_confirmation">Confirm new password*</label>
								<input type="password" class="form-control" name="input_confirmation" id="input_confirmation">
							</div>
						</form>
                    </div>
					<div class="box-footer">
						<span><button class="btn btn-default pull-left" id="cancel">Cancel</button></span>
						<span><button class="btn btn-info pull-right" type="submit" form="edit_user" id="save_btn">Save</button></span>
                    </div>
					
                </div>

            </div>

        </div>

    </section>

</div>

    

@stop



@section('script-footer')

    <script src="{{asset('js/main.js')}}"></script>
	<script src="{{asset('js/i18n.js')}}"></script>

    <script src="{{asset('js/password/reset.js')}}"></script>

    <script src="{{asset('js/app.min.js')}}"></script>

    <!--<script src="{{asset('js/demo.js')}}"></script>-->
	
	<script src="{{asset('/plugins/purl/purl.js')}}"></script>
	<script src="{{asset('/plugins/jQueryvalidate/jquery.validate.min.js')}}"></script>
	<script src="{{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('/plugins/fastclick/fastclick.min.js')}}"></script>
@stop