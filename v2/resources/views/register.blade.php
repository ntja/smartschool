<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">

<head>
  	<meta charset="utf-8">
    <title>SmartSchool - Courses, Education</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
    
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/superfish.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="fontello/css/fontello.css" rel="stylesheet">
     <!-- color scheme css -->
    <link href="css/color_scheme.css" rel="stylesheet">
    <!-- custom css -->
    <link href="css/custom.css" rel="stylesheet">
	<!-- font awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

  </head>
  
  <body data-base-url="<?php echo URL::to('/'); ?>">
    <header>
  	<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-4">
			<a href="<?php echo URL::to('/'); ?>" id="logo">SmartSchool</a>
		</div>
		<div class="col-md-5 col-sm-6 hidden-xs">
			<div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="{{__('What are you looking for ?')}}" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                    <label for="filter">{{__('Filter by')}}</label>
                                    <select class="form-control">
										<option value="" selected></option>
                                        <option value="0" selected>{{__('Books')}}</option>
                                        <option value="1">{{__('Courses')}}</option>
                                    </select>
                                  </div>
								  <!--
                                  <div class="form-group">
                                    <label for="contain">Author</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Contains the words</label>
                                    <input class="form-control" type="text" />
                                  </div>  -->
                                </form>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-md-4 col-sm-3 col-xs-8">
			<div class="pull-right"><a href="<?php echo URL::to('/register'); ?>"><i class="fa fa-pencil-square-o"></i> {{__('Register')}}</a>&nbsp;&nbsp;<a href="<?php echo URL::to('/login'); ?>" class="button_top"><i class="fa fa-lock"></i> {{__('Log in')}}</a></div>            
			<ul id="top_nav" class="hidden-xs">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						{{ Config::get('languages')[App::getLocale()] }}
					</a>
					<ul class="dropdown-menu">
						@foreach (Config::get('languages') as $lang => $language)
							@if ($lang != App::getLocale())
								<li>
									<a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
								</li>
							@endif
						@endforeach
					</ul>
				</li>
            </ul>			
		</div>
	</div>
</div>
</header><!-- End header -->

<section id="login_bg">
<div  class="container">
<div class="row">
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
		<div id="login">
			<p class="text-center">
				<img src="img/logo-smartschool.png" alt="">
			</p>
			<hr>
			<form>
				<div class="form-group">
					<input type="text" class="form-control required" name="first_name" id="first_name" placeholder="{{__('First Name')}}">
					<span class="input-icon"><i class="icon-user"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required"  name="last_name" id="last_name"  placeholder="{{__('Last Name')}}">
					<span class="input-icon"><i class="icon-user"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required" name="email"  placeholder="{{__('Email')}}">
					<span class="input-icon"><i class="icon-email"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required" name="password" id="password" placeholder="{{__('Password')}}">
					<span class="input-icon"><i class="icon-lock"></i></span>
				</div>
				<div class="form-group">
					<input type="text" class="form-control required" name="confirm_password" id="confirm_password" placeholder="{{__('Re-type your password')}}">
					<span class="input-icon"><i class="icon-lock"></i></span>
				</div>
                <div id="pass-info" class="clearfix"></div>
				<button class="button_fullwidth">Create an account</button>
			</form>
		</div>
	</div>
</div>
</div>
</section><!-- End register -->

<footer>
<hr>
<div class="container" id="nav-footer">
	<div class="row text-left">
		<div class="col-md-3 col-sm-3">
			<h4>{{__('Browse')}}</h4>
			<ul>
				<li><a href="prices_plans.html">Prices</a></li>
				<li><a href="courses_grid.html">Courses</a></li>
				<li><a href="blog.html">Blog</a></li>
				<li><a href="contacts.html">Contacts</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>{{__('Top Categories')}}</h4>
			<ul>
				<li><a href="course_details_1.html">Biology</a></li>
				<li><a href="course_details_2.html">Management</a></li>
				<li><a href="course_details_2.html">History</a></li>
				<li><a href="course_details_3.html">Litterature</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>{{__('About SmartSchool')}}</h4>
			<ul>
				<li><a href="about_us.html">About Us</a></li>
				<li><a href="apply_2.html">Join Courses</a></li>
				<li><a href="#">Terms and conditions</a></li>
				<li><a href="register.html">Register</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<ul id="follow_us">
				<li><a href="#"><i class="icon-facebook"></i></a></li>
				<li><a href="#"><i class="icon-twitter"></i></a></li>
				<li><a href="#"><i class=" icon-google"></i></a></li>
			</ul>
			<ul>
				<li><strong class="phone">+00237 655101101</strong><br><small>Mon - Fri / 9.00AM - 06.00PM</small></li>
				<li>Questions ? <a href="#">questions@smartskul.com</a></li>
			</ul>
		</div><!-- End col-md-4 -->
	</div><!-- End row -->
</div>
<div id="copy_right">© <?php echo date("Y"); ?></div>
</footer>

<div id="toTop">{{__('Back to top')}}</div>

<!-- JQUERY -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- OTHER JS --> 
<script src="js/superfish.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/pw_strenght.js"></script>
<script src="assets/validate.js"></script>
<script src="js/jquery.placeholder.js"></script>
<script src="js/functions.js"></script>
<script src="js/classie.js"></script>
<script src="js/uisearch.js"></script>
<script>new UISearch( document.getElementById( 'sb-search' ) );</script>

  </body>
</html>