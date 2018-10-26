<?php
/**
 * Created by PhpStorm.
 * User: htinlynn
 * Date: 10/24/18
 * Time: 10:55 PM
 */


Route::post('login', 'AuthController@login');
Route::post('user','AuthController@register');
Route::post('verify','AuthController@verifyUser');
Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
});
