@extends('layouts.master')

@section('header-title')
    SmartSchool | Register
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
                                <h3>Join Us Now</h3>                                
                                <form class="form-horizontal"  action="#" method="post" id="register" novalidate="false">
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" required class="form-control" />

                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required class="form-control" />

                                    <input type="email" name="email" id="email" placeholder="Email address" required class="form-control" />
                                    
                                    <input type="password" name="password" id="password" placeholder="Password" required class="form-control" />

                                    <input type="password" name="confirmation_password" id="confirmation_password" placeholder="Re-type Password" required class="form-control" />
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-primary btn-block" id="submit_btn">Join SmartSchool</button>
                                    <div class="login-or">OR</div>
                                    <div class="form-group">
                                        <!--
                                        <div class="col-md-4">
                                            <button class="btn btn-info btn-block btn-twitter"><span class="fa fa-twitter"></span> Twitter</button>
                                        </div>
                                        -->
                                        <div class="col-md-6">
                                            <button class="btn btn-info btn-block btn-facebook"><span class="fa fa-facebook"></span> Facebook</button>
                                        </div>
                                        <div class="col-md-6">                            
                                            <button class="btn btn-info btn-block btn-google"><span class="fa fa-google-plus"></span> Google</button>
                                        </div>
                                    </div>                             
                                    <p>
                                        Already have an account ? <a href="<?php echo URL::to('/login'); ?>">Log in</a>
                                    </p>
                                    <p><small><i>
                                        By clicking Join SmartSchool, you agree to SmartSchool <a href="#">User Agreement</a>, <a href="#">Privacy Policy</a>  and  <a href="#">Cookie Policy</a>
                                    </i>                                        
                                    </small>                                        
                                    </p>
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
    <script src="{{asset('js/user/register.js')}}"></script>
    @stop