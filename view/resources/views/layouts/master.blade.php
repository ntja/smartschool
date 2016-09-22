<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <title>@yield('header-title')</title>        
        <!-- META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                    
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->               
        <link rel="stylesheet" type="text/css" id="theme" href="">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{{asset('css/theme-default.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
         @yield('header-styles')
        <!-- EOF CSS INCLUDE -->      
    </head>

    <body data-base-url="<?php echo URL::to('/'); ?>">        
        @yield('content')                        
        <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('plugins/js-cookie/js.cookie.js')}}"></script>
        <script src="{{asset('js/main-config.js')}}"></script>

        @yield('scripts')    
    </body>
</html>