<?php


Route::auth();

Route::get('/home', 'TableController@index');

Route::get('/', 'TableController@index');

Route::get('news', 'NewsController@index');

Route::post('news', 'NewsController@store');

Route::patch('news/{news}', 'NewsController@update');

Route::delete('news/{news}', 'NewsController@destroy');


