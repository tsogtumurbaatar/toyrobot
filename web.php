<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/




Route::get('/toyrobot', function () { return view('toyrobot'); });
Route::post('/api/toyrobot', 'toyRobotController@pushText');
Route::post('/api/toyrobotsession', 'toyRobotController@deleteSession');
Route::get('/toyrobotfileupload', function () { return view('toyrobot'); });
Route::post('/toyrobotfileupload','toyRobotController@fileupload');


Route::get('/home', 'HomeController@index');
