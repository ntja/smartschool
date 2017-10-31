<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">

<head>    
	<meta charset="utf-8">
    <title>@yield('header-title')</title>
     <!-- META SECTION -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">        
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">    
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta property="og:url"           content="http://www.smartskul.com">
    <meta property="og:type"          content="website">
    <meta property="og:title"         content="SmartSchool - Free Education for all">
    <meta property="og:description"   content="Free e-books and courses in various subjects such as Mathematics, Physical Sciences, Social Sciences, Computer Science, Engineering, Accounting, Finance, Economics, and more. ">
    <meta property="og:image"         content="{{asset('img/school-1.jpg')}}">
    <!-- END META SECTION -->
	@yield('meta')
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">
    
    <!-- CSS -->
	 <!-- BOOTSTRAP STYLES -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- TEMPLATE STYLES -->
    <link href="{{asset('css/superfish.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('fontello/css/fontello.css')}}" rel="stylesheet">
     <!-- color scheme css -->
    <link href="{{asset('css/color_scheme.css')}}" rel="stylesheet">    
	<!-- font awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->   	
	@yield('header-styles')
	
	@yield('header-scripts')
	 
    </head>

    <body data-base-url="<?php echo URL::to('/'); ?>" data-locale="<?php echo App::getLocale(); ?>">        
       
		@yield('content')  
		
		<!-- JQUERY -->
		<script src="{{asset('js/jquery-1.10.2.min.js')}}"></script>
		<!-- <script>jQuery.noConflict();</script> -->

		<!-- OTHER JS --> 
		<script src="{{asset('js/superfish.js')}}"></script>
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script src="{{asset('js/retina.min.js')}}"></script>
		<script src="{{asset('js/jquery.validate.js')}}"></script>
		<script src="{{asset('js/jquery.placeholder.js' )}}"></script>
		<script src="{{asset('js/functions.js')}}"></script>
		<script src="{{asset('js/classie.js')}}"></script>
		<script src="{{asset('js/custom/custom.js')}}"></script>
		<!--
		<script src="{{asset('js/uisearch.js')}}" type="text/javascript"></script>
		<script>new UISearch( document.getElementById( 'sb-search' ) );</script>
		-->
        @yield('scripts')    
    </body>
</html>