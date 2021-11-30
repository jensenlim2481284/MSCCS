<?php

use Illuminate\Support\Facades\Route;


# APP Route group namespace
Route::group(['namespace' => 'App'], function () {

    # Login Route
    Route::group(['prefix' => 'login' , 'as' => 'login.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'LoginController@index']);
        Route::post('/', ['as' => 'submit', 'uses' => 'LoginController@login']);
    });


    # Authenticated Route 
    Route::group(['middleware' => ['auth']], function () {

        # Dashboard Page    
        Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

        # App Page    
        Route::get('/app', ['as' => 'app', 'uses' => 'IndexController@app']);

    });


});