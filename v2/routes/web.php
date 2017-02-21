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
		return view('register');
	});	
	Route::get('/login', function () {
		return view('login');
	});
	Route::get('/forgot-password', function () {
		return view('user.forgot-password');
	});
	Route::get('/activate', function () {
		return view('user.activate');
	});
	Route::get('/change-password', function () {
		return view('user.change-password');
	});
});
