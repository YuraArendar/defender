<?php

Route::post('/login', 'AuthController@issueToken')->middleware('admin.login');

Route::middleware('auth:api')->prefix('api')->group(function () {
    Route::get('/user', 'Api\IndexController@getUser');
});


