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

Route::group(['as' => 'default::'], function() {
	Route::get('/', ['as' => 'home', 'uses' =>'HomeController@index']);
	Route::get('/home', ['uses' =>'HomeController@index']);
	Route::get('/reviews', ['as' => 'reviewOverview', 'uses' =>'HomeController@reviewOverview']);
	Route::get('/shows', ['as' => 'showOverview', 'uses' => 'HomeController@showOverview']);
	Route::get('/shows/{id}', ['as' => 'showDetail', 'uses' => 'HomeController@showDetail']);
	Route::get('/shows/{id}/reviews', ['as' => 'reviewOverviewShow', 'uses' => 'HomeController@reviewOverviewShow']);
	Route::get('/users/{id}/reviews', ['as' => 'reviewOverviewUser', 'uses' => 'HomeController@reviewOverviewUser']);
	Route::get('/reviews/{id}', ['as' => 'reviewDetail', 'uses' => 'HomeController@reviewDetail']);
	Route::get('/users', ['as' => 'userOverview', 'uses' => 'HomeController@userOverview']);
	Route::get('/users/{id}', ['as' => 'userDetail', 'uses' => 'HomeController@userDetail']);
	Route::get('/search', ['as' => 'search', 'uses' => 'HomeController@showOverview']);
	Route::get('/password/reset', ['as' => 'passwordreset', 'uses' => 'Auth\PasswordController@getEmail']);
	Route::post('/password/reset', ['as' => 'passwordresetpost', 'uses' => 'Auth\PasswordController@postEmail']);
});
Route::group(['as' => 'user::', 'middleware' => 'auth'], function() {
	Route::get('/shows/{id}/reviews/add', ['as' => 'addreview', 'uses' => 'UserController@addReview']);
    Route::post('/shows/{id}/reviews/add', ['as' => 'addreviewpost', 'uses' => 'UserController@storeReview']);
    Route::get('/reviews/{id}/edit', ['as' => 'editreview', 'uses' => 'UserController@editReview']);
    Route::post('/reviews/{id}/edit', ['as' => 'editreview', 'uses' => 'UserController@updateReview']);
    Route::post('/reviews/{id}/delete', ['as' => 'deletereview', 'uses' => 'UserController@deleteReview']);
    Route::get('/show/choose', ['as' => 'chooseShow', 'uses' => 'UserController@chooseShow']);
    Route::post('/show/choose', ['as' => 'chooseShowPost', 'uses' => 'UserController@chooseShowPost']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'UserController@dashboard']);
    Route::post('/reviews/{id}/vote', ['as' => 'vote', 'uses' => 'UserController@vote']);
    Route::get('/users/{id}/edit', ['as' => 'editprofile', 'uses' => 'UserController@editUser']);
    Route::post('/users/{id}/edit', ['as' => 'editprofilepost', 'uses' => 'UserController@updateUser']);
});
Route::auth();
