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
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');

Route::post('/post/create','PostsController@create');

Route::get('/profile','UsersController@profile');

Route::post('/update','UsersController@update');

Route::get('/search','UsersController@search')->name('search');
Route::post('/search_result','UsersController@search_result')->name('search_result');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

Route::get('/logout', 'UsersController@sugasouri');

// ログイン中
Route::group(['middleware' => 'auth'], function() {

// ユーザ関連
Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);


// つぶやく
Route::resource('tweets', 'TweetsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);

Route::resource('comments', 'CommentsController', ['only' => ['store']]);
});

Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);


Route::get('post/{id?}/delete','PostsController@delete');

// フォローｏｒフォロー解除
Route::get('users/{id}/follow', 'FollowsController@following')->name('follow');
Route::get('users/{id}/unfollow', 'FollowsController@unfollowing')->name('unfollow');
