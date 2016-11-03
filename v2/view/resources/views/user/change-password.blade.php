@extends('layouts.master')

@section('header-title')
    SmartSchool | Forgotten Password
@stop
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">        
@stop
@section('content')
    <!-- START SITE -->
    <div id="wrapper">
        @include('partials/header')
               
        <section class="section login">
            <div class="container">            
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="widget contentwidget">                        
                            <div class="loginbox text-center">
                            <div class="response-message"></div>
                                <h3>Change your Password</h3>                                
                                <p><small></small> </p>
                                <form class="form-inline form-horizontal"  action="#" method="post" id="signin" >
                                    <input type="text" name="password" id="password" placeholder="Password" required class="form-control" autofocus="true" />
                                    <input type="text" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required class="form-control"/>
                                    
                                    {{csrf_field()}}
                                    <button class="btn btn-success  btn-block" id="submit_btn">Change Password</button>
                                </form>         
                            </div><!-- end newsletter -->
                        </div><!-- end widget -->
                    </div>
                </div>
            </div>
        </section>
    </div><!-- end wrapper -->

    <div class="dmtop">Scroll to Top</div>
    <!-- END SITE -->
@stop    
    @section('scripts')    
    <script src="{{asset('js/plugins.js')}}"></script>
    <script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/user/login.js')}}"></script>
    @stop