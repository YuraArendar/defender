<?php



Route::get('/', function () {
    return view('welcome');
});

if (is_developer_mode()) {
    Route::get('/test', 'TestController@test');
}
