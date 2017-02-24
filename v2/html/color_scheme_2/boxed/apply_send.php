<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">

<head>

<!-- Basic Page Needs -->
<meta charset="utf-8">
<title>LEARN - Courses, Education site template</title>
<meta name="description" content="">
<meta name="author" content="Ansonika">

<!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">

<!-- CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">


	<!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


<!--[if IE 7]>
  <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript">
function delayedRedirect(){
    window.location = "index.html"
}
</script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 5000)">
<?php
						$mail = $_POST['email'];

						/*$subject = "".$_POST['subject'];*/
						$to = "test@ansonika.com"; 			/* YOUR EMAIL HERE */
						$subject = "Subscription from LEARN";
						$headers = "From: Subscription from LEARN <noreply@yourdomain.com>";
						$message = "USER INFO\n";
						$message .= "\nName: " . $_POST['firstname'];
						$message .= "\nLast Name: " . $_POST['lastname'];
						$message .= "\nEmail: " . $_POST['email'];
						$message .= "\nTelephone: " . $_POST['phone2'];
						$message .= "\nCountry: " . $_POST['country'];
						$message .= "\nAge: " . $_POST['age'];
						$message .= "\nGender: " . $_POST['gender'];
						$message .= "\nTerms and conditions accepted: " . $_POST['terms'] . "\n";
						$message .= "\nPreferences?\n" ;  /*  CHECKBOXES */
						foreach($_POST['course_1'] as $value) 
							{ 
							$message .=   "- " .  trim(stripslashes($value)) . "\n"; 
							};
						$message .= "\nOptional message: " . $_POST['message_apply_1'];
						//Receive Variable
						$sentOk = mail($to,$subject,$message,$headers);
						
						$user = "$mail";
						$usersubject = "Thank You";
						$userheaders = "From: info@learn.com\n";
						$usermessage = "Thank you for contact LEARN. We will reply shortly with more details.";
						mail($user,$usersubject,$usermessage,$userheaders);
	
?>

<!-- END SEND MAIL SCRIPT -->   
<div class="container">
<div class="row">
        <div class="col-md-12" style="text-align:center; padding-top:80px;">
         	<h1 style="color:#333">Thank you!</h1>
          <h3 style="color: #6C3">Form Successfully Submitted.</h3>
         <p>You will be redirect back in 5 seconds.</p>
        </div>
</div>
</div>
</body>
</html>