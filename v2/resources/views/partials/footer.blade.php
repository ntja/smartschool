<footer>
<hr>
<div class="container" id="nav-footer">
	<div class="row text-left">
		<div class="col-md-3 col-sm-3">
			<h4>{{__('Browse')}}</h4>
			<ul>
				<li><a href="<?php echo URL::to('/subscription-plans'); ?>">{{__('Subscription Plans')}}</a></li>
				<li><a href="<?php echo URL::to('/courses/catalog'); ?>">{{__('Courses Catalog')}}</a></li>				
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>{{__('Top Categories')}}</h4>
			<ul>
				
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>{{__('About SmartSchool')}}</h4>
			<ul>
				<li><a href="#">{{__('Become an Instructor')}}</a></li>
				<li><a href="#">{{__('About Us')}}</a></li>
				<li><a href="#">{{__('Contact Us')}}</a></li>
				<li><a href="#">{{__('Terms and conditions')}}</a></li>
				<li><a href="<?php echo URL::to('/register'); ?>">{{__('Sign Up')}}</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
                    <ul id="follow_us">
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class=" icon-google"></i></a></li>
                    </ul>
                    <ul>
						<li><strong class="phone">+971 509 879 819</strong><br><small>{{__('Mon - Fri')}} / 8.00AM - 06.00PM</small></li>
                        <li><strong class="phone">+237 655 134 682</strong><br><small>{{__('Mon - Fri')}} / 8.00AM - 06.00PM</small></li>
                        <li>{{__('Questions')}} ? <a href="#">info@smartskul.com</a></li>				
                    </ul>
		</div><!-- End col-md-4 -->
	</div><!-- End row -->
</div>
<div id="copy_right">© <?php echo date("Y"); ?>  SmartSchool. {{__('All rights reserved')}}.</div>
</footer>

<div id="toTop">{{__('Back to top')}}</div>
