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

Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users/create', 'UserController@store')->name('users.store');
Route::get('users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::post('users/edit/{id}', 'UserController@update')->name('users.update');
Route::post('users/destroy/{id}', 'UserController@destroy')->name('users.destroy');

