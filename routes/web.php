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

Route::get('/', 'HomeController@index')->middleware('checkLogin');

Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@postLogin');

Route::get('/logout', 'UserController@logout');

Route::get('/changePassword', 'UserController@changePassword')->middleware('checkLogin');
Route::post('/changePassword', 'UserController@postChangePassword')->middleware('checkLogin');

Route::get('/posts','PostController@index')->name('posts')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/posts/add','PostController@add')->name('posts/add')->middleware('checkLogin')->middleware('checkPermission');
Route::post('/posts/add', 'PostController@postAdd')->name('posts/add')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts/edit')->middleware('checkLogin')->middleware('checkPermission');
Route::post('/posts/edit/{id}', 'PostController@postEdit')->name('posts/edit')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/posts/search/{query}', 'PostController@search')->name('posts/search')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/posts/status_pending/{id}', 'PostController@pending')->name('posts/status_pending')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/posts/status_publish/{id}', 'PostController@publish')->name('posts/status_publish')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/posts/status_delete/{id}', 'PostController@edit')->name('posts/status_delete')->middleware('checkLogin')->middleware('checkPermission');

Route::get('/category', 'CategoryController@index')->name('catnews')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/category/edit/{id}', 'CategoryController@edit')->name('catnews/edit')->middleware('checkLogin')->middleware('checkPermission');
Route::post('/category/edit', 'CategoryController@postEdit')->name('catnews/edit')->middleware('checkLogin')->middleware('checkPermission');
Route::get('/category/add', 'CategoryController@add')->name('catnews/add')->middleware('checkLogin')->middleware('checkPermission');
Route::post('/category/add', 'CategoryController@postAdd')->name('catnews/add')->middleware('checkLogin')->middleware('checkPermission');

Route::get('settings', 'HomeController@setting')->name('settings')->middleware('checkLogin')->middleware('checkPermission');
Route::post('settings', 'HomeController@postSetting')->name('settings')->middleware('checkLogin')->middleware('checkPermission');
// API

Route::get('/api/loadMorePost/{page?}','ApiController@loadMorePost')->middleware('checkLogin');
Route::get('/api/loadMorePostInCategory/{id}/{page?}','ApiController@loadMorePostInCategory')->middleware('checkLogin');