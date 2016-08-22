<?php


Route::auth();

Route::get('/', 'TableController@index');

Route::get('news/index', function (){
    return App\News::all();
});