<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'user'],function (){
    Route::get('/user', 'HomeController@index')->name('user');

});
Route::group(['middleware'=>'admin'],function (){
    Route::get('/admin', 'AdminController@index')->name('admin');
});

