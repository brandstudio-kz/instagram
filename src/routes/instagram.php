<?php

Route::group([
    'prefix'    => config('instagram.prefix'),
    'namespace' => 'BrandStudio\Instagram\Http\Controllers',
    'middleware' => config('instagram.middleware')
], function() {

    Route::get('posts', 'InstagramController@posts');
    Route::get('followers', 'InstagramController@followers');
    Route::get('account', 'InstagramController@account');

});
