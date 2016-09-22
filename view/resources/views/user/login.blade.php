@extends('layouts.master')

@section('header-title')
SmartSchool :: Login
@stop

@section('content')
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="response-message"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Log In</strong> to your account</div>
                    <form action="#" class="form-horizontal" method="post" id="signin" novalidate="true">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required/>
                        </div>
                    </div>
                    <div class="form-group">                       
                        {{csrf_field()}}
                        <div class="col-md-6">
                            <button class="btn btn-success btn-block" id="submit_btn">Log In</button>
                        </div>
                         <div class="col-md-2">                            
                        </div>
                         <div class="col-md-4 loader">
                            <img src="{{asset('img/loaders/default.gif')}}">
                        </div>
                    </div>                    
                    <div class="login-or">OR</div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <button class="btn btn-info btn-block btn-twitter"><span class="fa fa-twitter"></span> Twitter</button>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-info btn-block btn-facebook"><span class="fa fa-facebook"></span> Facebook</button>
                        </div>
                        <div class="col-md-4">                            
                            <button class="btn btn-info btn-block btn-google"><span class="fa fa-google-plus"></span> Google</button>
                        </div>
                    </div>
                    <div class="login-subtitle">
                        <a href="#" class="btn btn-link ">Forgot your password ?</a><br>
                        Don't have an account yet ? <a href="<?php echo URL::to('/register'); ?>">Create an account</a>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; <?php echo date("Y"); ?> SmartSchool
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
            
        </div>
@stop   
@section('scripts')
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/user/login.js')}}"></script>
@stop