<?php 

    # Customer Management route 
    Route::group(['prefix' => 'customer' , 'as' => 'customer.'], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'CustomerController@index']);
        Route::get('/{uid}', ['as' => 'view', 'uses' => 'CustomerController@view']);
        Route::post('/bind', ['as' => 'bind', 'uses' => 'CustomerController@bind']);
        Route::post('/delete', ['as' => 'delete', 'uses' => 'CustomerController@delete']);
        Route::post('/update', ['as' => 'update', 'uses' => 'CustomerController@updateOrCreate']);
        
    });