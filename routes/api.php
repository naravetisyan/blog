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

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'Api\AuthController@Register');
Route::post('/login', 'Api\AuthController@login');
Route::get('/logout', 'Api\AuthController@logout');

Route::get('/categories', 'Api\CategoriesController@allCategories');
Route::get('/me/categories', 'Api\CategoriesController@usersCategories');
Route::post('/me/categories', 'Api\CategoriesController@store');
Route::delete('/me/categories/{id}', 'Api\CategoriesController@destroy');
Route::put('/me/categories/{id}', 'Api\CategoriesController@update');

Route::get('/posts', 'Api\PostsController@allPosts');
Route::get('/me/posts', 'Api\PostsController@usersPosts');
Route::post('/me/posts', 'Api\PostsController@store');
Route::delete('/me/posts/{id}', 'Api\PostsController@destroy');
Route::put('/me/posts/{id}', 'Api\PostsController@update');