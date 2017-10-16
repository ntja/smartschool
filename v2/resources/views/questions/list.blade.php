@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Courses Catalog')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('js/plugins/jquery-tags-input/dist/jquery.tagsinput.min.css')}}" rel="stylesheet">
@stop
@section('content')

@include('partials/header')

    <section id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1>{{__('Courses Catalog')}}</h1>      
                <p class="lead">
                   {{__('Explore new interests and career opportunities with courses in Mathematics, Computer Science, Chemistry, Physics, Biology and more...')}}
                </p>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
    <div class="divider_top"></div>
    </section><!-- End sub-header -->
    
    
    <section id="main_content">

<div class="container">

<ol class="breadcrumb">
  <li><a href="index.html">Home</a></li>
  <li class="active">Active page</li>
</ol>

	 <div class="row">
     <aside class="col-md-4">
     	<div class=" box_style_1">
				<div class="widget" style="margin-top:15px;">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
						<button class="btn btn-default" type="button" style="margin-left:0;"><i class="icon-search"></i></button>
						</span>
					</div><!-- /input-group -->
				</div><!-- End Search -->
                
				<div class="widget">
					<h4>Text widget</h4>
					<p>
						 Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
					</p>
				</div><!-- End widget -->
               
                
				<div class="widget">
					<h4>Recent post</h4>
                    
					<ul class="recent_post">
						<li>
						<i class="icon-calendar-empty"></i> 16th July, 2020
						<div><a href="#">It is a long established fact that a reader will be distracted </a></div>
						</li>
						<li>
						<i class="icon-calendar-empty"></i> 16th July, 2020
						<div><a href="#">It is a long established fact that a reader will be distracted </a></div>
						</li>
						<li>
						<i class="icon-calendar-empty"></i> 16th July, 2020
						<div><a href="#">It is a long established fact that a reader will be distracted </a></div>
						</li>
					</ul>
				</div><!-- End widget -->
                
				<div class="widget tags add_bottom_30">
					<h4>Tags</h4>
					<a href="#">Lorem ipsum</a>
					<a href="#">Dolor</a>
					<a href="#">Long established</a>
					<a href="#">Sit amet</a>
					<a href="#">Latin words</a>
					<a href="#">Excepteur sint</a>
				</div><!-- End widget -->
                
			</div><!-- End box-sidebar -->
     </aside><!-- End aside -->
     
     <div class="col-md-8">
     		<div class="post">
					<a href="blog_post.html" title="single_post.html"><img src="img/blog-3.jpg" alt="" class="img-responsive"></a>
					<div class="post_info clearfix">
						<div class="post-left">
							<ul>
								<li><i class="icon-calendar-empty"></i>On <span>12 Nov 2020</span></li>
								<li><i class="icon-user"></i>By <a href="#">John Smith</a></li>
								<li><i class="icon-tags"></i>Tags <a href="#">Works</a> <a href="#">Personal</a></li>
							</ul>
						</div>
						<div class="post-right"><i class="icon-comment"></i><a href="#">25 </a>Comments</div>
					</div>
					<h2><a href="single_post.html" title="single_post.html">Duis aute irure dolor in reprehenderit</a></h2>
					<p>
						Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem.....
					</p>
					<a href="single_post.html" class="button_medium" title="single_post.html">Read more</a>
				</div><!-- end post -->
                
				<div class="post">
					<a href="blog_post.html" title="single_post.html"><img src="img/blog-1.jpg" alt="" class="img-responsive"></a>
					<div class="post_info clearfix">
						<div class="post-left">
							<ul>
								<li><i class="icon-calendar-empty"></i>On <span>12 Nov 2020</span></li>
								<li><i class="icon-user"></i>By <a href="#">John Smith</a></li>
								<li><i class="icon-tags"></i>Tags <a href="#">Works</a> <a href="#">Personal</a></li>
							</ul>
						</div>
						<div class="post-right"><i class="icon-comment"></i><a href="#">25 </a>Comments</div>
					</div>
					<h2><a href="single_post.html" title="single_post.html">Duis aute irure dolor in reprehenderit</a></h2>
					<p>
						Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem.....
					</p>
					<a href="blog_post.html" class="button_medium">Read more</a>
				</div><!-- end post -->
                
				<div class="post">
					<a href="blog_post.html" title="single_post.html"><img src="img/blog-2.jpg" alt="" class="img-responsive"></a>
					<div class="post_info clearfix">
						<div class="post-left">
							<ul>
								<li><i class="icon-calendar-empty"></i>On <span>12 Nov 2020</span></li>
								<li><i class="icon-user"></i>By <a href="#">John Smith</a></li>
								<li><i class="icon-tags"></i>Tags <a href="#">Works</a> <a href="#">Personal</a></li>
							</ul>
						</div>
						<div class="post-right"><i class="icon-comment"></i><a href="#">25 </a>Comments</div>
					</div>
					<h2><a href="blog_post.html" title="single_post.html">Duis aute irure dolor in reprehenderit</a></h2>
					<p>
						Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem.....
					</p>
					<a href="blog_post.html" class="button_medium" title="single_post.html">Read more</a>
				</div><!-- end post -->
                
				<hr>
                
                <div class="text-center">
                    <ul class="pagination">
                        <li><a href="#">Prev</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">Next</a></li>
                    </ul><!-- end pagination-->
                </div>
     </div><!-- End col-md-8-->   
  
	
  </div>  <!-- End row-->    
</div><!-- End container -->
</section><!-- End main_content-->

@include('partials/footer')

@section('scripts')
	<script src="{{asset('js/custom/config/config.js')}}"></script>
	<script src="{{asset('js/custom/functions.js')}}"></script>
	<script src="{{asset('js/localization/i18n.js')}}"></script>
	<script src="{{asset('js/plugins/jquery-tags-input/dist/jquery.tagsinput.min.js')}}"></script>
   <script src="{{asset('js/custom/questions/list.js')}}"></script>
   <script>
		$('.tags').tagsInput({
		   //'autocomplete_url': url_to_autocomplete_api,
		   //'autocomplete': { option: value, option: value},
		   'height':'100px',
		   'width':'300px',
		   'interactive':true,
		   'defaultText':'add a tag',
		   //'onAddTag':callback_function,
		   //'onRemoveTag':callback_function,
		   //'onChange' : callback_function,
		   'delimiter': [',',';'],   // Or a string with a single delimiter. Ex: ';'
		   'removeWithBackspace' : true,
		   'minChars' : 0,
		   'maxChars' : 0, // if not provided there is no limit
		   //'placeholderColor' : '#666666'
		});
   </script>
@stop

@stop 