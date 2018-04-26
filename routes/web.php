<?php

Route::group(['middleware' => ['auth'],'namespace'=>'Admin','prefix'=>'admin'],function(){
    Route::post('deposit','BalanceController@depositStore')->name('deposit.store');
    Route::get('deposit','BalanceController@deposit')->name('balance.deposit');
    Route::get('balance','BalanceController@index')->name('admin.balance');


    Route::get('/','AdminController@index')->name('admin.home');

});


Route::get('/','site\SiteController@index')->name('home');



Auth::routes();


