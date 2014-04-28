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

Route::get('/home/{projectId}-{projectName}', 'UsersController@getProject');
Route::post('/home/{projectId}-{projectName}', 'UsersController@postProject');

Route::get('/home/{projectId}-{projectName}/tests', 'UsersController@getProjectTests');
Route::post('/home/{projectId}-{projectName}/tests', 'UsersController@postProjectTests');

Route::get('/home/{projectId}-{projectName}/test/{testId}', array(
    'as'=>'getTest',
    'uses'=>'UsersController@getTest'
));
Route::post('/home/{projectId}-{projectName}/test/{testId}', array(
    'as'=>'postTest', 
    'uses'=>'UsersController@postTest'
));

Route::get('/home/{projectId}-{projectName}/proctor/{proctorId}', array(
    'as'=>'getProctor',
    'uses'=>'UsersController@getProctor'
));
Route::post('/home/{projectId}-{projectName}/proctor/{proctorId}', array(
    'as'=>'postProctor', 
    'uses'=>'UsersController@postProctor'
));

Route::get('/home/{projectId}-{projectName}/files', 'UsersController@getProjectFiles');

Route::post('/upload/{folderId}', 'UploadController@postUploads');
Route::get('/upload', function(){ return "use POST"; });

Route::get('/settings', 'UsersController@getSettings');
Route::post('/settings', 'UsersController@postSettings');

Route::post('/json/login', 'JSONController@postSignin');
Route::get('/json/login', function(){ return View::make('jsonLogin'); });

Route::post('/editable', 'UsersController@postEditable');

Route::get('/', function(){ return View::make('hello'); });