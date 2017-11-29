<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'Api\AuthController@Register');
Route::post('/login', 'Api\AuthController@login');
Route::get('/logout', 'Api\AuthController@logout');

Route::get('/categories', 'Api\CategoriesController@all_categories');
Route::get('/me/categories', 'Api\CategoriesController@users_categories');
Route::post('/add_category', 'Api\CategoriesController@store');
Route::delete('/delete_category/{id}', 'Api\CategoriesController@destroy');
Route::put('/edit_category/{id}', 'Api\CategoriesController@update');

Route::get('/posts', 'Api\PostsController@all_posts');
Route::get('/me/posts', 'Api\PostsController@users_posts');
Route::post('/add_post', 'Api\PostsController@store');
Route::delete('/delete_post/{id}', 'Api\PostsController@destroy');
Route::put('/edit_post/{id}', 'Api\PostsController@update');