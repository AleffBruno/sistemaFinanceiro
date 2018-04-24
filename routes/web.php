<?php

Route::group(['middleware' => ['auth'],'namespace'=>'Admin'],function(){
    Route::get('admin','AdminController@index')->name('admin.home');
});


Route::get('/','site\SiteController@index')->name('home');



Auth::routes();


