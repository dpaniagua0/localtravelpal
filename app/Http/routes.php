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

Route::get('users/{id}/guides', [
    'as' => 'users.guides',
    'uses' => 'UserController@userGuides'
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

Route::post('destination/setcover',[
    'as' => 'destination.setcover',
    'uses' => 'DestinationController@setCover'
]);

Route::post('destination/storeReview',[
    'as' => 'destination.storeReview',
    'uses' => 'DestinationController@storeReview'
]);

Route::any('destinations/updateStatus/{id}/{status}', [
    'as' => 'destinations.updateStatus',
    'uses' => 'DestinationController@updateStatus'
]);

Route::get('destinations/{id}/reviews', [
    'as' => 'destination.reviews',
    'uses' => 'DestinationController@reviews'
]);

Route::get('destination/{id}/reservations', [
    'as' => 'destination.reservations',
    'uses' => 'DestinationController@reservations'
]);

Route::any('destinations/uploadImages/{id}', [
    'as' => 'destinations.uploadImages',
    'uses' => 'DestinationController@uploadPhotos'
]);

Route::post('destination/addVideo', [
    'as' => 'destination.addVideo',
    'uses' => 'DestinationController@addVideo'
]);

Route::get('list-an-experience',[
    'as' => 'destinations.details',
    'uses' => 'DestinationController@details'
]);

/*Route::resource('messages', 'MessageController');

Route::get('messages/delete/{id}', [
    'as' => 'messages.delete',
    'uses' => 'MessageController@destroy'
]); */

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

Route::resource('wishlists', 'WishListController');

Route::resource('reviews', 'WishListController');

//Custom image size on url
Route::get('upload/images/{width}x{height}/{file}',[
    'as' => 'image.resize',
    'uses' => 'ImageController@resize'
]);

Route::get('images/upload', [
    'as' => 'images.upload',
    'uses' => 'ImageController@create'
]);

Route::post('images/upload', 'ImageController@store');

Route::resource('images', 'ImageController');

Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');


Route::post('addToList', 'WishListController@addTo');
Route::post('filterbycategories', 'DestinationController@searchByCategory');

Route::post('getgeocode', 'DestinationController@getGeoCode');

Route::resource('reservations', 'ReservationController');
Route::get('reservations/{id}/details', [
    'as' => 'reservations.details',
    'uses' => 'ReservationController@details'
]);

Route::post('reservations/checkout',[
    'as' => 'reservations.checkout', 
    'uses'=> 'ReservationController@checkout'
]);

Route::post('reservations/preapproved', [
    'as' => 'reservations.preapproved',
    'uses' => 'ReservationController@preapproved'
]);

Route::post('reservations/request', [
    'as' => 'reservations.request',
    'uses' => 'ReservationController@requestReservation'
]);

Route::get('/summary', [
    'as' => 'reservations.summary',
    'uses' => 'ReservationController@summary'
]);

Route::get('embed/{id}', [
    'as' => 'embed',
    'uses' => 'DestinationController@embed'
]);