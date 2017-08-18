<header>
  	<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-4">
			<a href="<?php echo URL::to('/'); ?>" id="logo">SmartSchool</a>
		</div>
		<div class="col-md-5 col-sm-6 hidden-xs">
			<div class="input-group" id="adv-search">
                <input type="text" class="form-control query" placeholder="{{__('What are you looking for ?')}}" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                    <label for="filter">{{__('Filter by')}} :</label>
                                    <select class="form-control">
										<option value="" selected></option>
                                        <option value="0" selected>{{__('Books')}}</option>
                                        <option value="1">{{__('Courses')}}</option>
                                    </select>
                                  </div>
								  <!--
                                  <div class="form-group">
                                    <label for="contain">Author</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Contains the words</label>
                                    <input class="form-control" type="text" />
                                  </div>  -->
                                </form>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-md-4 col-sm-3 col-xs-8">
			<div class="pull-right connect-register"><a href="<?php echo URL::to('/register'); ?>"><i class="fa fa-pencil-square-o"></i> {{__('Register')}}</a>&nbsp;&nbsp;<a href="<?php echo URL::to('/login'); ?>" class="button_top"><i class="fa fa-lock"></i> {{__('Log in')}}</a></div>            
			 
			@include('partials/language')			
			 
		</div>
	</div>
</div>
</header><!-- End header -->
<nav>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="mobnav-btn"></div>
			<ul class="sf-menu">
				<li class="normal_drop_down">
					<a href="<?php echo URL::to('/courses/catalog'); ?>">{{__('Courses')}}</a>
					<!--
					<div class="mobnav-subarrow"></div>
					<ul>
						<li><a href="index.html">Revolution version</a></li>
						<li><a href="index_2.html">Subscription version</a></li>
						<li><a href="index_3.html">With Ajax Search bar</a></li>
						<li><a href="index_4.html">With Video</a></li>
					</ul>
					-->
				</li>				
				<li><a href="<?php echo URL::to('/books/catalog'); ?>">{{__('Books')}}</a></li>
			</ul>
            
            <div class="col-md-3 pull-right hidden-sm hidden-xs">
                    <div id="sb-search" class="sb-search">
						<form>
							<input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
							<input class="sb-search-submit" type="submit" value="">
							<span class="sb-icon-search"></span>
						</form>
					</div>
              </div><!-- End search -->
              
		</div>
	</div><!-- End row -->
</div><!-- End container -->
</nav>