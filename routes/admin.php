<?php

Route::get('/', 'IndexController@index');
Route::post('/login', 'AuthController@issueToken')->middleware('admin.login');

Route::middleware('auth:api')->prefix('api')->group(function () {
    Route::post('/user', 'Api\IndexController@getUser');
    Route::post('/logout', 'AuthController@logout');
});


