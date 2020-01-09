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
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('item/create', 'Admin\ItemController@add');
    Route::post('item/create', 'Admin\ItemController@create');
    Route::get('item', 'Admin\ItemController@index');
    Route::get('item/edit', 'Admin\ItemController@edit');
    Route::post('item/edit', 'Admin\ItemController@update');
    Route::get('item/delete', 'Admin\ItemController@delete');
    Route::get('edit', 'Auth\EditController@edit');
    Route::post('edit', 'Auth\EditController@update');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('top');
});