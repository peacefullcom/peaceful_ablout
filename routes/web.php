<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'App\Http\Controllers\Frontend\FrontEndController@index');

Route::group(['prefix' => 'backend'], function () {
    Route::get('/', 'App\Http\Controllers\Backend\BackEndController@index');
    Route::any('/login', 'App\Http\Controllers\Backend\BackEndController@login')->name('login');
    
    Route::middleware(['admin.auth'])->group(function () {
        //个人登录 密码修改
        Route::any('/home', 'App\Http\Controllers\Backend\HomeController@index')->name('home');
        Route::any('/logout', 'App\Http\Controllers\Backend\HomeController@logout')->name('logout');
        Route::any('/change-profile','App\Http\Controllers\Backend\HomeController@changeProfile');
        Route::any('/change-password','App\Http\Controllers\Backend\HomeController@changePassword');
        //文章分类
        Route::any('/article-category','App\Http\Controllers\Backend\ArticleCategoryController@index')->name('article-category');
        Route::any('/article-category/create','App\Http\Controllers\Backend\ArticleCategoryController@create');
        Route::any('/article-category/edit/{id}','App\Http\Controllers\Backend\ArticleCategoryController@edit');
        Route::any('/article-category/delete/{id}','App\Http\Controllers\Backend\ArticleCategoryController@delete');

        //传媒文章分类
        Route::any('/media-article-category','App\Http\Controllers\Backend\MediaArticleCategoryController@index')->name('article-category');
        Route::any('/media-article-category/create','App\Http\Controllers\Backend\MediaArticleCategoryController@create');
        Route::any('/media-article-category/edit/{id}','App\Http\Controllers\Backend\MediaArticleCategoryController@edit');
        Route::any('/media-article-category/delete/{id}','App\Http\Controllers\Backend\MediaArticleCategoryController@delete');

        //文章
        Route::any('/article','App\Http\Controllers\Backend\ArticleController@index')->name('article');
        Route::any('/article/create','App\Http\Controllers\Backend\ArticleController@create');
        Route::any('/article/edit/{id}','App\Http\Controllers\Backend\ArticleController@edit');
        Route::any('/article/delete/{id}','App\Http\Controllers\Backend\ArticleController@delete');

        //传媒文章
        Route::any('/media-article','App\Http\Controllers\Backend\MediaArticleController@index')->name('article');
        Route::any('/media-article/create','App\Http\Controllers\Backend\MediaArticleController@create');
        Route::any('/media-article/edit/{id}','App\Http\Controllers\Backend\MediaArticleController@edit');
        Route::any('/media-article/delete/{id}','App\Http\Controllers\Backend\MediaArticleController@delete');

        //传媒配置
        Route::any('/media-set-description','App\Http\Controllers\Backend\MediaSetController@descriptionSet');
        Route::any('/media-set-headinfo','App\Http\Controllers\Backend\MediaSetController@headInfoSet');
        Route::any('/media-set-contact','App\Http\Controllers\Backend\MediaSetController@contactSet');
        Route::any('/media-set-picture','App\Http\Controllers\Backend\MediaSetController@pictureSet');
        //传媒作者
        Route::any('/media-author','App\Http\Controllers\Backend\MediaAuthorController@index')->name('author');
        Route::any('/media-author/create','App\Http\Controllers\Backend\MediaAuthorController@create');
        Route::any('/media-author/edit/{id}','App\Http\Controllers\Backend\MediaAuthorController@edit');
        //系统用户
        Route::any('/system-account','App\Http\Controllers\Backend\SystemAccountController@index')->name('system-account');
        Route::any('/system-account/create','App\Http\Controllers\Backend\SystemAccountController@create');
        Route::any('/system-account/edit/{id}','App\Http\Controllers\Backend\SystemAccountController@edit');
        Route::any('/system-account/delete/{id}','App\Http\Controllers\Backend\SystemAccountController@delete');
        //投票管理
        Route::any('/vote','App\Http\Controllers\Backend\VoteController@index')->name('vote');
        Route::any('/vote/create','App\Http\Controllers\Backend\VoteController@create');
        Route::any('/vote/edit/{id}','App\Http\Controllers\Backend\VoteController@edit');
        Route::any('/vote/delete/{id}','App\Http\Controllers\Backend\VoteController@delete');
        //投票选手
        Route::any('/vote-player/{id}','App\Http\Controllers\Backend\VotePlayerController@index')->name('vote-player');
        Route::any('/vote-player/create/{id}','App\Http\Controllers\Backend\VotePlayerController@create');
        Route::any('/vote-player/edit/{id}','App\Http\Controllers\Backend\VotePlayerController@edit');
        Route::any('/vote-player/delete/{id}','App\Http\Controllers\Backend\VotePlayerController@delete');
        //投票日志
        Route::any('/vote-log/{id}','App\Http\Controllers\Backend\VoteLogController@index')->name('vote-log');
        //图片上传
        Route::any('/image-upload', 'App\Http\Controllers\Backend\UploadImgController@upload')->name('image-upload');
    });
});