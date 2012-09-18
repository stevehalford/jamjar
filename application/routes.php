<?php

// client Resource
Route::get('clients', array( 'as' => 'clients', 'uses' => 'clients@index'));
Route::get('clients/(:any)', array( 'as' => 'client', 'uses' => 'clients@show'));
Route::get('clients/new', array( 'as' => 'new_client', 'uses' => 'clients@new'));
Route::get('clients/(:any)/edit', array( 'as' => 'edit_client', 'uses' => 'clients@edit'));
Route::get('clients/(:any)/projects', array( 'as' => 'client_projects', 'uses' => 'clients@client_projects'));
Route::post('clients', 'clients@create');
Route::put('clients/(:any)', 'clients@update');
Route::delete('clients/(:any)', 'clients@destroy');

// project Resource
Route::get('projects', array( 'as' => 'projects', 'uses' => 'projects@index'));
Route::get('projects/(:any)', array( 'as' => 'project', 'uses' => 'projects@show'));
Route::get('projects/new', array( 'as' => 'new_project', 'uses' => 'projects@new'));
Route::get('projects/(:any)/edit', array( 'as' => 'edit_project', 'uses' => 'projects@edit'));
Route::post('projects', 'projects@create');
Route::put('projects/(:any)', 'projects@update');
Route::delete('projects/(:any)', 'projects@destroy');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

/*
Route::get('/', function()
{
    return View::make('home.index');
});
*/

Route::controller(Controller::detect());

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});