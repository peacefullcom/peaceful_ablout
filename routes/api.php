<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'vote'
], function ($router) {
    Route::middleware('throttle:60,1')->get('vote', 'App\Http\Controllers\VoteAPI\VoteController@getVote');
    Route::get('player', 'App\Http\Controllers\VoteAPI\VoteController@getPlayerList');
    Route::get('player/{code}', 'App\Http\Controllers\VoteAPI\VoteController@getPlayerByCode');
    Route::get('rank', 'App\Http\Controllers\VoteAPI\VoteController@getRank');
    //Route::get('sendSms', 'App\Http\Controllers\VoteAPI\VoteController@sendSms');
    Route::post('phoneVerification', 'App\Http\Controllers\VoteAPI\VoteController@phoneVerification');
    Route::post('phoneVerificationCheck', 'App\Http\Controllers\VoteAPI\VoteController@phoneVerificationCheck');
    Route::get('limitAccessTest', 'App\Http\Controllers\VoteAPI\VoteController@limitAccessTest');
});

Route::group([
    'prefix' => 'company'
], function ($router) {
    Route::get('artical', 'App\Http\Controllers\CompanyAPI\ArticalController@getArticalList');
    Route::get('artical/{id}', 'App\Http\Controllers\CompanyAPI\ArticalController@getArticalById');
});