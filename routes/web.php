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

Route::get('/{user_id}', 'App\Http\Controllers\TodoController@index')
    ->name('index');

Route::get('/', 'App\Http\Controllers\TodoController@checkCookies')
    ->name('index_2');

Route::post('/{user_id}/add', 'App\Http\Controllers\TodoController@store')
    ->name('add.task');
Route::post('/{user_id}/{id}/done', 'App\Http\Controllers\TodoController@done')
    ->name('done.task');
Route::delete('/{user_id}/{id}/remove', 'App\Http\Controllers\TodoController@destroy')
    ->name('remove.task');
Route::delete('/{user_id}/remove/all', 'App\Http\Controllers\TodoController@destroyAll')
    ->name('remove.task.all');