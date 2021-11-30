<?php


Route::post('/audio/process', ['as' => 'process', 'uses' => 'MSCCS\CallController@processAudio']);
