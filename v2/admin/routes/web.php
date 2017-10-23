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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/courses', function () {
    return view('courses/list');
});

Route::get('/course/{id}/edit', 'Course\CourseController@edit')->where('id', '[0-9]+');

Route::get('/books', function () {
    return view('books/list');
});

Route::get('/users', function () {
    return view('users/list');
});