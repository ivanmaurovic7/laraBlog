<?php

use Illuminate\Http\Request;
use App\Post;

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

Route::get('posts', 'PostController@index');

Route::get('post/{id}', 'PostController@show');

Route::post('post/store', 'PostController@store')->middleware('auth:api');

Route::patch('post/{id}', 'PostController@update')->middleware('auth:api');

Route::delete('post/{id}', 'PostController@delete')->middleware('auth:api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');

Route::post('/register', 'AuthController@register');

Route::middleware('auth:api')->post('/logout', 'AuthController@logout');