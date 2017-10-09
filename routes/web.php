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

Route::group(['prefix'=>'users'],function(){

});

Route::group(['prefix'=>'questions'],function(){
	Route::get('/index','QuestionController@index');
	Route::get('/show/{id}','QuestionController@show');
	Route::get('/create','QuestionController@create');
	Route::post('/store','QuestionController@store');
	Route::post('/update','QuestionController@update');
	Route::post('/delete','QuestionController@destroy');
	Route::post('/vote','QuestionController@vote');
	Route::post('/resolve','QuestionController@resolve');
	Route::post('/request-answer','QuestionController@requestAnswer');

	Route::group(['prefix' => 'answers'],function(){
		Route::get('index/{question_id}','AnswerController@index');
		Route::post('/store','AnswerController@store');
		Route::post('/update','AnswerController@update');
		Route::post('/delete','AnswerController@destroy');
		Route::post('/vote','AnswerController@vote');
		Route::post('/best','AnswerController@setBest');

		Route::group(['prefix' => 'comments'],function(){
			Route::post('/store','AnswerController@addComment');
			Route::post('/update','AnswerController@updateComment');
			Route::post('/delete','AnswerController@deleteComment');
			Route::post('/vote','AnswerController@voteComment');

		});
	});
});

Route::group(['prefix'=>'tests'],function(){

});
