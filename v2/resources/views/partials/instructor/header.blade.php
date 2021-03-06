<header>
  	<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-3">
			<a href="<?php echo URL::to('/'); ?>" id="logo">SmartSchool</a>
		</div>
		<div class="col-md-4 col-md-offset-5 col-sm-offset-0 col-xs-offset-0 col-sm-9 col-xs-9">	
			<div class="col-md-2 col-sm-2 col-xs-2">
				
				@include('../partials/language')			
				
			</div>
			
			<div class="col-md-10 col-sm-10 col-xs-10">
			<ul class="user_panel user">
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__('Welcome')}}, <strong id="user_name">{{__('User Name')}}</strong> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo URL::to('/instructor/courses'); ?>"><i class="icon-user"></i> {{__('List of My Courses')}} </a></li>
						<li><a href="<?php echo URL::to('/instructor/my-students'); ?>"><i class="icon-users"></i> {{__('My Students')}}</a></li>
						<li><a href="#"><i class=" icon-download"></i> {{__('Recent Discussions')}}</a></li>
						<li><a href="#"><i class=" icon-download"></i> {{__('My Invitations')}}</a></li>
						<li><a href="#"><i class=" icon-download"></i> {{__('MCQs & Assignments')}}</a></li>
						<li><a href="<?php echo URL::to('/instructor/profile');?>"><i class="icon-cog"></i> {{__('Profile')}}</a></li>
						<li class="divider"></li>
						<li class="logout"><a href="#"><i class="icon-off"></i> {{__('Logout')}}</a></li>
					</ul>
				</li>
			</ul>
			</div>					           
		</div>
	</div>
</div>
</header><!-- End header -->