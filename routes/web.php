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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){

    /*//Tasks routes
    Route::get('/tasks', 'TaskController@index')->name('tasks');
    Route::post('/tasks', 'TaskController@create')->name('post-task');
    //end Tasks routes
*/
    //Comments routes
    Route::get('/tasks/{task}/comments', 'CommentController@index')->name('comments');
    Route::post('/tasks/{task}/comments', 'CommentController@store');
    //end Comments routes

    Route::resource('tasks', 'TaskController')->only([
        'index', 'store'
    ]);

});
