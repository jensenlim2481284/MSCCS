<?php

    # Call Management route 
    Route::group(['prefix' => 'call', 'as' => 'call.'], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'CallController@index']);
        Route::get('/{id}', ['as' => 'view', 'uses' => 'CallController@view']);
    });
