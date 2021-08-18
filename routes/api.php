<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController');
Route::post('posts/create', 'PostController@create')->name('posts.create');
Route::post('posts/confirm', 'PostController@confirm')->name('posts.confirm');
Route::post('posts/{id}/edit', 'PostController@edit')->name('posts.edit');
Route::post('posts/{id}/editconfirm', 'PostController@editconfirm')->name('posts.editconfirm');
Route::post('posts/search', 'PostController@search')->name('posts.search');
Route::get('export', 'PostController@export')->name('export');
Route::post('import', 'PostController@import')->name('import');
Route::get('posts-upload', 'PostController@upload')->name('posts.upload');

Route::resource('users', 'UserController');
Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users/create', 'UserController@create')->name('users.create');
Route::post('users/store', 'UserController@store')->name('users.store');
Route::get('users/{id}/show', 'UserController@show')->name('users.show');
Route::post('users/confirm', 'UserController@confirm')->name('users.confirm');
Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::post('users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::post('users/{id}/editconfirm', 'UserController@editconfirm')->name('users.editconfirm');
Route::post('users/{id}/update', 'UserController@update')->name('users.update');
// Route::delete('users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
Route::post('users/search', 'UserController@search')->name('users.search');

Route::get('change-password/{id}', 'ChangePasswordController@index');
Route::post('change-password/{id}', 'ChangePasswordController@store')->name('change.password');

Route::get('/email', 'EmailController@create');
Route::post('/email', 'EmailController@sendEmail')->name('send.email');

// test route for service_dao_structure
Route::get('/test', TestController::class . '@getList');

Route::get('/secrets', 'SecretController@index');


// Route::prefix('auth')->group(function () {
//     Route::post('register', 'AuthController@register');
//     Route::post('login', 'AuthController@login');
//     Route::get('refresh', 'AuthController@refresh');
//     Route::group(['middleware' => 'auth:api'], function(){
//         Route::get('user', 'AuthController@user');
//         Route::post('logout', 'AuthController@logout');
//     });
// });

// Route::group(['middleware' => 'auth:api'], function(){
//     // Users
//     Route::get('users', 'UserController@index')->middleware('isAdmin');
//     Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
// });
