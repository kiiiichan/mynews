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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); 
     Route::get('news', 'Admin\NewsController@index')->middleware('auth');
});

Route::get('XXX',
'AAAController@bbb');

Route::group(['prefix' => 'admin/profile', 'middleware' => 'auth'], function() {
    Route::get('create', 'Admin\ProfileController@add');
    Route::post('create', 'Admin\ProfileController@create');
    Route::get('edit', 'Admin\ProfileController@edit');
    Route::post('edit', 'Admin\ProfileController@update');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
