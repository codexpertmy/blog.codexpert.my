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

Route::get('/blog', function () {
    return view('blog');
});

Auth::routes();

Route::get('/', 'PostController@index')->name('post.index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('article/{hash_id}/{slug}', 'PostController@show')->name('post.show');
Route::get('blog/create', 'HomeController@create')->name('post.manage.create');
Route::get('blog/{hash_id}/edit', 'HomeController@edit')->name('post.manage.edit');
Route::put('blog/{hash_id}/update', 'HomeController@update')->name('post.manage.update');
Route::post('blog/create', 'HomeController@store')->name('post.manage.store');
Route::get('blog/{hash_id}/delete', 'HomeController@delete')->name('post.manage.delete');

Route::get('category/{category}/related', 'PostController@byCategory')->name('post.related');
