<?php

# MSCCS route group
Route::group(['namespace' => 'MSCCS', 'middleware' => ['auth.process']], function () {

    # Logout 
    Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LogoutController@logout']);

    # Dashboard Page
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

    # Profile Page
    Route::get('/profile', ['as' => 'profile', 'uses' => 'AccountController@index']);

    # Embed route 
    require base_path('routes/route_group/msccs/embed.php');

    # Setting route 
    require base_path('routes/route_group/msccs/setting.php');

    # Customer route 
    require base_path('routes/route_group/msccs/customer.php');

    # Call Center route 
    require base_path('routes/route_group/msccs/call.php');

    # Report & Analysis route 
    require base_path('routes/route_group/msccs/analysis.php');

});