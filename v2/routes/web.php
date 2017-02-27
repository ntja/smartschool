<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'Localization\LanguageController@switchLang']);

Route::group(['middleware' => 'web'], function () {
	Route::get('/home', function () {
		return view('home');
	});
	Route::get('/', function () {
		return view('home');
	});
	Route::get('/register', function () {
		return view('user.register');
	});	
	Route::get('/login', function () {
		return view('user.login');
	});
	Route::get('/forgot-password', function () {
		return view('user.forgot-password');
	});
	Route::get('/activate', function () {
		return view('user.activate');
	});
	Route::get('/reset-password', function () {
		return view('user.reset-password');
	});
	
	Route::get('/instructor/dashboard', function () {
		return view('instructor.dashboard');
	});
	Route::get('/instructor/courses', function () {
		return view('instructor.courses');
	});
	Route::get('/learner/dashboard', function () {
		return view('learner.dashboard');
	});
	
	Route::get('/course/{ID}', 'Views\Courses\DetailsController@get')->where('ID', '[a-z0-9]+');
	
	Route::get('/subscription-plans', function () {
		return view('subscription-plans');
	});
});
