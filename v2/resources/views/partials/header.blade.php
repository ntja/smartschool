<header>
  	<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-4">
			<a href="<?php echo URL::to('/'); ?>" id="logo">SmartSchool</a>
		</div>
		<div class="col-md-5 col-sm-6 hidden-xs">
			<div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="{{__('What are you looking for ?')}}" />
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
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-md-4 col-sm-3 col-xs-8">
			<div class="pull-right"><a href="<?php echo URL::to('/register'); ?>"><i class="fa fa-pencil-square-o"></i> {{__('Register')}}</a>&nbsp;&nbsp;<a href="<?php echo URL::to('/login'); ?>" class="button_top"><i class="fa fa-lock"></i> {{__('Log in')}}</a></div>            
			 
			@include('partials/language')			
			 
		</div>
	</div>
</div>
</header><!-- End header -->