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

Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'PostController@index')->name('home');
Route::resource('posts', 'PostController',['except' => ['index','show']])->middleware('auth');
Route::get('posts/{url}', 'PostController@show')->name('posts.show');


