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
})->name('top');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::get('/home', 'HomeController@index')->name('home');
        // マイページ編集
        Route::get('/edit-profile', 'ProfileController@showProfileEditForm')->name('edit-profile');
    });
});

// コンビニ
Route::namespace('Conveniencestore')->prefix('conveniencestore')->name('conveniencestore.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:conveniencestore')->group(function () {

        // TOPページ
        Route::get('/home', 'HomeController@index')->name('home');
    });
});
