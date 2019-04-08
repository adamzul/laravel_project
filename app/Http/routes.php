<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::get('/task', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::post('/task/get_data', 'TaskController@getData');
Route::get('/task/edit/{id}', 'TaskController@edit');
Route::delete('/task/{task}', function (Task $task) {
    //
    $task->delete();

    return redirect('/');
});