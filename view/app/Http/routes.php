<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'UserController@login');

//Route::post('user', 'UserController@post');
//Route::post('auth', 'AuthenticateController@authenticate');
//Route::get('user', 'UserController@index');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
	Route::get('/login', 'UserController@login');	
	Route::get('/register', 'UserController@register');
	Route::get('/instructors/dashboard', 'Instructors\DashboardController@get');
	Route::get('/learners/dashboard', 'Learners\DashboardController@get');
	Route::get('/learners/settings', function () {
		return view('learners.settings');
	});
	Route::get('/instructors/settings', function () {
		return view('instructors.settings');
	});
	Route::get('/instructors/courses/all', function () {
		return view('instructors.courses.all');
	});	
    //
});
