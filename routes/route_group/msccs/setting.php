<?php

    # Setting route 
    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'namespace' => 'Setting'], function () {

        Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
        Route::get('/api', ['as' => 'api', 'uses' => 'IndexController@api']);
          
        # General setting group
        Route::group(['prefix' => 'general', 'as' => 'general.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'GeneralController@index']);
            Route::post('/keyword/delete', ['as' => 'keyword.delete', 'uses' => 'GeneralController@deleteKeyword']);
            Route::post('/keyword/create', ['as' => 'keyword.create', 'uses' => 'GeneralController@createKeyword']);
        });

        # Embed page group
        Route::group(['prefix' => 'embed', 'as' => 'embed.'], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'EmbedController@index']);
            Route::post('/whitelist/update', ['as' => 'whitelist.update', 'uses' => 'EmbedController@updateWhitelist']);
        });
          
    });
