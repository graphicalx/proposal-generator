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

Route::get('/', 'GeneratorController@viewHome')->name('home');
Route::post('/section/{section}/piece/add', 'PieceController@addAjax')->name('addPiece');
Route::post('/piece/{piece}/remove', 'PieceController@removeAjax')->name('removePiece');

Route::get('/test', function() {
    dd(\App\Section::with('pieces')->get());
});
