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

##### AUTH ROUTES #####

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login');

Route::get('/logout', 'AuthController@logout');

Route::post('/change_password', 'AuthController@change_password');

Route::post('/forgot_password', 'AuthController@forgot_password');

Route::post('/reset_password', 'AuthController@reset_password');

##### USER ROUTES #####

Route::get('/my_profile','UserController@my_profile');

Route::post('/update_profile','UserController@update_profile');