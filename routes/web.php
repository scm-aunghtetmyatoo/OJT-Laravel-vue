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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController');
Route::post('posts/confirm', 'PostController@confirm')->name('posts.confirm');
Route::post('posts/{id}/editconfirm', 'PostController@editconfirm')->name('posts.editconfirm');
Route::post('posts/search', 'PostController@search')->name('posts.search');
Route::get('export', 'PostController@export')->name('export');
Route::post('import', 'PostController@import')->name('import');
Route::get('posts-upload', 'PostController@upload')->name('posts.upload');

Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users/create', 'UserController@store')->name('users.store');
Route::post('users/confirm', 'UserController@confirm')->name('users.confirm');
Route::get('users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::post('users/edit/{id}', 'UserController@update')->name('users.update');
Route::post('users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
Route::post('users/search', 'UserController@search')->name('users.search');

// test route for service_dao_structure
Route::get('/test', TestController::class . '@getList');
