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

Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::resource('/category', 'CategoryController');
Route::resource('/post', 'PostController');

Route::get('login/google', 'Auth\LoginController@redirectToGoogleProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleProviderCallback');

 Route::get('login/facebook', 'Auth\LoginController@redirectToFacebookProvider');
 Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookProviderCallback');

 

// Route::get('/redirect', 'SocialAuthController@redirect');
// Route::get('/callback', 'SocialAuthController@callback');
