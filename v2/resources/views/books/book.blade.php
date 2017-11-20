@extends('layouts.master')

@section('header-title')
    SmartSchool | {{{ $book_id }}}
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
    
    <section id="main_content" data-book_id={{{ $book_id }}}>
    	<div class="container-fluid">        
			<ol class="breadcrumb">
			  <li><a disabled href="<?php echo URL::to('/'); ?>">{{__('Home')}}</a></li>
			  <li><a href="<?php echo URL::to('/books'); ?>">{{__('Books Catalog')}}</a></li>
			</ol>
			
			<div class="row">
			
			<aside class="col-lg-3 col-md-4 col-sm-3">
				<div class="box_style_1">
					<h4>{{__('Similar Books')}}</h4>
					<ul class="submenu-col similar_books">						
					</ul>
				</div>
			</aside>
			
			<div class="col-lg-9 col-md-8 col-sm-9">
				<div class="row" id="book">                                               
				</div><!-- End row -->
			</div><!-- End col-lg-9-->                        
			</div><!-- End row -->			    	
        </div><!-- End container -->
    </section><!-- End main_content -->	 
@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>		
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	
   <script src="{{asset('js/custom/books/book.js')}}"></script>
@stop

@stop 