<?php

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
Route::controller(array('company', 'geocode', 'client', 'home'));
Route::get('/', array('before' => 'auth'));

if(!Request::cli())
{
	/**
	 * Routes principales
	 * 
	 */
	Route::any('admin/list', array('as' => 'marker_list', 'uses' => 'home@marker', 'before' => 'auth') );
	Route::any('client/listing', array('before' => 'auth', 'uses' => 'client@listing', 'before' => 'auth') );
	Route::any('client/new_client', array('before' => 'auth', 'uses'=>'client@new_client', 'before' => 'auth'));
	Route::any('new', array('as' => 'new_marker', 'uses' => 'home@new_marker', 'before' => 'auth') );
	Route::any('edit/marker/(:any)', array('as' => 'edit_marker', 'uses' => 'home@edit_marker', 'before' => 'auth') );
	Route::any('geocode/index', array('uses' => 'geocode@index', 'before' => 'auth'));

	if ( Auth::check() )
	{
		Route::any( strtolower(Auth::user()->username) .'/list', array('as' => 'client_marker_list', 'uses' => 'home@marker') );
		Route::any( strtolower(Auth::user()->username) .'/new', array('as' => 'client_new_marker', 'uses' => 'home@new_marker') );
		Route::any( strtolower(Auth::user()->username) .'/edit/marker/(:any)', array('as' => 'client_edit_marker', 'uses' => 'home@edit_marker') );
	}
	/**
	 * Routes pour les clients
	 * 
	 */

	// Route pour Bulmann
	Route::any('buhlmann', array('as' => 'buhlmann', 'uses' => 'company@index', 'before' => 'client') );

	// Route pour Lemmens
	Route::any('lemmens', array('as' => 'lemmens', 'uses' => 'company@index', 'before' => 'client') );

	// Route pour testing
	Route::any('testing', array('as' => 'testing', 'uses' => 'company@index', 'before' => 'client') );

	Route::any('testuser2', array('as' => 'testuser2', 'uses' => 'company@index', 'before' => 'client') );


	/**
	 * Login routes
	 * 
	 */
	Route::get('login', function()
	{
		return View::make('login');
	});

	Route::post('login', function()
	{
		$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);
		if ( Auth::attempt($userdata) )
		{
			// logged in
			if ( Auth::user()->group == 1 )
				return Redirect::to_route('dashboard');
			else
				return Redirect::to_route( strtolower(Auth::user()->username) );
		}
		else
		{
			return Redirect::to('login')
				->with('login_errors', true);
		}
	});

	Route::get('logout', function()
	{
		Auth::logout();
		return Redirect::to('login');
	});

	Route::get('dashboard', array('as' => 'dashboard', 'do' => function()
	{
	    return View::make('home.index');
	}));
}


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
	if (Auth::guest())
	{
		return Redirect::to('login');	
	}
	else
	{
		if ( !Auth::user()->group === 1 ) return Redirect::to('login');
	}
});
Route::filter('client', function()
{
	if ( Auth::check() )
	{
		if ( !Auth::user()->group == 2 ) return Redirect::to('login');	
	}
	else
	{
		return Redirect::to('login');
	}
	
});
