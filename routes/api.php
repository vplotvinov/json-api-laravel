<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use CloudCreativity\LaravelJsonApi\Routing\RouteRegistrar as Api;

//Route::macro('module', function ($slug, $className) {
//    Route::get($slug, "$className@getAll");
//    Route::get("$slug/{ids}", "$className@getByIds");
//    Route::post($slug, "$className@store");
//    Route::put($slug, "$className@update");
//    Route::delete("$slug/{ids}", "$className@delete");
//});


Route::group([
    'prefix' => 'backend',
], function () {
    Route::post('/feedback', 'FeedbackController@store');
});

JsonApi::register('v1')
       ->withNamespace('Api')
       ->middleware('auth:api')
       ->routes(function (Api $api) {
           $api->resource('users')->relationships(function ($relations) {
               $relations->hasOne('role');
           })->except('create', 'delete');

           $api->resource('entities')->controller()->relationships(function ($relations) {
               $relations->hasOne('author', 'users');
               $relations->hasMany('comments');
           });

           $api->resource('comments')->relationships(function ($relations) {
               $relations->hasOne('entity');
               $relations->hasOne('author', 'users');
           });

           $api->resource('user-roles')->readOnly();
           $api->resource('subscription-actions')->readOnly();
           $api->resource('subscription-channels')->readOnly();

           $api->resource('subscriptions')->except('index', 'read');
       });
