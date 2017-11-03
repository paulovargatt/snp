<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home')->middleware();


});

Route::get('/sair', 'HomeController@sair')->name('sair');

