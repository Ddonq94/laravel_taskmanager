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
    return redirect('/tasks');
});



Route::resource('tasks','App\Http\Controllers\TasksController');

Route::get('taskfilter/{project}', 'App\Http\Controllers\TasksController@getByProject');

Route::put('taskdrag/{id}', 'App\Http\Controllers\TasksController@updateByDrag');