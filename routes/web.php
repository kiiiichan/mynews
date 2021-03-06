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


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); 
     Route::get('news', 'Admin\NewsController@index')->middleware('auth');
     Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth'); // 追記
     Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth'); // 追記
     Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');
});



Route::group(['prefix' => 'admin/profile', 'middleware' => 'auth'], function() {
    Route::get('create', 'Admin\ProfileController@add');
    Route::post('create', 'Admin\ProfileController@create');
    Route::get('/', 'Admin\ProfileController@index')->middleware('auth');
    Route::get('edit', 'Admin\ProfileController@edit');
    Route::post('edit', 'Admin\ProfileController@update');
    Route::get('delete', 'Admin\ProfileController@delete')->middleware('auth');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'NewsController@index');

Route::get('/profile', 'ProfileController@index');
