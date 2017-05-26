<?php

 $client_id = '97971554904-h8bcjdqf2v6k8vg4glcbv8ke9pu1sohi.apps.googleusercontent.com';
 //$redirect_uri = 'http://sw.ai/staging/squirrel/view/public/login';
 $redirect_uri = 'http://stagging.smartskul.com/login';
 $scope = "https://www.googleapis.com/auth/plus.profile.emails.read+https://www.googleapis.com/auth/plus.login+https://www.googleapis.com/auth/plus.me"; //google scope to access
$state = "profile"; //optional
$access_type = "offline"; //optional - allows for retrieval of refresh_token for offline access
$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?scope=%s&state=%s&redirect_uri=%s&response_type=code&client_id=%s&access_type=%s", $scope, $state, $redirect_uri, $client_id, $access_type);

$network_code='';        
//echo $_REQUEST['code'];

if(isset($_REQUEST['code'])){
    $network_code = $_REQUEST['code'];
}
?>

@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Log in')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop
@section('header-scripts')
	<!--
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/lib/prototype.js')}}"></script>
	<script src="{{asset('js/plugins/scriptaculous-js-1.9.0/src/scriptaculous.js')}}"></script>
	-->
@stop
@section('content')

 @include('partials/header')

<section id="login_bg">
<div  class="container">
<div class="row">
	<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
		<div id="login">
			<h3 class="text-center">
			{{__('Start learning on SmartSchool')}}
			</h3>
			<hr>
			<form id="login-form" method="post">
				<div class="row">
					<div class="col-md-6 col-sm-6 login_social">
						<a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
					</div>
					<div class="col-md-6 col-sm-6 login_social">
						<a  data-network="<?php echo $network_code; ?>" data-url="<?php echo $loginUrl; ?>" href='javascript:;' title="google login" id='google-login' class="btn btn-danger btn-block "><i class="icon-google"></i>Google+</a>
					</div>
				</div> <!-- end row -->
				<div class="login-or"><hr class="hr-or"><span class="span-or">{{__('or')}}</span></div>
				<div class="response-message"></div>
				<div class="form-group">
					<input type="email" class=" form-control required" name="email" id="email" placeholder="{{__('Email')}}" required autofocus>
					<span class="input-icon"><i class="icon-email"></i></span>
				</div>
				<div class="form-group">
					<input type="password" class=" form-control required" name="password" id="password" placeholder="{{__('Password')}}" required>
					<span class="input-icon"><i class=" icon-lock"></i></span>
				</div>
				<div class="form-group">
					<input type="number" id="verify_human" name="verify_human" class="form-control" placeholder="{{__('Are you human ?')}} 3 + 1 =" required>
				</div>
				<p class="small">
					<a href="<?php echo URL::to('/forgot-password'); ?>">{{__('Forgot Password')}} ?</a>
					<span class="pull-right">
						<a href="<?php echo URL::to('/register'); ?>">{{__('Register')}}</a>
					</span>
				</p>				
				{{ csrf_field() }}
				<button id="submit_btn" class="button_fullwidth">{{__('Log in')}}</button>
			</form>
		</div>
	</div>
</div>
</div>
</section> <!-- End login -->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
   <script src="{{asset('js/custom/user/login.js')}}"></script>
   <script>
     $(document).ready(function(){
         $(".login").attr("href",$('.login').data("url"));
         var network_code = $('.login').data("network");
         console.log(network_code);
		 var url = config.api_url +"/accounts/social-login";
		 console.info(url);
         if(network_code){
            google_authenticate(network_code,url);
         }     
     });
     
     function google_authenticate(network_code, url) {         
        var token = network_code;
        $(document).ready(function(){
        //console.error(token);
            if (token) {
                //var url = "http://sw.ai/staging/squirrel/public/accounts/social-login";
                var data = {"network":"google", "network_token":token};
                $.ajax({
                    url: url,
                    method: "POST",
                    headers: {
                        "content-type": "application/json"
                    },
                    data: JSON.stringify(data),
                    crossDomain: true
                })
                .done(function (data, jqXHR, textStatus) {
                    console.log(data);
                    if(data.logged == false){ // if user does not have an account yet
                        window.localStorage.setItem('email',data.email);
                        window.localStorage.setItem('social_id',data.social_id);
                        window.localStorage.setItem('first_name',data.first_name);
                        window.localStorage.setItem('last_name',data.last_name);
                        window.localStorage.setItem('google_id',data.google_id);
                        uri = base_url + '/complete-registration';
                        window.location.assign(uri);
                    }else if(data.logged == true){
                        console.info("enter here");
                        login(data);
                    }                                    
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(errorThrown);
                });

            } else {
                console.log('User cancelled  login process or he is not fully authorized.');
            }      
        });
    }
    function login(infos){
        url = config.api_url + '/accounts/' + infos.account_id + '?section=settings';
        console.log(url);
        $.ajax({
            url: url,
            type: "GET",
            crossDomain: true,
            dataType: "json",
            headers: {
                "x-client-id": "0000",
                "x-access-token": infos.token
            }
        })
        .done(function(data, textStatus, jqXHR) {
            if (data.account.role == "ADMINISTRATOR") {
                console.log('failed');
                $('.loading_icon').addClass('fail');
                $('.loading_icon').removeClass('success');
                $('.loading_icon').removeClass('loading');
                showAlert('You do not have permission to login', false);
                return;
            } else {
                Cookies.set("account_id", infos.account_id, {expires: 30});
                Cookies.set("token", infos.token, {expires: 30});
                $('.loading_icon').removeClass('fail');
                $('.loading_icon').addClass('success');
                $('.loading_icon').removeClass('loading');
                showAlert('Successful authentication', true);
                console.log(data.account);
                window.localStorage.setItem('role', data.account.role);
                window.localStorage.setItem('company_id', data.account.company_id);
                uri = base_url + '/dashboard';
                window.location.assign(uri);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log('failed');
            $('.loading_icon').addClass('fail');
            $('.loading_icon').removeClass('success');
            $('.loading_icon').removeClass('loading');
            alertResponse(jqXHR, textStatus);
        });
    }
</script>
@stop

@stop 