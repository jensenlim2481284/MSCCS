<?php 


    # Analysis route 
    Route::get('/analysis', ['as' => 'analysis.index', 'uses' => 'AnalysisController@index']);