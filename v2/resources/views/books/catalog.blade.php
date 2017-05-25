@extends('layouts.master')

@section('header-title')
    SmartSchool | {{__('Books Catalog')}}
@stop
@section('header-styles')
   <!-- CUSTOM STYLES -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
	<style>
		.myIframe {
			position: relative;
			padding-bottom: 52.00%;
			padding-top: 30px;
			height: 0;
			overflow: auto; 
			-webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
			border: solid black 1px;
		} 
		.myIframe iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
		
		.modal-dialog {
		  width: 100%;
		  height: 100%;
		  margin: 0;
		  padding: 0;
		}

		.modal-content {
		  height: auto;
		  min-height: 100%;
		  border-radius: 0;
		}

	</style>
@stop
@section('content')

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
						<li><a href="#" id="active">{{__('All Books')}}</a></li>
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
	<script src="{{asset('js/localization/i18n.js')}}"></script>
   <script src="{{asset('js/custom/books/catalog.js')}}"></script>
@stop

@stop 