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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/settings', 'UserController@edit');

Route::resource('user', 'UserController', ['only' => [
    'edit', 'update', 'destroy'
]]);

Route::get('/backend', 'Backend\BackendController@index');

/*
 * Route Backend
 */
Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'admin']], function () {

	Route::get('server/{providerId}/datacenter', ['as' => 'server.get.datacenter', 'uses' => 'Backend\ServerBackendController@getDatacenter']);

	Route::resource('provider', 'Backend\ProviderBackendController');
	Route::resource('server', 'Backend\ServerBackendController');
	Route::resource('datacenter', 'Backend\DatacenterBackendController');
	Route::resource('country', 'Backend\CountryBackendController');
});

