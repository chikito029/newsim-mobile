<?php

Auth::routes();
Route::get('/', function () { return view('welcome'); });
Route::get('home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| POSTS
|--------------------------------------------------------------------------
*/
Route::resource('posts', 'PostController', ['only' => ['index', 'store']]);

/*
|--------------------------------------------------------------------------
| COURSES
|--------------------------------------------------------------------------
*/
Route::resource('courses', 'CourseController', ['except' => ['create', 'show']]);
