<?php 

    # Customer Management route 
    Route::group(['prefix' => 'customer' , 'as' => 'customer.'], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'CustomerController@index']);
        Route::get('/{uid}', ['as' => 'view', 'uses' => 'CustomerController@view']);
        
    });