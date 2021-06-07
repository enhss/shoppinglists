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

Route::get('/', 'ShoppinglistsController@index');


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::get('boughts', 'UsersController@boughts')->name('users.boughts');
        Route::get('stays', 'UsersController@stays')->name('users.stays');
    });
    
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    
    Route::group(['prefix' => 'shoppinglists/{id}'], function () {
        Route::post('bought', 'BoughtsController@store')->name('boughts.bought');
        Route::delete('notbought', 'BoughtsController@destroy')->name('boughts.notbought');
        Route::post('stay', 'StaysController@store')->name('stays.stay');
        Route::delete('notstay', 'StaysController@destroy')->name('stays.notstay');
    });
    
    Route::resource('shoppinglists', 'ShoppinglistsController', ['only' => ['store', 'destroy']]);
});