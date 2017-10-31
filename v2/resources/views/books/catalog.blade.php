@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Books Catalog')}}
@stop
@section('header-styles')
	<meta property="og:url"           content="http://www.smartskul.com/v2/books">
    <meta property="og:type"          content="website">
    <meta property="og:title"         content="SmartSchool">
    <meta property="og:description"   content="Free e-books in various subjects such as Mathematics, Physical Sciences, Social Sciences, Computer Science, Engineering, Accounting, Finance, Economics, and more. ">
    <meta property="og:image"         content="{{asset('img/school-1.jpg')}}">

   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('css/jquery.fancybox.min.css')}}" rel="stylesheet">	
@stop
@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10&appId=1322688107743985';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@include('partials/header')

    <section id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1>{{__('Books Catalog')}}</h1>      
                <p class="lead">
                   {{__('Explore new interests and career opportunities with books in Mathematics, Computer Science, Chemistry, Accounting, Law and more...')}}
                </p>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
    <div class="divider_top"></div>
    </section><!-- End sub-header -->
    
    
    <section id="main_content">
    	<div class="container-fluid">        
			<ol class="breadcrumb">
			  <li><a disabled href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
			  <li class="active">{{__('Books Catalog')}}</li>
			</ol>
			
			<div class="row">
			
			<aside class="col-lg-3 col-md-4 col-sm-3">
				<div class="box_style_1">
					<h4>{{__('Subjects')}}</h4>
					<ul class="submenu-col subject">										
						<li><a class="all_books" href="#" id="active">{{__('All Books')}}</a></li>
					</ul>
				</div>
			</aside>
			
			<div class="col-lg-9 col-md-8 col-sm-9">
				<div class="row" id="book_list">                                               
				</div><!-- End row -->
			</div><!-- End col-lg-9-->                        
			</div><!-- End row -->
			
			<div class="row">
				<div class="col-md-12 text-right">
					<ul class="pagination">                  
					</ul>
				</div>
			</div>            	
        </div><!-- End container -->
    </section><!-- End main_content -->
	 <!-- Modal -->
	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
	  <div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header bg-warning">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title book-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body book-content">			  
		  </div>		  
		</div>
	  </div>
	</div>
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>		
	<script src="{{asset('js/custom/jquery.fancybox.min.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	
   <script src="{{asset('js/custom/books/catalog.js')}}"></script>
@stop

@stop 