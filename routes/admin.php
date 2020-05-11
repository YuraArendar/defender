<?php

Route::get('/', 'IndexController@index');
Route::post('/login', 'AuthController@issueToken')->middleware('admin.login');

Route::middleware(['auth:api', 'locale'])->prefix('api')->group(static function () {
    Route::post('/user', 'Api\IndexController@getUser');
    Route::post('/logout', 'AuthController@logout');

    Route::resource('structures', 'StructureController')->except(['edit', 'create']);
    Route::patch('structures/up/{structure}', 'StructureController@up');
    Route::patch('structures/down/{structure}', 'StructureController@down');

    Route::resource('structures-meta', 'StructureMetaController')->except(['edit', 'create', 'index', 'destroy']);

    Route::resource('content', 'ContentController')->except(['edit', 'create']);
});


