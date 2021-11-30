<?php

    # Embed route 
    Route::group(['prefix' => 'embed', 'as' => 'embed.', 'namespace' => 'Setting'], function () {

        Route::get('/{type}', ['as' => 'display', 'uses' => 'EmbedController@displayEmbed']);
          
    });
