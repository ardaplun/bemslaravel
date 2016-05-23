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
Route::get('/menu', 'Home@menu');
Route::get('/about-us', 'Home@about_us');
Route::get('/login', 'Home@login');
Route::get('/maps', 'Home@maps');
Route::get('/building/{id}', 'Home@detail_building');
Route::get('/building/floor/{id}', 'Home@detail_building');
Route::get('/building/floor/room/{id}', 'Home@detail_room');
