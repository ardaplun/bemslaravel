<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'Home@index');
Route::get('/overview/{building}', 'Home@overview');
// Route::get('/load-profile', 'Home@loadprofile');
Route::group(['prefix' => 'load-profile'], function()
{
  Route::get('/', 'LoadController@loadprofile');
  Route::post('day', 'LoadController@day');
  Route::post('month', 'LoadController@month');
  Route::post('year', 'LoadController@year');
});
// Route::get('/usage-profile', 'UsageController@usageprofile');
Route::group(['prefix' => 'usage-profile'], function()
{
  Route::get('/', 'UsageController@usageprofile');
  Route::post('day', 'UsageController@day');
  Route::post('month', 'UsageController@month');
  Route::post('year', 'UsageController@year');
});
Route::get('/about-us', 'Home@about_us');
Route::get('/login', 'Home@login');
Route::get('/building/{building}', 'Home@detail_building');
Route::get('/building/{building}/floor/{floor}', ['building' => 'building', 'floor' => 'floor', 'uses' => 'Home@detail_floor']);
Route::get('/building/{building}/floor/{floor}/room/{room}', ['building' => 'building', 'floor' => 'floor', 'room' => 'room', 'uses' => 'Home@detail_room']);

// API get data for webapp
Route::group(['prefix' => 'api/v1/view/'], function()
{
  Route::post('maps', 'API@maps');
    Route::post('home', 'API@home');
    Route::post('building', 'API@building');
    Route::post('floor', 'API@floor');
    Route::post('room', 'API@room');
});

//API insert data from device
Route::group(['prefix' => 'api/v1/data/'], function()
{
    Route::get('sensor', 'API@sensor');
    Route::get('power', 'API@power');
});
