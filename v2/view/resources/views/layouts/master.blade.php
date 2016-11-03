<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>    
        <title>@yield('header-title')</title>        
        <!-- META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="">    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- END META SECTION -->
		@yield('meta')
        <!-- FAVICONS -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
    
    <!-- BOOTSTRAP STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <!-- TEMPLATE STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('styles/custom.css')}}">
    <!-- CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">    
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->        
        
         @yield('header-styles')

    </head>

    <body data-base-url="<?php echo URL::to('/'); ?>">        
        <!-- PRELOADER -->
        <div id="loader">
            <div class="loader-container">
                <img src="{{asset('images/load.gif')}}" alt="" class="loader-site spinner">
            </div>
        </div>
    <!-- END PRELOADER -->
		@yield('content')                        
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('plugins/js-cookie/js.cookie.js')}}"></script>
        <script src="{{asset('js/main-config.js')}}"></script>
        @yield('scripts')    
    </body>
</html>