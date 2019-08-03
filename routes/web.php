<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// this step is first step in routing step
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

// Route::get('/posts/{id}', 'PostsController@show')->name('posts.show');

// it creates all the routes we need for 
// functions in the PostsController 

// we create posts controller and so route posts
// artisan comand => make:controller PostsController --resource
Route::resource('/posts', 'PostsController');
Route::get('/posts/{post}', ['uses' => 'PostsController@show', 'as' => 'posts.show']);


Route::resource('/comment', 'CommentsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
