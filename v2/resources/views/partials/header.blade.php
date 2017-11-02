<header>
  	<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-4">
			<a href="<?php echo URL::to('/'); ?>" id="logo">SmartSchool</a>
		</div>
		<div class="col-md-5 col-sm-6 hidden-xs">
			<div class="input-group" id="adv-search">
                <input type="text" class="form-control query" id="query_input" placeholder="{{__('What are you looking for ?')}}" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                    <label for="filter">{{__('Filter by')}} :</label>
                                    <select class="form-control" id="search_filter">
										<option value="0" selected></option>
                                        <option value="1" >{{__('Books')}}</option>
                                        <option value="2">{{__('Courses')}}</option>
                                    </select>
                                  </div>								  
                                </form>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-md-4 col-sm-3 col-xs-8">			
			<!-- @include('partials/language') -->
			<div id="google_translate_element">
			</div>
			<script type="text/javascript">
				function googleTranslateElementInit() {
				  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,es,fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
				}
				</script>
			<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>					
		</div>
		<div class="col-md-4 col-sm-3 col-xs-8">
			<div class="pull-right connect-register"><a href="<?php echo URL::to('/register'); ?>"><i class="fa fa-pencil-square-o"></i> {{__('Sign Up')}}</a>&nbsp;&nbsp;<a href="<?php echo URL::to('/login'); ?>" class="button_top"><i class="fa fa-lock"></i> {{__('Log in')}}</a></div>			
		</div>
	</div>		
</div>
</header><!-- End header -->
<nav style="padding-top:10px">
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
				<!-- <li><a href="<?php echo URL::to('/ocw/courses'); ?>">{{__('OCW Courses')}}</a></li> -->
				<!-- <li><a href="<?php echo URL::to('/questions'); ?>">{{__('Questions')}}</a></li> -->
			</ul>                       
		</div>
	</div><!-- End row -->
</div><!-- End container -->
</nav>