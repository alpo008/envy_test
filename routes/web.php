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

Route::get('/', function () {
    return view('index');
});
Route::get('/contact', function () {
    return view('index');
});
Route::get('/info', function () {
    return view('index');
});

Route::get('/test', 'TestController@index')->name('Test');

Route::group(['prefix' => '/v0', 'namespace' => 'Api\V0', 'as' => 'api.'], function () {
    Route::resource('messages', 'MessagesController', ['except' => ['create', 'edit']]);
});
