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
// Route::get('/menu', 'Home@menu');
Route::get('/about-us', 'Home@about_us');
Route::get('/login', 'Home@login');
Route::get('/maps', 'Home@maps');
Route::get('/building/{building}', 'Home@detail_building');
Route::get('/building/{building}/floor/{floor}', ['building' => 'building', 'floor' => 'floor', 'uses' => 'Home@detail_floor']);
Route::get('/building/{building}/floor/{floor}/room/{room}', ['building' => 'building', 'floor' => 'floor', 'room' => 'room', 'uses' => 'Home@detail_room']);

// API get data for webapp
Route::group(['prefix' => 'api/v1/view/'], function()
{
    Route::post('building', 'API@building');
    Route::get('floor', 'API@floor');
    Route::get('room', 'API@room');
});


// Route::get('/api/v1/', 'API@index');
// Route::get('/api/v1/{building}', 'API@building');
// Route::get('/api/v1/{building}/{floor}', 'API@floor');
// Route::get('/api/v1/{building}/{floor}/{room}', 'API@room');

//API insert data from device
Route::group(['prefix' => 'api/v1/data/'], function()
{
    Route::get('sensor', 'API@sensor');
    Route::get('power', 'API@power');
});
