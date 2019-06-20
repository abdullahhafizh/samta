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

Route::get('/', 'HomeController@test')->name('home');
// Route::get('test', 'HomeController@test')->name('test');
Route::get('split', 'HomeController@split')->name('split');
Route::post('save', 'HomeController@save')->name('save');
Route::post('answer', 'HomeController@answer')->name('answer');
Route::get('answer', 'HomeController@answer')->name('answer');
Route::get('api/{id}', 'HomeController@kbbi')->name('kbbi');
Route::get('kbbi', 'HomeController@recheck')->name('recheck');

Auth::routes();
