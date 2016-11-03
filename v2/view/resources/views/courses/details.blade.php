@extends('layouts.master')

@section('header-title')
SmartSchool :: Course details
@stop
    
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">        
@stop

@section('content')            
    <!-- START SITE -->
    <div id="wrapper">
     @include('partials.header')

        <section class="section bgw">
            <div class="container">
                <div class="row">
                    <div id="post-content" class="col-md-8 col-sm-12 single-course">                        
                        <div class="single-course-title text-center">
                            <h2 id="course-title"><a href="#" title=""></a></h2>                                                        
                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="hidden-xs">Share on Facebook</span></a></li>
                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="hidden-xs">Tweet on Twitter</span></a></li>
                                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"> Google</i></a></li>
                                </ul>
                            </div><!-- end post-sharing --> 
                        </div><!-- end single-course-title -->

                        <hr class="invis">

                        <div class="course-single-desc clearfix">
                            <div class="big-title">
                                <h2 class="related-title">
                                    <span>Course Description</span>
                                </h2>
                            </div><!-- end big-title -->

                            <div id="course-description">                            
                            </div>
                        </div><!-- end post-padding -->

                        <hr class="invis">

                        <div class="course-table clearfix">
                            <div class="big-title">
                                <h2 class="related-title">
                                    <span>Course Lessons</span>
                                </h2>
                            </div><!-- end big-title -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Lesson Title</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-play-circle"></i></td>
                                        <td><a href="#">Introduction</a></td>
                                        <td>12 Min</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-music"></i></td>
                                        <td>Lesson One - What is Photoshop</td>
                                        <td>20 Min</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-play-circle"></i></td>
                                        <td>Lesson Two - How to Use Tools</td>
                                        <td>41 Min</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-music"></i></td>
                                        <td>Lesson Three - Creating First Homepage</td>
                                        <td>15 Min</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-play-circle"></i></td>
                                        <td>Lesson Four - Understanding Colors</td>
                                        <td>29 Min</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-play-circle"></i></td>
                                        <td>Lesson Five - International Sizes</td>
                                        <td>31 Min</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-question-circle"></i></td>
                                        <td><a href="course-quiz.html">Quiz Time - Your First Quiz</a></td>
                                        <td>31 Min</td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="#" class="btn btn-primary btn-block btn-lg btn-square">Join the Course</a>

                        </div><!-- end course-table -->

                        <hr class="invis1">
                    </div><!-- end col -->

                    <div id="sidebar" class="col-md-4 col-sm-12">
                        <div class="post-media clearfix">
                            <img src="upload/small_course_08.jpg" alt="" class="img-responsive">
                        </div><!-- end post-media -->
                        <div class="widget custom-widget course-pricing clearfix">
                            <div class="customwidget text-left w40">    
                                <div class="course-meta clearfix">
                                    <p class="course-category">Category : <span id="category"></span></p>
                                    <hr>
                                    <div class="rating">
                                        <p>Reviews : &nbsp;
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div><!-- end rating -->
                                    <hr>
                                    <p class="course-time">Start Date : <span></span></p>
                                    <hr>
                                    <p class="course-instructors">Instructor : <a href="#" title=""><img src="upload/student_01.png" class="img-circle" alt=""><span id="instructor"></span></a></p>
                                    <hr>
                                    <form>                                    
                                    <input type="submit" value="Join Course" class="btn btn-primary btn-block" />
                                </form>
                                </div><!-- end meta -->
                            </div><!-- end newsletter -->
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

        <section class="section bgg">
            <div class="container">
                <div class="section-title-2 text-center">
                    <h2>RELATED COURSES</h2>
                    <p class="lead">You might also be interesting by the following courses. Don't miss out join us today!</p>
                    <hr>
                </div><!-- end section-title -->

                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 mob20">
                        <div class="shop-item course-v2">
                            <div class="post-media entry">
                                <img src="upload/small_course_03.jpg" alt="" class="img-responsive">
                                <div class="magnifier">
                                    <div class="shop-bottom clearfix">
                                        <a href="course-checkout.html" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                        <a href="course-single.html" title="Full Preview"><i class="fa fa-search"></i></a>
                                    </div><!-- end shop-bottom -->

                                    <div class="large-post-meta">
                                        <span class="avatar"><a href="member-profile.html"><img src="upload/avatar_02.png" alt="" class="img-circle"> Amanda DOE</a></span>
                                        <small>&#124;</small>
                                        <span><a href="course-single.html"><i class="fa fa-clock-o"></i> 2 Month</a></span>
                                        <small class="hidden-xs">&#124;</small>
                                        <span class="hidden-xs"><a href="course-single.html"><i class="fa fa-graduation-cap"></i> 12 Students</a></span>
                                    </div><!-- end meta -->
                                </div><!-- end magnifier -->
                            </div><!-- end post-media -->
                            <div class="shop-desc">
                                <div class="shop-price clearfix">
                                    <div class="pull-left">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div><!-- end rating -->
                                    </div><!-- end left -->
                                    <div class="pull-right">
                                        <small>$30.00</small>
                                    </div><!-- end right -->
                                </div>
                                <h3><a href="course-single.html" title="">How to use ten perinam keyboard with macboard</a></h3>
                            </div>
                        </div><!-- end shop-item -->
                    </div><!-- end carousel-item -->

                    <div class="col-md-4 col-sm-12 col-xs-12 mob20">
                        <div class="shop-item course-v2">
                            <div class="post-media entry">
                                <img src="upload/small_course_05.jpg" alt="" class="img-responsive">
                                <div class="magnifier">
                                    <div class="shop-bottom clearfix">
                                        <a href="course-checkout.html" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                        <a href="course-single.html" title="Full Preview"><i class="fa fa-search"></i></a>
                                    </div><!-- end shop-bottom -->

                                    <div class="large-post-meta">
                                        <span class="avatar"><a href="member-profile.html"><img src="upload/avatar_01.png" alt="" class="img-circle"> Jenny DOE</a></span>
                                        <small>&#124;</small>
                                        <span><a href="course-single.html"><i class="fa fa-clock-o"></i> 1 Month</a></span>
                                        <small class="hidden-xs">&#124;</small>
                                        <span class="hidden-xs"><a href="course-single.html"><i class="fa fa-graduation-cap"></i> 12 Students</a></span>
                                    </div><!-- end meta -->
                                </div><!-- end magnifier -->
                            </div><!-- end post-media -->
                            <div class="shop-desc">
                                <div class="shop-price clearfix">
                                    <div class="pull-left">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div><!-- end rating -->
                                    </div><!-- end left -->
                                    <div class="pull-right">
                                        <small>$40.00</small>
                                    </div><!-- end right -->
                                </div>
                                <h3><a href="course-single.html" title="">Getting Starting Business English - Ideal for Beginners</a></h3>
                            </div>
                        </div><!-- end shop-item -->
                    </div><!-- end carousel-item -->

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="shop-item course-v2">
                            <div class="post-media entry">
                                <img src="upload/small_course_06.jpg" alt="" class="img-responsive">
                                <div class="magnifier">
                                    <div class="shop-bottom clearfix">
                                        <a href="course-checkout.html" title="Add to Cart"><i class="fa fa-shopping-cart"></i></a>
                                        <a href="course-single.html" title="Full Preview"><i class="fa fa-search"></i></a>
                                    </div><!-- end shop-bottom -->

                                    <div class="large-post-meta">
                                        <span class="avatar"><a href="member-profile.html"><img src="upload/avatar_03.png" alt="" class="img-circle"> John DOE</a></span>
                                        <small>&#124;</small>
                                        <span><a href="course-single.html"><i class="fa fa-clock-o"></i> 1 Month</a></span>
                                        <small class="hidden-xs">&#124;</small>
                                        <span class="hidden-xs"><a href="course-single.html"><i class="fa fa-graduation-cap"></i> 44 Students</a></span>
                                    </div><!-- end meta -->
                                </div><!-- end magnifier -->
                            </div><!-- end post-media -->
                            <div class="shop-desc">
                                <div class="shop-price clearfix">
                                    <div class="pull-left">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div><!-- end rating -->
                                    </div><!-- end left -->
                                    <div class="pull-right">
                                        <small>$190.00</small>
                                    </div><!-- end right -->
                                </div>
                                <h3><a href="course-single.html" title="">Working on Github with an awesome team partical</a></h3>
                            </div>
                        </div><!-- end shop-item -->
                    </div><!-- end carousel-item -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->        

        @include('partials/footer')
                
    </div><!-- end wrapper -->

    <div class="dmtop">Scroll to Top</div>
    <!-- END SITE -->

@stop   

@section('scripts')
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/actions.js')}}"></script>
<script src="{{asset('js/courses/details.js')}}"></script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('/plugins/purl/purl.js')}}"></script>
@stop