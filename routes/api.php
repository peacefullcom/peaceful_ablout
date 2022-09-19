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
    

    
});
