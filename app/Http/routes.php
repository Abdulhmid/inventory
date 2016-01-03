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

Route::controller('auth', 'Auth\AuthController');

Route::group(['middleware' => 'auth'], function() {
	Route::controller('/suppliers', 'Suppliers');
	Route::controller('/items-category', 'ItemsCategory');
	Route::controller('/items', 'Items');
	Route::controller('/groups', 'Groups');
	Route::controller('/users', 'Users');
	Route::controller('/buying', 'Buying');
	Route::controller('/selling', 'Selling');
	Route::controller('/return', 'ReturnItems');
	Route::controller('/', 'Dashboard');
});
