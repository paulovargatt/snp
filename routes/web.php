<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/sair', 'HomeController@sair')->name('sair');

    Route::get('/content/{id}', 'HomeController@content')->name('content');
    Route::post('/update-content/{id}', 'HomeController@update')->name('update-content');

    Route::post('/new-snip', 'HomeController@newSnip')->name('newSnip');
});



