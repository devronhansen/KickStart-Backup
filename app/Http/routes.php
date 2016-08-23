<?php


Route::auth();

Route::get('/', 'TableController@index');

Route::get('news', 'NewsController@index');

Route::patch('news/{news}', 'NewsController@update');

Route::delete('news/{news}', 'NewsController@destroy');