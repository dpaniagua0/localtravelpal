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


Route::auth();

Route::get('/', 'HomeController@index');

Route::post('/upload/images',[
    'as' => 'home.uploadImages',
    'uses' => 'HomeController@uploadImages'
]);

Route::post('home/deleteimg', [
    'as' => 'home.deleteImage',
    'uses' => 'HomeController@deleteImage'
]);

Route::resource('users', 'UserController');

Route::get('users/delete/{id}', [
    'as' => 'users.delete',
    'uses' => 'UserController@destroy',
]);

Route::get('users/{user_id}/wishlists/{list_id}', [
    'as' => 'users.listcontent',
    'uses' => 'UserController@wishListContent' 
]);

Route::get('users/{id}/wishlists/', [
    'as' => 'users.whishlists',
    'uses' => 'UserController@wishlists'
]);



Route::get('/profile/{id}', array(
  "as" => "users.profile",
  "uses" => "UserController@profile"
));

Route::get('/profile/{id?}/edit', array(
    "as" => "users.profile_edit",
    "uses" => "UserController@profileEdit"
));

Route::patch('/profile/{id?}/update', array(
    "as" => "users.update_profile",
    "uses" => "UserController@updateProfile"
));

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


Route::any('destinations/search', [
    'as' => 'destinations.search',
    'uses' => 'DestinationController@search'
]);

Route::resource('destinations', 'DestinationController');

Route::get('destinations/delete/{id}', [
    'as' => 'destinations.delete',
    'uses' => 'DestinationController@destroy',
]);



Route::resource('messages', 'MessageController');

Route::get('messages/delete/{id}', [
    'as' => 'messages.delete',
    'uses' => 'MessageController@destroy'
]);





