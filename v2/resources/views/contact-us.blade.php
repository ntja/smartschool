@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Contact Us')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->   
    <link href="{{asset('css/single_course.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.min.css')}}">
@stop

@section('content')
<div class="notification-container"></div>
 @include('partials/header')
<section id="map"></section><!-- end map-->
  <section id="directions">
  	<div class="container">
    	<div class="row">
        <div class="col-md-8 col-md-offset-2">
       <form action="http://maps.google.com/maps" method="get" target="_blank">
            <div class="input-group">
                    <input type="text" name="saddr" placeholder="Enter your starting point" class="form-control style-2" />
                    <input type="hidden" name="daddr" value="New York, NY 11430"/><!-- Write here your end point -->
                    <span class="input-group-btn">
                    <button class="btn" type="submit" value="Get directions" style="margin-left:0;">GET DIRECTIONS</button>
                    </span>
            </div><!-- /input-group -->
        </form>
          </div>
        </div>
    </div>
  </section>
  
<section id="main_content" >
<div class="container">
<div class="row">
	<div class="col-md-4">
		<h3>Address</h3>
		<ul id="contact-info">
			<li><i class="icon-home"></i> 11 Fifth Ave - NJ, US</li>
			<li><i class="icon-phone"></i> + 61 (2) 8093 3400 / + 61 (2) 8093 3402</li>
			<li><i class=" icon-email"></i> <a href="#">info@domain.com</a></li>
		</ul>
		<hr>
		<h3>Follow us</h3>
		<p>
			Cu affert populo neglegentur has, labore nostrum periculis ius in, singulis electram ad vel labore.
		</p>
		<ul id="follow_us_contacts">
			<li><a href="#"><i class="icon-facebook"></i>fb.com/username</a></li>
			<li><a href="#"><i class="icon-twitter"></i>twitter.com/#username</a></li>
			<li><a href="#"><i class=" icon-google"></i>googleplus.com/username</a></li>
		</ul>
        <hr>
		<h3>Apply for a course</h3>
        <p>
			Cu affert populo neglegentur has, labore nostrum periculis ius in, singulis electram ad vel labore.
		</p>
        <a href="#" class="button_medium_outline">Apply</a>
	</div>
	<div class="col-md-8">
		<div class=" box_style_2">
			<span class="tape"></span>
			<div class="row">
				<div class="col-md-12">
					<h3>General Enquire</h3>
				</div>
			</div>
			<div id="message-contact"></div>
			<form method="post" action="assets/contact.php" id="contactform">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="name_contact" name="name_contact" placeholder="Enter Name">
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="lastname_contact" name="lastname_contact" placeholder="Enter Last Name">
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="email" id="email_contact" name="email_contact" class="form-control style_2" placeholder="Enter Email">
                            <span class="input-icon"><i class="icon-email"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" id="phone_contact" name="phone_contact" class="form-control style_2" placeholder="Enter Phone number">
                            <span class="input-icon"><i class="icon-phone"></i></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<textarea rows="5" id="message_contact" name="message_contact" class="form-control" placeholder="Write your message" style="height:200px;"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input type="text" id="verify_contact" class=" form-control" placeholder="Are you human? 3 + 1 =">
						<input type="submit" value="Submit" class=" button_medium" id="submit-contact"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</section>
 @include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/plugins/sudo-notify/jquery.sudo-notify.js')}}"></script>
@stop

@stop 
