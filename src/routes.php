<?php

Route::group(['middleware' => 'web'], function(){
    Route::resource('products', '\GlebStarProducts\Controllers\ProductController');
});
