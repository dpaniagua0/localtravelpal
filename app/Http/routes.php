<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


Route::resource('users', 'UserController');

Route::get('users/delete/{id}', [
    'as' => 'users.delete',
    'uses' => 'UserController@destroy',
]);

Route::resource('roles', 'RoleController');

Route::get('roles/delete/{id}', [
    'as' => 'roles.delete',
    'uses' => 'RoleController@destroy',
]);

Route::resource('categories', 'CategoryController');

Route::get('categories/delete/{id}', [
    'as' => 'categories.delete',
    'uses' => 'CategoryController@destroy',
]);