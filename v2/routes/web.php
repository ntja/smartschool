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
	Route::get('/instructor/profile', function () {
		return view('instructor.profile');
	});
	Route::get('/instructor/courses', function () {
		return view('instructor.courses');
	});
	Route::get('/learner/dashboard', function () {
		return view('learner.dashboard');
	});
	Route::get('/learner/my-courses', function () {
		return view('learner.my-courses');
	});
	
	Route::get('/course/{ID}', 'Views\Courses\OverviewController@get')->where('ID', '[a-zA-Z0-9\-]+');
        
    Route::get('/course/{ID}/{lessID}', 'Views\Courses\LessonController@get')->where('ID', '[a-zA-Z0-9\-]+')->where('lessID', '[a-zA-Z0-9\-]+');
	
    Route::get('/courses/catalog', function () {
		return view('courses.catalog');
	});
	
	Route::get('/subscription-plans', function () {
            return view('subscription-plans');
	});
        Route::get('/contact-us', function () {
            return view('contact-us');
	});        
});
