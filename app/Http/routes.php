<?php


Route::auth();

//All Tables
Route::get('/home', 'TableController@index');
Route::get('/', 'TableController@index');


//News
Route::get('news', 'NewsController@index');
Route::post('news', 'NewsController@store');
Route::patch('news/{news}', 'NewsController@update');
Route::delete('news/{news}', 'NewsController@destroy');


//Offer
Route::get('offer', 'OfferController@index');


//Offer_Detail
Route::get('offer_detail', 'OfferDetailController@index');
Route::post('offer_detail', 'OfferDetailController@store');
Route::patch('offer_detail/{offer_detail}', 'OfferDetailController@update');
Route::delete('offer_detail/{offer_detail}', 'OfferDetailController@destroy');


//Speiseplan/Menu
Route::get('menu', 'MenuController@index');
Route::post('menu', 'MenuController@store');
Route::patch('menu/{menu}', 'MenuController@update');
Route::delete('menu/{menu}', 'MenuController@destroy');

//Person
Route::get('person', 'PersonController@index');
Route::post('person', 'PersonController@store');
Route::patch('person/{person}', 'PersonController@update');
Route::delete('person/{person}', 'PersonController@destroy');