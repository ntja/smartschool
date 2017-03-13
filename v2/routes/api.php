<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'jwt.auth:1'], function () { //bypass ACL because of GUEST role but application ID required
    Route::post('/accounts', 'AccountsController@post');
	Route::post('/accounts/authenticate', 'Accounts\AuthenticateController@post');
	Route::get('/accounts/verify', 'Accounts\VerifyController@get');
	Route::post('/accounts/forgot-password', 'Accounts\forgotPasswordController@post');
	Route::post('/accounts/reset-password', 'Accounts\recoverPasswordController@post');
	Route::post('/accounts/social','Accounts\SocialController@post');
	Route::get('/courses', 'CoursesController@get');
	Route::get('/courses/search', 'Courses\SearchController@get');
	Route::get('/books', 'BooksController@get');
	Route::get('/books/{bookId}', 'Books\BookController@get')->where('bookId', '[0-9]+');
	Route::get('/books/categories', 'Books\CategoriesController@get');
	Route::get('/books/search', 'Books\SearchController@get');
	Route::get('/courses/{courseId}', 'Courses\CourseController@get')->where('courseId', '[a-z0-9]+');
	Route::put('/courses/{courseId}', 'Courses\CourseController@put')->where('courseId', '[a-z0-9]+');
	Route::get('/categories', 'CategoriesController@get');
});
Route::get('/accounts', 'AccountsController@get');
route::put('/accounts/{accountId}/password', 'Accounts\Account\PasswordController@post')->where('accountId', '[0-9]+');
Route::get('/accounts/{accountId}', 'Accounts\AccountController@get')->where('accountId', '[0-9]+');
Route::put('accounts/{accountId}/update', 'Accounts\Account\InformationsController@put')->where('accountId', '[0-9]+');
Route::get('accounts/{accountId}/courses', 'Accounts\Account\CoursesController@get')->where('accountId', '[0-9]+'); // instructors courses

Route::get('accounts/{accountId}/applications', 'Accounts\Account\ApplicationsController@get')->where('accountId', '[0-9]+'); // list of courses taken by a student

Route::post('/countries', 'CountriesController@post');

Route::post('/cities', 'CitiesController@post');

Route::post('/courses/categories', 'Courses\CategoriesController@post');

Route::post('/courses', 'CoursesController@post');
//Route::get('/courses/{shortname}', 'Courses\ShortnameController@get')->where('shortname', '[a-z0-9]+');

Route::post('/courses/{courseId}/join', 'Courses\Course\JoinController@post')->where('courseId', '[0-9]+');
Route::get('/courses/{courseId}/applications', 'Courses\Course\ApplicationsController@get')->where('courseId', '[0-9]+');
Route::put('/courses/{courseId}/change-status', 'Courses\Course\ChangeStatusController@put')->where('courseId', '[0-9]+');


Route::post('/schools', 'SchoolsController@post');

Route::post('/books', 'BooksController@post');
//Route::get('/books', 'BooksController@get');
//Route::get('/books/{bookId}', 'Books\BookController@get')->where('bookId', '[0-9]+');
Route::post('/books/categories', 'Books\CategoriesController@post');
//Route::get('/books/categories', 'Books\CategoriesController@get');


// file upload
Route::post('/uploads', 'FilesController@post');
