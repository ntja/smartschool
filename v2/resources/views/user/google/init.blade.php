<html>
<head>

<style>
	.box {font-family: Arial, sans-serif;background-color: #F1F1F1;border:0;width:340px;webkit-box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.3);margin: 0 auto 25px;text-align:center;padding:10px 0px;}
	.box img{padding: 10px 0px;}
	.box a{color: #427fed;cursor: pointer;text-decoration: none;}
	.heading {text-align:center;padding:10px;font-family: 'Open Sans', arial;color: #555;font-size: 18px;font-weight: 400;}
	.circle-image{width:100px;height:100px;-webkit-border-radius: 50%;border-radius: 50%;}
	.welcome{font-size: 16px;font-weight: bold;text-align: center;margin: 10px 0 0;min-height: 1em;}
	.oauthemail{font-size: 14px;}
	.logout{font-size: 13px;text-align: right;padding: 5px;margin: 20px 5px 0px 5px;border-top: #CCCCCC 1px solid;}
	.logout a{color:#8E009C;}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<div class="heading">PHP Google OAuth 2.0 Login</div>
<div class="box">
  <div>
	<!-- Show Login if the OAuth Request URL is set -->
	
<?php

 $client_id = '97971554904-3lka1s79p07sfejscen89e3n0jdm89oq.apps.googleusercontent.com';
 $redirect_uri = 'http://sw.ai/staging/squirrel/view/public/register';
$scope = "https://www.googleapis.com/auth/plus.profile.emails.read+https://www.googleapis.com/auth/plus.login+https://www.googleapis.com/auth/plus.me"; //google scope to access
$state = "profile"; //optional
$access_type = "offline"; //optional - allows for retrieval of refresh_token for offline access
$loginUrl = sprintf("https://accounts.google.com/o/oauth2/auth?scope=%s&state=%s&redirect_uri=%s&response_type=code&client_id=%s&access_type=%s", $scope, $state, $redirect_uri, $client_id, $access_type);


if(isset($_REQUEST['code'])){
	$network_code = $_REQUEST['code'];
}else{
	$network_code='';
}
?>
   
	  <img src="images/user.png" width="100px" size="100px" /><br/>
      <a class='login' href='<?php echo $loginUrl ?>'> Login with Google account using OAuth 2.0<img class='login' src="images/sign-in-with-google.png" width="250px" size="54px" /></a>
	<!-- Show User Profile otherwise-->
	
	
	
   
  </div>
</div>
<script>
     window.onload = function() {
         var network_code="<?php echo $network_code; ?>";
		 console.log(network_code);
		 if(network_code){
			 authenticate(network_code);
		 }
         
     };
	 	 
	 function authenticate(network_code) {
            var token;
            token=network_code;		
            $(document).ready(function(){

                    if (token) {



                            var url = "http://sw.ai/staging/squirrel/public/accounts/social-login";
                            var data = {"network":"google", "network_token":token, "role":"EMPLOYER"};
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
									console.log(data.token);


							})
							.fail(function (jqXHR, textStatus, errorThrown) {
									console.log(jqXHR);
									console.log(errorThrown);
							});

                    } else {
                            console.log('User canceled  login process or he is not fully authorized.');
                    }					
            });
    }	 	
</script>
</BODY>
</HTML>
</HTML>


