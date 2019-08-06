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
Route::get('/', 'PagesController@index')->name('index');
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


// Dashboard and adminstration 
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/{user_id}/admin',['uses' => 'DashboardController@admin', 'as' => 'pages.check'] );

Route::get('dashboard/{comment_id}/comment', 'DashboardController@commentApprove');
Route::get('dashboard/{post_id}/show', 'DashboardController@postShow');
Route::get('dashboard/{post_id}/post', 'DashboardController@postApprove');
Route::delete('dashboard/{comment_id}/destroyComment', 'DashboardController@destroyComment');
Route::delete('dashboard/{post_id}/destroyPost', 'DashboardController@destroyPost');

// Route::get('/dashboard/comments', 'DashboardController@comments');
Route::post('/dashboard/update', 'DashboardController@update')->name('update');