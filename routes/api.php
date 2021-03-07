<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('contact-list','App\Http\Controllers\Api\ContactController@list');
Route::post('add-contact','App\Http\Controllers\Api\ContactController@create');
Route::post('edit-contact','App\Http\Controllers\Api\ContactController@edit');
Route::post('delete-contact','App\Http\Controllers\Api\ContactController@delete');