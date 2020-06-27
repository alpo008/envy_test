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

Route::resource('/api/v0/messages','Api\V0\MessagesController',
    ['only' => ['index', 'store', 'show']]
);
