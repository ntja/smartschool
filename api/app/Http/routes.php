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

Route::get('/', function () {
    return view('welcome');
	//$password = '';
	//return password_hash($password, PASSWORD_BCRYPT);
});

//Route::post('/accounts', 'AccountsController@post');
Route::group(['middleware' => 'jwt.auth:1'], function () { //bypass ACL because of GUEST role but application ID required
    Route::post('/accounts', 'AccountsController@post');
	Route::post('/accounts/authenticate', 'Accounts\AuthenticateController@post');
	Route::get('/accounts/verify', 'Accounts\VerifyController@get');
	Route::post('/accounts/forgot-password', 'Accounts\forgotPasswordController@post');
	Route::post('/accounts/reset-password', 'Accounts\recoverPasswordController@post');
});
Route::get('/accounts', 'AccountsController@get');
route::post('/accounts/{accountId}/password', 'Accounts\Account\PasswordController@post')->where('accountId', '[0-9]+');
Route::get('/accounts/{accountId}', 'Accounts\AccountController@get')->where('accountId', '[0-9]+');
Route::post('accounts/{accountId}/informations', 'Accounts\Account\InformationsController@post')->where('accountId', '[0-9]+');
Route::get('accounts/{accountId}/courses', 'Accounts\Account\accountsController@get')->where('accountId', '[0-9]+');

Route::post('/countries', 'CountriesController@post');

Route::post('/cities', 'CitiesController@post');

//Route::post('/Schools', 'SchoolsController@post');

Route::post('/courses/categories', 'Courses\CategoriesController@post');

Route::post('/courses', 'CoursesController@post');
Route::get('/courses', 'CoursesController@get');

Route::post('/courses/{courseId}/join', 'Courses\Course\JoinController@post')->where('accountId', '[0-9]+');;


Route::post('/schools', 'SchoolsController@post');

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
    //
});
