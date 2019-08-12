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
Route::get('/users', 'PagesController@users')->name('users');
Route::get('/users/{user_id}', 'PagesController@user')->name('user');

// Route::get('/posts/{id}', 'PostsController@show')->name('posts.show');

// it creates all the routes we need for 
// functions in the PostsController 

// we create posts controller and so route posts
// artisan comand => make:controller PostsController --resource
Route::resource('/posts', 'PostsController');
Route::get('/posts/{post}', ['uses' => 'PostsController@show', 'as' => 'show']);

// Like
Route::post('/like', ['uses' => 'PostsController@likePost' , 'as' => 'like']);

// adminstration
Route::get('posts/{post_id}/show', 'PostsController@postShow');
Route::get('posts/{post_id}/post', 'PostsController@postApprove');
Route::get('posts/{post_id}/review', 'PostsController@postReview');
Route::delete('comments/{comment_id}/destroyComment', 'CommentsController@destroyComment');
Route::delete('posts/{post_id}/destroyPost', 'PostsController@destroyPost');


Route::resource('/comment', 'CommentsController');

Auth::routes();


// Dashboard and adminstration 
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/{user_id}/admin',['uses' => 'DashboardController@admin', 'as' => 'admin'] );


Route::get('comments/{comment_id}/comment', 'CommentsController@commentApprove');



// Route::get('/dashboard/comments', 'DashboardController@comments');
Route::post('/dashboard/update', 'DashboardController@update')->name('update');