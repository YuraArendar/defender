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

    Route::patch('content/{content}/active', 'ContentController@active');
    Route::patch('content/{content}/{structure}/up', 'ContentController@up');
    Route::patch('content/{content}/{structure}/down', 'ContentController@down');
    Route::get('content/{structure}/pagination', 'ContentController@pagination');

    Route::resource('content-meta', 'ContentMetaController')->except(['edit', 'create', 'index', 'destroy']);
});

//test changes
