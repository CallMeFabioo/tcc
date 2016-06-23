<?php

Route::group(['prefix' => 'api/v1', 'namespace' => 'Api'], function() {

	Route::post('/auth/register', ['as' => 'auth.register', 'uses' => 'AuthController@register']);
	Route::post('/auth/login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);
	Route::post('/auth/logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout'])->middleware('jwt.auth');

	Route::group(['middleware' => 'jwt.auth'], function() {

		Route::get('users/me', 'UsersController@me');

		Route::match(['get', 'post'], 'users/followers', 'UsersController@followers');

		Route::get('users/following', 'UsersController@following');
		Route::get('users/favorites', 'UsersController@favorites');

		Route::resource('users', 'UsersController', ['only' => [ 'index', 'show' ]]);

		Route::resource('medias', 'PostsController', ['only' => [ 'index', 'show' ]]);

		Route::get('medias/{uid}/likes', 'LikesController@likes');
		Route::post('medias/{uid}/likes', 'LikesController@like');
		Route::delete('medias/{uid}/likes', 'LikesController@unlike');

		Route::get('medias/{uid}/comments', 'LikesController@comments');
		Route::post('medias/{uid}/comments', 'LikesController@comment');
		Route::delete('medias/{uid}/comments', 'LikesController@uncomment');

	});

});

// Catch All Routes
Route::get('/{vue?}', function() {
  return view('app');
})->where('vue', '[\/\w\.-]*');
