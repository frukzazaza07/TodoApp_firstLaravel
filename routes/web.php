<?php
date_default_timezone_set('Asia/Bangkok');

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('todo/select_todo', 'App\Http\Controllers\TodoController@index')->middleware('auth');
Route::get('todo/insert_todo', 'App\Http\Controllers\TodoController@create')->middleware('auth');
Route::get('/todo/complete/{id}/{todo_topic}', 'App\Http\Controllers\TodoController@update');
// Route::get('/todo/insert_todo', 'App\Http\Controllers\TodoController@select_notify');
Route::get('/todo/delete/{id}/{todo_topic}', 'App\Http\Controllers\TodoController@destroy');
//->name('contract.destroy')
Route::resource('todo', 'App\Http\Controllers\TodoController')->middleware('auth');
