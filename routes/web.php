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

Route::get('/', 'App\Http\Controllers\TodoController@index')
    ->name('index');
Route::post('/add', 'App\Http\Controllers\TodoController@store')
    ->name('add.task');
Route::post('/{id}/done', 'App\Http\Controllers\TodoController@done')
    ->name('done.task');
Route::delete('/{id}/remove', 'App\Http\Controllers\TodoController@destroy')
    ->name('remove.task');
Route::delete('/remove/all', 'App\Http\Controllers\TodoController@destroyAll')
    ->name('remove.task.all');