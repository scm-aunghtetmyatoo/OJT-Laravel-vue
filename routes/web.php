<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', 'PostController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController');
Route::post('posts/create', 'PostController@create')->name('posts.create');
Route::post('posts/confirm', 'PostController@confirm')->name('posts.confirm');
Route::post('posts/{id}/editconfirm', 'PostController@editconfirm')->name('posts.editconfirm');
Route::post('posts/search', 'PostController@search')->name('posts.search');
Route::get('export', 'PostController@export')->name('export');
Route::post('import', 'PostController@import')->name('import');
Route::get('posts-upload', 'PostController@upload')->name('posts.upload');

Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::get('users/{id}/show', 'UserController@show')->name('users.show');
Route::post('users/create', 'UserController@store')->name('users.store');
Route::post('users/confirm', 'UserController@confirm')->name('users.confirm');
Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::post('users/{id}/edit', 'UserController@update')->name('users.update');
Route::post('users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
Route::post('users/search', 'UserController@search')->name('users.search');

Route::get('change-password/{id}', 'ChangePasswordController@index');
Route::post('change-password/{id}', 'ChangePasswordController@store')->name('change.password');

Route::get('/email', 'EmailController@create');
Route::post('/email', 'EmailController@sendEmail')->name('send.email');


