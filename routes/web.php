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
Route::get('/test', function () {
	return response()->json(Auth::user()->getAllPermissions());
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//USER ROUTES
Route::group(['prefix'=>'users'],function(){
	
	Route::get('/index','UserController@index');
	Route::get('/profile/{id}','UserController@show');
	Route::get('/active/{id}','UserController@actives');
	Route::get('/setting/{id}','UserController@settings');
	Route::post('profile/edit','UserController@updateProfile');
	Route::post('setting/edit','UserController@udpateSettings');

});

//ADMIN ROUTES
Route::group(['prefix' => 'admin','middleware'=>'AdminMiddleware'],function(){
	Route::get('/', 'Auth\AdminLoginController@index');
	Route::group(['prefix' => '/'], function() {
	    Route::get('login', 'Auth\AdminLoginController@index');
	    Route::post('login', 'Auth\AdminLoginController@login');
	    Route::get('logout', 'Auth\AdminLoginController@logout');
	    Route::get('home', 'HomeAdminController@index');
	});
	Route::group(['prefix' => 'users'],function(){
		Route::get('/','UserController@adminIndex');
		Route::get('/{id}','UserController@adminShow');
		Route::get('/setting/{id}','UserController@adminSettings');
		Route::get('/create','UserController@adminCreate');

		Route::post('/create','UserController@adminStore');
		Route::post('/edit','UserController@adminUpdate');
		Route::post('/delete','UserController@adminDestroy');
		Route::post('/ban','UserController@adminBan');

	});

	Route::group(['prefix' => 'categories'],function(){
		Route::get('/','CategoryController@index');
		Route::post('/create','CategoryController@store');
		Route::post('/show/{id}','CategoryController@update');
		Route::delete('/delete/{id}','CategoryController@destroy');
		Route::group(['prefix' => 'api'], function() {
		    Route::get('listall', 'CategoryController@listAll');
		});
	});

	Route::group(['prefix' => 'roles'],function(){

		Route::get('/','RoleController@index');
		Route::get('/show/{id}','RoleController@show');
		Route::get('/create','RoleController@create');		Route::group(['prefix' => 'admin'], function() {
		    //
		});
		Route::post('/create','RoleController@store');
		Route::post('/edit','RoleController@update');
		Route::post('/delete','RoleController@destroy');

	});

	Route::group(['prefix' => 'permission'],function(){

		Route::get('/','PermissionController@index');
		Route::get('/show/{id}','PermissionController@show');

		Route::post('/create','PermissionController@store');
		Route::post('/edit','PermissionController@update');
		Route::post('/delete','PermissionController@destroy');

	});

	Route::group(['prefix' => 'tags'],function(){

		Route::get('/','TagController@index');
		Route::get('/show/{id}','TagController@show');

		Route::post('/create','TagController@store');
		Route::post('/edit','TagController@update');
		Route::post('/delete','TagController@destroy');

	});
});

//QUESTION ROUTES
Route::group(['prefix'=>'questions'],function(){
	Route::get('/index','QuestionController@index');
	Route::get('/show/{id}','QuestionController@show');
	Route::get('/create','QuestionController@create');
	Route::post('/store','QuestionController@store');
	Route::post('/edit','QuestionController@update');
	Route::post('/delete','QuestionController@destroy');
	Route::post('/vote','QuestionController@vote');
	Route::post('/resolve','QuestionController@resolve');
	Route::post('/request-answer','QuestionController@requestAnswer');

	Route::group(['prefix' => 'answers'],function(){
		Route::get('index/{question_id}','AnswerController@index');
		Route::post('/store','AnswerController@store');
		Route::post('/edit','AnswerController@update');
		Route::post('/delete','AnswerController@destroy');
		Route::post('/vote','AnswerController@vote');
		Route::post('/best','AnswerController@setBest');

		Route::group(['prefix' => 'comments'],function(){
			Route::post('/store','AnswerController@addComment');
			Route::post('/edit','AnswerController@updateComment');
			Route::post('/delete','AnswerController@deleteComment');
			Route::post('/vote','AnswerController@voteComment');

		});
	});
});


//TEST ROUTES
Route::group(['prefix'=>'tests'],function(){

});
