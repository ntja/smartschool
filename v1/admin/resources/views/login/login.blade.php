@extends('layouts.login_layout')

@section('title')
    Login
@stop
@section('css')
    <!-- Ads style -->
    <link rel="stylesheet" href="{{ asset('css/adsStyle.css')}}">
@stop
@section('content')
<div class="main">      
<div class="wrapper">      
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-4"></div>
        <!-- middle column -->
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Identification</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
             <form method="POST" action="#" role="form" id="login_form" onsubmit="return false;" >
                <input name="_token" type="hidden">
              <div class="box-body">
                   <div class="alert alert-danger alert-dismissable" id="error400" hidden="hidden">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <h4>
                <i class="icon fa fa-ban"></i>
                Alert!
                </h4>
                <span id="msg_error"></span>
            </div>
            <div class="alert alert-success alert-dismissable" id="success" hidden="hidden">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <h4>
                    <i class="icon fa fa-check"></i>
                    Alert!
                </h4>
                <span id="msg_success"></span>
            </div>
                <div class="form-group">
                  <label for="inputLogin">Email</label>
                  <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter your Email" required autofocus>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>                    
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="RmberMe"> Remember me
                  </label>
                </div>
              </div><!-- /.box-body -->

              <div class="box-footer">
                  <button class="btn btn-primary" id="Signinbtn">Connect</button>
              </div>
            </form>
          </div><!-- /.box -->
        </div><!--/.col (left) -->                     
      </div>   <!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.wrapper -->
      
@stop
@section('js')
<script src="{{asset('plugins/jQueryvalidate/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/i18n.js')}}"></script>
<script src="{{asset('js/login/loginvalidate.js')}}"></script>
@stop