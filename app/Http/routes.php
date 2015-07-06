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
// Provide controller methods with object instead of ID
Route::model('tasks', 'Task');
Route::model('projects', 'Project');


Route::get('/', 'MyController@index');
Route::get('/home', 'MyController@woef');

Route::resource('projects', 'ProjectsController');
Route::resource('beers', 'BeersController');
//Route::resource('tasks', 'TasksController');
Route::resource('projects.tasks', 'TasksController');

//Route::get('home', 'HomeController@index');

// Use slugs rather than IDs in URLs
Route::bind('tasks', function($value, $route) {
	return App\Task::whereSlug($value)->first();
});
Route::bind('projects', function($value, $route) {
	return App\Project::whereSlug($value)->first();
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
