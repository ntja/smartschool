<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('header-title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('css/skins/_all-skins.min.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('stylesheets')
    </head>
    <body class="hold-transition skin-blue sidebar-mini" data-base-url="<?php echo URL::to('/'); ?>" data-locale="<?php echo App::getLocale(); ?>">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{url('dashboard')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>JD8</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Jobs D8</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->            
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">  
                                                                        <!--<i class="fa fa-smile-o"></i>-->								
                                    <span class="hidden-xs" id="logged_name">Administrator</span>
                                </a>
                                <ul class="dropdown-menu" style="width: auto">                                    
                                    <li class="user-footer">                                        
                                        <a href="#" class="btn btn-default btn-flat" id="admin_profile">Profile</a>
                                    </li>
                                    <li class="user-footer">
                                        <a href="#" class="btn btn-default btn-flat" id="deconnexion">Logout</a>
                                    </li>
                                </ul>
                            </li>              
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MENU</li>
                        <li class="" id="l1">
                            <a href="{{ url('dashboard')}}">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                            </a>              
                        </li>
                        <li class="treeview" id="l2">
                            <a href="{{url('users')}}">
                                <i class="fa fa-users"></i>
                                <span>All Users</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                        </li>
                        <li class="treeview" id="l3">
                            <a href="{{url('companies')}}">
                                <i class="fa fa-building"></i>
                                <span>Scouts</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                        </li>
                        <li class="treeview" id="l4">
                            <a href="{{url('jobs')}}">
                                <i class="fa fa-suitcase"></i>
                                <span>Jobs</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                        </li>
                        <li class="treeview" id="l5">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Settings</span>
                                <span class="label label-primary pull-right"></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li id="l6"><a href="{{url('settings/skills')}}"><i class="fa fa-archive"></i> Skills</a></li>
                                <li id="l7"><a href="{{url('settings/job-titles')}}"><i class="fa fa-asterisk"></i> Job titles</a></li>
                                <li id="l8"><a href="{{url('settings/institution-names')}}"><i class="fa fa-institution"></i> Institution names</a></li>
                                <li id="l9"><a href="{{url('settings/industry')}}"><i class="fa fa-industry"></i> Industries</a></li>
                                <li id="l10"><a href="{{url('settings/honors')}}"><i class="fa fa-briefcase"></i> Honors</a></li>
                                <li id="l11"><a href="{{url('settings/job-types')}}"><i class="fa fa-bookmark"></i> Job types</a></li>
                                <li id="l12"><a href="{{url('settings/education-majors')}}"><i class="fa  fa-plus-square"></i> Education majors</a></li>
                                <li id="l13"><a href="{{url('settings/course-names')}}"><i class="fa fa-book"></i> Course names</a></li>
                                <li id="l14"><a href="{{url('settings/education-degrees')}}"><i class="fa fa-graduation-cap"></i> Education degrees</a></li>
                                <!--<li id="l15"><a href="{{url('settings/company-names')}}"><i class="fa fa-building-o"></i> Company names</a></li>-->
                                <li id="l16"><a href="{{url('settings/course-fields')}}"><i class="fa fa-pencil-square"></i> Courses fields</a></li>
                                <li id="l17"><a href="{{url('settings/education-minors')}}"><i class="fa fa-minus-square"></i> Education minors</a></li>
                                <li id="l18"><a href="{{url('settings/certification-titles')}}"><i class="fa fa-certificate"></i> Certification titles</a></li>
                                <li id="l19"><a href="{{url('settings/languages')}}"><i class="fa fa-language"></i> Languages</a></li>
								<li id="l20"><a href="{{url('settings/current-status')}}"><i class="fa fa-signal"></i> Current status</a></li>
								<li id="l21"><a href="{{url('settings/licenses')}}"><i class="fa fa-mortar-board"></i> Licenses</a></li>
								<li id="l22"><a href="{{url('settings/security-clearances')}}"><i class="fa fa-shield"></i> Security Clearance</a></li>
                            </ul>
                        </li>
                        <li class="treeview" id="l20">
                            <a href="{{url('reset-password')}}">
                                <i class="fa fa-lock"></i>
                                <span>Reset Password</span>
                                <span class="label label-primary pull-right"></span>
                            </a>
                        </li>                 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!--Corps de la page-->
            @yield('content')
        </div>
        <!-- jQuery 2.1.4 -->   
        <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

        <!-- Bootstrap 3.3.5 -->
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

        @yield('script-footer')

    </body>
</html>