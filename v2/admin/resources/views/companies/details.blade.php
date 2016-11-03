@extends('layouts.master')

 

@section('header-title')

    Company details

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
				<h3>Company details</h3>
				
				<h4><a href="#" id="jobs">Jobs</a></h4>

                <div class="box">

                    <div class="box-header with-border">

                        <h3 class="box-title"> <span id="cmp_name_1"></span></h3>

                    </div><!-- /.box-header -->

					<div class="box box-solid">
						<div class="box-body">
							<ul>
								<li><b>Employer :</b> <span id="cmp_empl_name"></span> (<span id="cmp_empl_position"></span>)</li>
								<li><b>Name :</b> <span id="cmp_name"></span></li>
								<li><b>Phone Number :</b> <span id="cmp_mobile_number"></span></li>
								<li><b>Mailing Address :</b> <span id="cmp_mailing_address"> </span></li>
								<li><b>Fax Number :</b> <span id="cmp_fax_number"></span></li>
								<li><b>Description :</b> <span id="cmp_description"></span></li>
								<li><b>Logo :</b> <span id="cmp_img"></span></li>
								<li><b>Email :</b> <span id="cmp_email"></span></li>
								<li><b>Video :</b> <span id="cmp_video"></span></li>
								<li><b>Status :</b> <span id="cmp_status"></span></li>
								<!-- <li>
									<h3 class="box-title">Campagnes publicitaires</h3>
									<ul id="campaign_list">
										<li>Lorem ipsum dolor sit amet</li>
									</ul>
								</li> -->
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

    <script src="{{asset('js/companies/details.js')}}"></script>

    <script src="{{asset('js/app.min.js')}}"></script>

    <script src="{{asset('js/demo.js')}}"></script>
	<script src="{{asset('/plugins/purl/purl.js')}}"></script>
	<script src="{{asset('/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('/plugins/fastclick/fastclick.min.js')}}"></script>
@stop