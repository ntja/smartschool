@extends('layouts.master')

@section('header-title')
    SmartSchool | Login
@stop
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">        
@stop
@section('meta')
	<meta name="google-signin-client_id" content="680136808075-kfu3182cvsjutul22gqako40n3in04ct.apps.googleusercontent.com">
@stop
@section('content')
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=354610674927093";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	<!--
	<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1322688107743985',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
-->
<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.


<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>
-->
<div id="status">
</div>	
    <!-- START SITE -->
    <div id="wrapper">
        @include('partials/header')
               
        <section class="section login">
            <div class="container">            
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="widget contentwidget">                        
                            <div class="loginbox text-center">
                            <div class="response-message"></div>
                                <h3>Welcome Back ! Log In to your account</h3>                                
                                <form class="form-horizontal"  action="#" method="post" id="signin" >
                                    <input type="email" name="email" id="email" placeholder="Email address" required class="form-control" />
                                    <input type="password" name="password" id="password" placeholder="Password" required class="form-control" />
                                    {{csrf_field()}}
                                    <button class="btn btn-primary btn-block" id="submit_btn">Login</button>
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox1" type="checkbox" class="styled" checked>
                                        <label for="checkbox1">
                                            <small>Remember me</small>
                                        </label>
                                    </div>
                                    <div class="login-or">OR</div>
                                    <div class="form-group">
                                        <!--
                                        <div class="col-md-4">
                                            <button class="btn btn-info btn-block btn-twitter"><span class="fa fa-twitter"></span> Twitter</button>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <button class="btn btn-info btn-block btn-facebook"><span class="fa fa-facebook"></span> Facebook</button>
                                        </div>
										-->
										<!--
                                        <div class="col-md-6">                            
                                            <button class="btn btn-info btn-block btn-google"><span class="fa fa-google-plus"></span> Google</button>
                                        </div>
										-->
										<div class="g-signin2 col-md-6"  data-width="180" data-height="40" data-onsuccess="onSignIn"></div>
										<div class="fb-login-button col-md-6" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false"></div>										
                                    </div>
                                    <p>
                                        <a href="<?php echo URL::to('/forgot-password'); ?>">Forgot your password ?</a><br>
                                        Don't have an account yet ? <a href="<?php echo URL::to('/register'); ?>">Create an account</a>
                                    </p>
                                </form>         
                            </div><!-- end newsletter -->
                        </div><!-- end widget -->
                    </div>
                </div>
            </div>
        </section>
    </div><!-- end wrapper -->

    <div class="dmtop">Scroll to Top</div>
    <!-- END SITE -->
@stop    
    @section('scripts')    
	<script src="https://apis.google.com/js/platform.js" async defer></script>	
    <script src="{{asset('js/plugins.js')}}"></script>
    <script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/user/login.js')}}"></script>
	<script>
		function onSignIn(googleUser) {
		  var profile = googleUser.getBasicProfile();
		  var id_token = googleUser.getAuthResponse().id_token;
		  console.log('Token: ' + id_token);
		  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
		  console.log('Given Name: ' + profile.getGivenName());
		  console.log('Family Name: ' + profile.getFamilyName());
		  console.log('Image URL: ' + profile.getImageUrl());
		  console.log('Email: ' + profile.getEmail());
		}
	</script>
    @stop