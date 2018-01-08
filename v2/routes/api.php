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
	Route::post('/accounts/forgot-password', 'Accounts\ForgotPasswordController@post');
	Route::post('/accounts/reset-password', 'Accounts\RecoverPasswordController@post');
	Route::post('/accounts/social','Accounts\SocialController@post');
	Route::get('/search', 'SearchController@get');
	Route::get('/courses', 'CoursesController@get');
	Route::get('/courses/search', 'Courses\SearchController@get');
	Route::get('/books', 'BooksController@get');
	Route::get('/books/{bookId}', 'Books\BookController@get')->where('bookId', '[a-zA-Z0-9\-]+');
	Route::get('/books/categories', 'Books\CategoriesController@get');
	Route::get('/books/search', 'Books\SearchController@get');
	Route::get('/courses/{courseId}', 'Courses\CourseController@get')->where('courseId', '[a-zA-Z0-9\-]+');
	Route::put('/courses/{courseId}', 'Courses\CourseController@put')->where('courseId', '[a-zA-Z0-9\-]+');
	Route::get('/categories', 'CategoriesController@get');	
	Route::get('/courses/lessons/{lessId}', 'Courses\Lessons\LessonController@get')->where('{lessId}', '[0-9a-zA-Z\-]+');
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
Route::post('/courses/from-storage', 'Courses\FromStorageController@post');
Route::post('/books/from-storage', 'Books\FromStorageController@post');

Route::post('/courses/{courseId}/join', 'Courses\Course\JoinController@post')->where('courseId', '[0-9]+');
Route::get('/courses/{courseId}/applications', 'Courses\Course\ApplicationsController@get')->where('courseId', '[0-9]+');
Route::put('/courses/{courseId}/change-status', 'Courses\Course\ChangeStatusController@put')->where('courseId', '[0-9]+');

Route::post('/courses/{courseId}/sections', 'Courses\Course\SectionsController@post')->where('courseId', '[0-9]+');
Route::get('/courses/{courseId}/sections', 'Courses\Course\SectionsController@get')->where('courseId', '[0-9a-zA-Z\-]+');

Route::get('/courses/{courseId}/sections/{sectId}', 'Courses\Course\SectionController@get')->where('courseId', '[0-9]+')->where('sectId', '[0-9]+');
Route::put('/courses/{courseId}/sections/{sectId}', 'Courses\Course\SectionController@put')->where('courseId', '[0-9]+')->where('sectId', '[0-9]+');

Route::post('/courses/sections/{sectId}/lessons', 'Courses\Course\Sections\LessonsController@post')->where('sectId', '[0-9]+');
Route::post('/questions', 'QuestionsController@post');
Route::get('/questions', 'QuestionsController@get');
Route::post('/answers', 'AnswersController@post');

Route::get('/categories/{catId}/books', 'Categories\Category\BooksController@get')->where('catId', '[0-9]+');
Route::get('/categories/{catId}/courses', 'Categories\Category\CoursesController@get')->where('catId', '[0-9]+');

Route::post('/schools', 'SchoolsController@post');

Route::post('/books', 'BooksController@post');
//Route::get('/books', 'BooksController@get');
//Route::get('/books/{bookId}', 'Books\BookController@get')->where('bookId', '[0-9]+');
Route::post('/books/categories', 'Books\CategoriesController@post');
//Route::get('/books/categories', 'Books\CategoriesController@get');



// file upload
Route::post('/uploads', 'FilesController@post');
Route::post('/fileupload', 'FilesController@uploadImage');
