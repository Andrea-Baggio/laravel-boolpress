<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Schema\PostgresBuilder;

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

// Route::get('/', function () {
//     return view('guest.home');
// })->name('home');

Auth::routes();

// Route::get('/home', 'Admin\HomeController@index')->name('admin.home');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'PageController@dashboard')->name('dashboard');
        Route::resource('posts', 'PostController');
        Route::get('/categories/slug', 'CategoryController@slug')->name('categories.slug');
        Route::resource('categories', 'CategoryController');
        Route::resource('tags', 'TagController');
});



// La rotta che segue è la modificha necessaria affinché il mode: 'history' (guarda front.js, alla personalizzazione del vue-router) possa funzionare

Route::get('{any?}', function () {
    return view('guest.home');
})->where("any", ".*")->name('guest.home');
