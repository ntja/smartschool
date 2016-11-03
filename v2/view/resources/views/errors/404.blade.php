@extends('layouts.master')

@section('header-title')
SmartSchool :: Page Not Found
@stop
    
@section('header-styles')
    <link rel="stylesheet" type="text/css" href="{{asset('styles/theme-default.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles/custom.css')}}">
@stop
@section('content')
	<div class="error-container">
            <div class="error-code">404</div>
            <div class="error-text">page not found</div>
            <div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
            <div class="error-actions">                                
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block btn-lg" onClick="document.location.href = '{{url('/instructors/dashboard')}}';">Back to dashboard</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block btn-lg" onClick="history.back();">Previous page</button>
                    </div>
                </div>                                
            </div>           
        </div>
    </body>
</html>