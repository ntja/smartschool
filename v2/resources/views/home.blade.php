@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Courses, Education')}}
@stop

@section('content')

@include('partials/header')

<section id="sub-header" >
  	<div class="container">
    	<div class="row">
        	<div class="col-md-6" id="subscribe">
            	<h1> {{__('LEARN EVERYTHING FROM ANYWHERE') }}</h1>
                <h2 class="hidden-xs">{{__('For free. For everyone. Forever') }}</h2>
            </div>
            <div class="col-md-6 ">
            <div id="subscribe_home">
           <div id="message-contact-home"></div>
			<form method="post" action="assets/contact_home.php" id="contactform_home">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="first_name" name="first_name" placeholder="{{__('First Name')}}" required>
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="last_name" name="last_name" placeholder="{{__('Last Name')}}" required>
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						<div class="form-group">
							<input type="email" id="email" name="email" class="form-control style_2" placeholder="{{__('Email')}}" required>
                            <span class="input-icon"><i class="icon-email"></i></span>
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="password" id="password" name="password" class="form-control style_2" placeholder="{{__('Password')}}">
                            <span class="input-icon"><i class="icon-lock"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="password" id="password_confirmation" name="password_confirmation" class="form-control style_2" placeholder="{{__('Re-type your password')}}" required>
                            <span class="input-icon"><i class="icon-lock"></i></span>
						</div>
					</div>
				</div>                
                <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" id="verify_contact_home" class=" form-control" placeholder="{{__('Are you human ?')}} 3 + 1 =" required>
						</div>
				</div>
				 {{ csrf_field() }}
                <div class="col-md-6">
					<div class="form-group pull-right">
						<input type="submit" value="{{__('Register')}}" class=" button_subscribe" id="submit-contact-home"/>
					</div>
				</div>
                </div>
                </form>
            </div>
            </div>
        </div><!-- End row -->
    </div>
  </section><!-- End sub-header -->

    
    <section id="main-features">
    <div class="divider_top_black"></div>
    <div class="container">
        <div class="row">
            <div class=" col-md-10 col-md-offset-1 text-center">
                <h2>{{__('Why Join SmartSchool') }}</h2>
                <p class="lead">
                    {{__('We provide awesome courses & hundreds of free books! Don\'t miss out join us today!') }}
                </p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-user"></i>
                    <a href="#"><h3>{{__('Expert teachers')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-comments"></i>
                   <a href="#"> <h3>{{__('Questions & Answers')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-book"></i>
                    <a href="#"><h3>{{__('Thousands of Books')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-graduation-cap"></i>
                    <a href="#"><h3>{{__('Unlimited Free Courses')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
			<div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-laptop "></i>
                    <a href="#"><h3>{{__('Online Tutoring')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
			<div class="col-md-6">
                <div class="feature">
                    <i class="fa fa-briefcase"></i>
                    <a href="#"><h3>{{__('Professional Training')}}</h3></a>
                    <p>
                        Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                    </p>
                </div>
            </div>
            </div><!-- End row -->
            </div><!-- End container -->
    </section><!-- End main-features -->
    
    <section id="main_content_gray">
    	<div class="container">
        	<div class="row">
            <div class="col-md-12 text-center">
                <h2>{{__('Latest Courses')}}</h2>
                <p class="lead">Lorem ipsum dolor sit amet, ius minim gubergren ad.</p>
            </div>
        </div><!-- End row -->
        
        <div class="row">
        
        			<div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="col-item">
                            <span class="ribbon_course"></span>
                                <div class="photo">
                                    <a href="#"><img src="img/poetry.jpg" alt="" /></a>
                                    <div class="cat_row"><a href="#">LITERATURE</a><span class="pull-right"><i class=" icon-clock"></i>6 Days</span></div>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="course_info col-md-12 col-sm-12">
                                            <h4>Poetry course</h4>
                                            <p > Lorem ipsum dolor sit amet, no sit sonet corpora indoctum, quo ad fierent insolens. Duo aeterno ancillae ei. </p>
                                            <div class="rating">
                                            <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="separator clearfix">
                                        <p class="btn-add"> <a href="apply.html"><i class="icon-export-4"></i> Subscribe</a></p>
                                        <p class="btn-details"> <a href="course_detail.html"><i class=" icon-list"></i> Details</a></p>
                                    </div>
                                </div>
                           </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#"><img src="img/business.jpg" alt="" /></a>
                                    <div class="cat_row"><a href="#">MANAGEMENT</a><span class="pull-right"><i class=" icon-clock"></i>6 Days</span></div>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="course_info col-md-12 col-sm-12">
                                            <h4>Build a Business Plan</h4>
                                            <p > Lorem ipsum dolor sit amet, no sit sonet corpora indoctum, quo ad fierent insolens. Duo aeterno ancillae ei. </p>
                                            <div class="rating">
                                            <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="separator clearfix">
                                        <p class="btn-add"> <a href="apply.html"><i class="icon-export-4"></i> Subscribe</a></p>
                                        <p class="btn-details"> <a href="course_detail.html"><i class=" icon-list"></i> Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#"><img src="img/art.jpg" alt="" /></a>
                                    <div class="cat_row"><a href="#">ART</a><span class="pull-right"><i class=" icon-clock"></i>6 Days</span></div>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="course_info col-md-12 col-sm-12">
                                            <h4>Impressionist</h4>
                                            <p > Lorem ipsum dolor sit amet, no sit sonet corpora indoctum, quo ad fierent insolens. Duo aeterno ancillae ei. </p>
                                            <div class="rating">
                                            <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="separator clearfix">
                                        <p class="btn-add"> <a href="apply.html"><i class="icon-export-4"></i> Subscribe</a></p>
                                        <p class="btn-details"> <a href="course_detail.html"><i class=" icon-list"></i> Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="#"><img src="img/math.jpg" alt="" /></a>
                                    <div class="cat_row"><a href="#">MATH</a><span class="pull-right"><i class=" icon-clock"></i>6 Days</span></div>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="course_info col-md-12 col-sm-12">
                                            <h4>12 Principles</h4>
                                            <p > Lorem ipsum dolor sit amet, no sit sonet corpora indoctum, quo ad fierent insolens. Duo aeterno ancillae ei. </p>
                                            <div class="rating">
                                            <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i><i class=" icon-star-empty"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="separator clearfix">
                                        <p class="btn-add"> <a href="apply.html"><i class="icon-export-4"></i> Subscribe</a></p>
                                        <p class="btn-details"> <a href="course_detail.html"><i class=" icon-list"></i> Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
   
        </div><!-- End row -->
        <div class="row">
        	<div class="col-md-12">
        	     <a href="#" class="button_medium_outline pull-right">{{__('View All Courses')}}</a>
            </div>
        </div>
         </div>   <!-- End container -->
        </section><!-- End section gray -->                
        
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

@stop 
