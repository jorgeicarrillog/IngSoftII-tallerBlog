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
Route::get('posts/editar/{id}','PostController@edit')->name('posts.edit')->middleware('auth');
Route::put('posts/editar/{id}','PostController@update')->name('posts.update')->middleware('auth');
Route::delete('posts/eliminar/{id}','PostController@destroy')->name('posts.destroy')->middleware('auth');
Route::get('posts/{url}', 'PostController@show')->name('posts.show');


Route::resource('categorie', 'CategorieController',['except' => ['show']])->middleware('auth');
Route::get('categorie/editar/{id}','CategorieController@edit')->name('categorie.edit')->middleware('auth');
Route::put('categorie/editar/{id}','CategorieController@update')->name('categorie.update')->middleware('auth');
Route::delete('categorie/eliminar/{id}','CategorieController@destroy')->name('categorie.destroy')->middleware('auth');
