<?php

use Illuminate\Support\Facades\Route;

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
//read
Route::get('/', 'HomeController@index');
Route::get('/{slug}', 'HomeController@go_to');

//create
Route::post('/create', 'HomeController@create');

//update
Route::get('/edit/{link:short}', 'HomeController@edit');
Route::patch('/update/{link}', 'HomeController@update');

//delete
Route::post('/{link}/destroy', 'HomeController@destroy');