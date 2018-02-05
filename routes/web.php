<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'test api Rest bondacom';
});

//Localization route
Route::get('location/{country}', 'LocationController@getLocations');
//Simple routes
Route::resource('countries', 'CountryController');
Route::resource('states', 'StateController');
Route::resource('counties', 'CountyController');
Route::resource('cities', 'CityController');
