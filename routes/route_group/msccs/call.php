<?php

    # Call Management route 
    Route::group(['prefix' => 'call', 'as' => 'call.'], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'CallController@index']);
        Route::get('/{id}', ['as' => 'view', 'uses' => 'CallController@view']);
        Route::get('/status/get', ['as' => 'status', 'uses' => 'CallController@getTicketStatus']);
        Route::post('/update', ['as' => 'update', 'uses' => 'CallController@update']);
        Route::post('/upload', ['as' => 'upload', 'uses' => 'CallController@upload']);
        Route::post('/delete', ['as' => 'delete', 'uses' => 'CallController@delete']);
        
    });
