@extends('layouts.master')

 

@section('header-title')

    User details

@stop



@section('stylesheets')

    <link rel="stylesheet" href="{{ asset('css/profile_page.css')}}">

    <link rel="stylesheet" href="{{ asset('css/edit_user.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/datatables/jquery.dataTables.min.css')}}">

@stop



@section('content')

<div class="content-wrapper">

    <section class="content">

        <div class="row">

            <div class="col-md-7">

                <!-- Début de tableau -->
				<h3>User details</h3>

                <div class="box">

                    <div class="box-header with-border">

                        <h3 class="box-title"> <span id="user_firstname"></span> <b id="user_lastname"></b></h3>

                    </div><!-- /.box-header -->

					<div class="box box-solid">
						<div class="box-body">
							<ul>
								<li><b>Email :</b> <span id="user_email"></span> </li>
								<li><b>Role :</b> <span id="user_role"></span></li>
								<li><b>Status :</b> <span id="user_status"></span></li>
								<li><b>Phone :</b> <span id="user_phone"></span></li>
								<li><b>Photo :</b> <img id="user_img"></li>
							</ul>
						</div>
                        <div class="box-footer">
                            <div class="pull-left">
                            <a class="btn btn-primary btn-sm"href="#" onclick="window.history.back();return false;"> Back</a>
                            </div>                          
                        </div>
					</div>
                </div>

            </div>

        </div>

    </section>

</div>

    

@stop



@section('script-footer')

    <script src="{{asset('js/main.js')}}"></script>

    <script src="{{asset('js/users/details.js')}}"></script>

    <script src="{{asset('js/app.min.js')}}"></script>

    <script src="{{asset('js/demo.js')}}"></script>
	<script src="{{asset('/plugins/purl/purl.js')}}"></script>
	<script src="{{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('/plugins/fastclick/fastclick.min.js')}}"></script>
@stop