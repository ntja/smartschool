@extends('layouts.master')

@section('header-title')
SmartSchool :: Register
@stop

@section('header-styles')
    
@stop

@section('content')
        
<div class="login-container">        
    <div class="login-box animated fadeInDown">
        <div class="response-message"></div>
        <div class="login-body">
            <div class="login-title"><strong>Create new account</strong></div>
            <form  action="javascript:void" class="form-horizontal" method="post" id="register" novalidate="false">                                
            <div class="form-group">
                <div class="col-md-12">                        
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" required/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" required/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Password confirmation" required/>
                </div>
            </div>
            <div class="form-group">                        
                <div class="col-md-12 role">
                    <label for="learner" class="control-label">Learner &nbsp;</label>
                    <label class="switch switch-small">
                        <input name="role" checked value="LEARNER" type="radio" id="learner">
                        <span></span>
                    </label>  
                    <label class="switch switch-small">
                        <input name="role" value="INSTRUCTOR" type="radio" id="instructor">
                        <span></span>
                    </label>          
                    <label for="instructor" class="control-label">&nbsp; Instructor</label>                   
                </div>                 
                
            </div>
            {{csrf_field()}}
            <div class="form-group">
                <div class="col-md-6">
                    <button class="btn btn-success btn-block mb-control" data-box="#message-box-success" id="submit_btn">Join SmartSchool</button>
                </div>    
                <div class="col-md-3 loader">
                    <img src="{{asset('img/loaders/default.gif')}}">
                </div>                    
            </div>                    
            <div class="login-subtitle">
                <p>Already have an account ? <a href="<?php echo URL::to('/login'); ?>">Sign in</a></p>
                <p><small><i class="text-warning">By clicking Join SmartSchool, you agree to SmartSchool <a href="#">User Agreement</a>, <a href="#">Privacy Policy</a> and <a href="#">Cookie Policy</a></i></small></p>
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
<!-- success -->
        <div class="message-box message-box-success animated fadeIn" id="message-box-success">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <p>Well done ! Your account has been created. We've sent you a verification email. Please check it to complete the process.</p>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end success -->
@stop   

@section('scripts')
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/user/register.js')}}"></script>
@stop