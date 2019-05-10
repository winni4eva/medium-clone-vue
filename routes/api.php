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

Route::middleware('auth:api')->get(
    '/user', function (Request $request) {
        return $request->user();
    }
);

Route::group(
    ['namespace' => 'Auth'], 
    function () {
        Route::get('logout', 'LoginController@logout');
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login');
    }
);

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::resource('articles', 'ArticlesController', ['except' => ['index']]);
    }
);
