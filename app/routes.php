<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', 'UsersController@getLogin');
Route::post('/login', 'UsersController@postSignin');

Route::get('/register', 'UsersController@getRegister');
Route::post('/register', 'UsersController@postCreate');

Route::get('/logout', 'UsersController@getLogout');

Route::get('/home', 'UsersController@getHome');
Route::post('/home', 'UsersController@postHome');
Route::get('/home/{folderId}-{folderName}', 'UsersController@getFolder');

Route::post('/upload/{folderId}', 'UploadController@postUploads');
Route::get('/upload', function(){ return "use POST"; });

Route::get('/settings', 'UsersController@getSettings');

Route::post('/json/login', 'JSONController@postSignin');
Route::get('/json/login', function(){ return View::make('jsonLogin'); });

Route::get('/', function(){ return View::make('hello'); });