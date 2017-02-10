<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- SITE META -->
    <title>SmartSchool | Learning Management System</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- FAVICONS -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

    
    <!-- BOOTSTRAP STYLES -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- TEMPLATE STYLES -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="css/custom.css">

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body data-base-url="<?php echo URL::to('/'); ?>">

	<!-- PRELOADER -->
        <div id="loader">
			<div class="loader-container">
				<img src="images/load.gif" alt="" class="loader-site spinner">
			</div>
		</div>
	<!-- END PRELOADER -->

    <!-- START SITE -->
    <div id="wrapper">        
        @include('partials/header')

        <section class="section bgd btop">
            <div class="row-">
                <div class="col-md-6 myimg">                    
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6">
                            <div class="about-module">
                                <h3>LEARN ANYTHING FROM ANYWHERE</h3>
                                <h4>For free. for everyone. For ever</h4>
                                <div class="drop-caps">
                                    <p>Education is the most powerful weapon that can be used to change our world. To help students to receive proper education and ensure them success at the end of their study,  SmartSchool offers the best courses from top universities and support learners during all their program.</p>
                                </div>
                                <div class="drop-caps">
                                    <p>SmartSchool helps learners to take advantage of today’s technologies that give them the chance to create a distinct curriculum for themselves, take best courses from Universities of their choice from their house and become part of the e-learning revolution                                
                                    </p>
                                </div>
                                </div>                                
                                <a href="<?php echo URL::to('/login'); ?>" class="btn btn-primary btn-square">START LEARNING NOW</a>
                            </div><!-- end about-module -->
                        </div>
                    </div><!--end of row-->
                </div><!-- end container -->
            </div><!-- end row fluid -->
        </section>

        <section class="section bgg">
            <div class="container">
                <div class="text-center hidden-xs hidden-sm">
                    <img class="img-responsive wow fadeInUp" src="upload/device_03.png" alt="" style="visibility: visible; animation-name: fadeInUp;">
                </div>
                <div class="section-title-2 text-center">
                    <h2>Why Choose SmartSchool</h2>
                    <p class="lead">We provide awesome courses & hundreds of free books! Don't miss out join us today!</p>
                    <hr>
                </div><!-- end section-title -->
            </div>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4 col-sm-12 col-xs-12 mob20">
                        <div class="boxes text-center service-first noafter nobgwithicon">
                            <i class="fa fa-graduation-cap fa-3x"></i>
                            <h3>Unlimited Free Courses</h3>
                            <p>Professional responsive and retina ready template for online learning websites!</p>
                            <a href="<?php echo URL::to('/courses'); ?>" class="btn btn-primary btn-trans btn-radius">View all Courses	</a>
                        </div><!-- end box -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-12 col-xs-12 mob20">
                        <div class="boxes text-center service-first noafter nobgwithicon">
                            <i class="fa fa-user fa-3x"></i>
                            <h3>Awesome Instructors</h3>
                            <p>Professional responsive and retina ready template for online learning websites!</p>
                            <a href="#" class="btn btn-primary btn-trans btn-radius">Explore</a>
                        </div><!-- end box -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-12 col-xs-12 mob20">
                        <div class="boxes text-center service-first noafter nobgwithicon">
                            <i class="fa fa-book fa-3x"></i>
                            <h3>Thousands of Books</h3>
                            <p>Professional responsive and retina ready template for online learning websites!</p>
                            <a href="#" class="btn btn-primary btn-trans btn-radius">Go to Library</a>
                        </div><!-- end box -->
                    </div><!-- end col -->                    
                </div><!-- end row -->                
            </div><!-- end container -->                     
        </section><!-- end section -->        

         <section class="section bgg">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4 col-sm-12 mob20">
                        <div class="boxes text-center service-first noafter nobgwithicon">
                            <i class="fa fa-laptop fa-3x"></i>
                            <h3>Online Tutoring</h3>
                            <p>Professional responsive and retina ready template for online learning websites!</p>
                            <a href="#" class="btn btn-primary btn-trans btn-radius">Find a Coach</a>
                        </div><!-- end box -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-12 mob20">
                        <div class="boxes text-center service-first noafter nobgwithicon">
                            <i class="fa fa-briefcase fa-3x"></i>
                            <h3>Professional Training</h3>
                            <p>Professional responsive and retina ready template for online learning websites!</p>
                            <a href="#" class="btn btn-primary btn-trans btn-radius">Take a Program</a>
                        </div><!-- end box -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-12">
                        <div class="boxes text-center service-first noafter nobgwithicon">
                            <i class="fa fa-university fa-3x"></i>
                            <h3>University Courses</h3>
                            <p>Professional responsive and retina ready template for online learning websites!</p>
                            <a href="#" class="btn btn-primary btn-trans btn-radius">Go to Video Lectures</a>
                        </div><!-- end box -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

        @include('partials/footer')

    </div><!-- end wrapper -->

    <div class="dmtop">Scroll to Top</div>
    <!-- END SITE -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins.js"></script>
	<script src="{{asset('js/custom.js')}}"></script>
	
    <!-- REVOLUTION JS FILES 
    <script type="text/javascript" src="revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="revolution/js/jquery.themepunch.revolution.min.js"></script>
    -->

</body>
</html>