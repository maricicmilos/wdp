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


Route::group(['middleware' => 'role'], function(){

    Route::get('/', function () {
        return view('home');
    }); 

    Route::get('/home', 'HomeController@index')->name('home');
    
    /* Admin Panel URI's */

    Route::resource('admin/users', 'UserController');
    Route::resource('admin/posts', 'PostController');
    Route::resource('admin/roles', 'RoleController');
    Route::resource('admin/categories', 'CategoryController');
    Route::resource('admin/comments', 'CommentController');
    Route::resource('admin/replies', 'ReplyController');

    Route::get('admin/search/users', 'UserController@search')->name('users.search');
    Route::get('admin/delete/users/{id}', 'UserController@delete')->name('users.delete');
    Route::post('admin/search/show', 'UserController@show_search')->name('users.search.results');


});
/* Posts Routes - with resource routes */

Auth::routes();

/* FRONTEND OF APPLICATION */

/* Home Post*/

Route::get('/post/{id}', 'HomeController@post')->name('home.post');
Route::get('/posts', 'HomeController@posts')->name('home.posts');
Route::post('/post/comment', 'HomeController@createComment')->name('home.comment');
Route::post('/post/reply', 'HomeController@createReply')->name('home.reply');
Route::get('/profile/{id}', 'HomeController@profile')->name('home.profile');



