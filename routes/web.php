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
    return redirect('/task');
});

//Taches

Route::get('/task', 'TaskController@show');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{id}', 'TaskController@delete');
Route::put('/task/{id}', 'TaskController@update');

//Listes

Route::get('/list/{id}', 'ListTaskController@show');
Route::post('/list', 'ListTaskController@store');
Route::delete('/list/{id}', 'ListTaskController@delete');
