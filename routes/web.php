<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PageController@posts')->name('posts.all');
Route::get('blog/{slug}', 'PageController@post')->name('posts.single');

Auth::routes();

Route::resource('posts', 'Backend\PostController')
    ->middleware('auth')
    ->except('show');

Route::get('/home', 'HomeController@index')->name('home');
