@extends('layouts.master')

@section('header-title')
    SmartSchool | Course Catalog
@stop
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">        
@stop
@section('content')
	
    <!-- START SITE -->
    <div id="wrapper">        
        @include('partials/header')

         <div class="page-title bgg">
            <div class="container clearfix">
                <div class="title-area pull-left">
                    <h2>You Searched for &nbsp; <span class='criteria'><i></i></span></h2>
                    <h4 class="number-items"></h4>
                </div><!-- /.pull-right -->
                <div class="pull-right hidden-xs">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo URL::to('/'); ?>">Home</a></li>
                            <li class="active">Search</li>
                        </ol>
                    </div><!-- end bread -->
                </div><!-- /.pull-right -->
            </div>
        </div><!-- end page-title -->

        <section class="section bgg">
            <div class="container">
                <div class="row">
                    <div id="post-content" class="col-md-9 col-sm-12">
                        <div class="row course-grid" id="catalog">
                            
                        </div><!-- end row -->
                        <!--
                        <nav class="clearfix text-center">
                            <ul class="pagination">
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                </a>
                                </li>
                            </ul>
                        </nav>
                        -->

                    </div>                    

                    <div id="sidebar" class="col-md-3 col-sm-12">
                        <div class="widget custom-widget clearfix course-pricing">
                            <div class="customwidget text-left w40">
                                <h4 class="widget-title">Filters</h4>								
								<hr>
								<h4>
									Subjects
								</h4>
								<div class="checkbox checkbox-warning">
									<input id="checkbox1" type="checkbox" class="styled">
									<label for="checkbox1">
										Mathematics
									</label>
								</div>

								<div class="checkbox checkbox-warning">
									<input id="checkbox2" type="checkbox" class="styled">
									<label for="checkbox2">
										Computer Science
									</label>
								</div>

								<div class="checkbox checkbox-warning">
									<input id="checkbox3" type="checkbox" class="styled">
									<label for="checkbox3">
										Physics
									</label>
								</div>
								<div class="checkbox checkbox-warning">
									<input id="checkbox4" type="checkbox" class="styled">
									<label for="checkbox4">
										Chemistry
									</label>
								</div>
								
								<hr>
								
								<h4>
									Languages
								</h4>
								<div class="checkbox checkbox-warning">
									<input id="checkbox1" type="checkbox" class="styled" checked>
									<label for="checkbox1">
										French
									</label>
								</div>

								<div class="checkbox checkbox-warning">
									<input id="checkbox2" type="checkbox" class="styled" checked>
									<label for="checkbox2">
										English
									</label>
								</div>
                            </div><!-- end newsletter -->
                        </div><!-- end widget -->
                       
                        <div class="widget clearfix">
                            <div class="big-title">
                                <h2 class="related-title">
                                    <span>Recent Courses</span>
                                </h2>
                            </div><!-- end big-title -->

                            <div class="postpager liststylepost">
                                <ul class="pager">
                                    <li>
                                        <div class="post">
                                            <a href="course-single.html">
                                                <img alt="" src="upload/pager_04.jpg" class="img-responsive alignleft">
                                                <h4>Learning Web Design & Development</h4>
                                                <small>View Course</small>
                                            </a>
                                        </div>  
                                    </li>
                                    <li>
                                        <div class="post">
                                            <a href="course-single.html">
                                                <img alt="" src="upload/pager_05.jpg" class="img-responsive alignleft">
                                                <h4>Graphic Design Introduction Course</h4>
                                                <small>View Course</small>
                                            </a>
                                        </div>  
                                    </li>
                                    <li>
                                        <div class="post">
                                            <a href="course-single.html">
                                                <img alt="" src="upload/pager_06.jpg" class="img-responsive alignleft">
                                                <h4>Social Media Marketing Strategy</h4>
                                                <small>View Course</small>
                                            </a>
                                        </div>  
                                    </li>
                                </ul>   
                            </div><!-- end postpager -->
                        </div><!-- end widget -->

                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        @include('partials/footer')
                
    </div><!-- end wrapper -->

    <div class="dmtop">Scroll to Top</div>
    <!-- END SITE -->
@stop    
    @section('scripts') 
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/plugins.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/search.js')}}"></script>
@stop
</body>
</html>