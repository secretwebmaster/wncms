<?php

//! Update Core

use App\Http\Controllers\Api\V1\CustomUpdateController;

Route::prefix('v1')->name('api.v1.')->group(function(){
    Route::get('test', function(){
        return view('test.test1');
    });
});