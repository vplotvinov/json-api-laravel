<?php

use Illuminate\Support\Facades\Auth;

//Auth::routes();

Route::group([
    'namespace' => 'Auth',
    'prefix'    => 'oauth',
], function () {
    Route::post('register', 'AuthController@manualRegistration')->name('register');
    Route::post('login', 'AuthController@loginUser')->name('login');
    Route::post('logout', 'AuthController@logoutUser')->middleware('auth:api');

    Route::get('google/signin', 'SocialAuthGoogleController@redirect');
    Route::get('google/signin/callback', 'SocialAuthGoogleController@callback');
    Route::get('google/signup', 'SocialAuthGoogleController@redirectRegister');
});
