
		<!DOCTYPE html>
		<html class="no-js" lang="fr">
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
				<title> Connexion - Inscription
				  </title>
		</head>			 
	<body>						
		<script>
		  $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
		  console.log('init');
		  FB.init({
		  appId: 350810385043147,
		  version: 'v2.6' 
		 });
			
		});
		</script>
		
			
		 <div class="heading">PHP Facebook OAuth 2.0 Login</div>
		<div class="box">
		<div>
		 
		   <img src="images/user.png" width="100px" size="100px" /><br/>
					<button id='facebook_login'> Login with Facebook account using OAuth 2.0</button>
			<!-- Show User Profile otherwise-->					
			  </div>
			</div>
			  <script>				
				$(document).ready(function(){				  		   
					$('#facebook_login').click(function () {
					  console.log('test');
						facebook_login();						
					});

			  function facebook_login() {
				try {
					
					FB.login(function (response) {
						var token;
						console.log(response);
						if (response.authResponse) {
							token = response.authResponse.accessToken;
							console.log(token);
							
							var url = "http://sw.ai/staging/squirrel/public/accounts/social-login";
							var data = {"network":"facebook", "network_token":token};
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
							console.log('User canceled login or he is not fully authorized.');
						}
					}, {
						scope: 'email',
						return_scopes: true
					});
					
					
				} catch (error) {
					console.log(error);
				}
			}

		});
							
	</script>
	 </body>			
</html>
