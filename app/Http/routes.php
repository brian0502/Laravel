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
Route::get('/','HomeController@index');

Route::group(['prefix'=>'home'], function(){
	Route::get('/', 'HomeController@index');
	Route::get('index', 'HomeController@index');
	Route::get('signup', 'HomeController@signup');
	Route::get('login', 'HomeController@login');
	Route::get('logout', 'HomeController@logout');
	Route::get('movie', 'HomeController@movie');
	Route::get('project', 'HomeController@project');
	Route::get('note', 'HomeController@note');
	Route::get('note_info/{note_id}', 'HomeController@note');
	Route::get('add_note', 'HomeController@add_note');
	//Route::get('{title}/{message}', 'HomeController@show');
	Route::post('do_signup', 'HomeController@do_signup'); //若有form表單時使用
	Route::post('do_login', 'HomeController@do_login'); //若有form表單時使用
	Route::post('do_add_note', 'HomeController@do_add_note'); //若有form表單時使用
	// Route::get('{id}/edit', 'HomeController@edit');
    // Route::put('{id}', 'HomeController@update');
    // Route::delete('{id}', 'HomeController@destroy');
});

Route::get('test',function(){
	return View('test.test');
});

//Route::resource('home', 'HomeController');

