<?php

use Illuminate\Support\Facades\Route;

# Landing Page
Route::get('/', ['as' => 'index', 'uses' => 'Website\IndexController@index']);
