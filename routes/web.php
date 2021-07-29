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

Route::get('/', '\App\Http\Controllers\TicketsController@list_database');
Route::get('tickets', '\App\Http\Controllers\TicketsController@list_freshdesk');
Route::get('database', '\App\Http\Controllers\TicketsController@list_database');

