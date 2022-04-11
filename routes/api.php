<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function ($router) {

    Route::post('register', 'Api\AuthController@register');
    Route::post('login', 'Api\AuthController@login');
    Route::get('logout', 'Api\AuthController@logout');

    Route::post('forgetpassword', 'Api\AuthController@sendOtp');
    Route::post('forgetpassword/verify', 'Api\AuthController@verfiyOtp');
    Route::post('update/password','Api\AuthController@updatePassword');
    
    Route::post('social_login', 'Api\AuthController@socialLogin');
    
    Route::post('install', 'Api\NotificationController@addDevice');
    Route::get('notifications/{token}', 'Api\NotificationController@notification');

    Route::get('notifications', 'Api\NotificationController@noti');
    Route::get('notification/setting', 'Api\NotificationController@notiset');

    Route::get('notification/setting/{token}', 'Api\NotificationController@notifySetting');
    Route::post('notification/main', 'Api\NotificationController@notifyMain');
    Route::post('notification/media', 'Api\NotificationController@notifyMedia');
    Route::post('notification/{cat_id}', 'Api\NotificationController@notifyCategory');
    Route::get('notify', 'Api\NotificationController@notify');

    Route::get('breakingnews', 'Api\UserController@breakingNews');
    Route::get('advertise', 'Api\UserController@advertise');

    Route::get('dashboard/hotnews', 'Api\UserController@dashboard');
    Route::get('dashboard/trending', 'Api\UserController@trendingNews');
    Route::get('dashboard/popular', 'Api\UserController@popularNews');
    Route::get('dashboard/featured', 'Api\UserController@featuredNews');
    Route::get('dashboard/{categoryid}', 'Api\UserController@categoryNews');
    
    Route::post('makefavourite/{post_id}', 'Api\FavouriteController@makeFavourite');
    Route::post('makeblogfavourite/{blog_id}', 'Api\FavouriteController@blogFavourite');
    Route::get('watched_ads/{ads_id}', 'Api\FavouriteController@adsvisit');
    Route::get('favouritepost', 'Api\FavouriteController@getFavouritePost');
    Route::get('favouriteblog', 'Api\FavouriteController@getFavouriteBlog');
    
    Route::post('/search', 'Api\ApiController@search');

    Route::get('/subcategorynews/{sub_cat_id}', 'Api\ApiController@subcatsNews');
    Route::get('newsdetail/{post_id}', 'Api\ApiController@newsDetail');
    Route::get('contact', 'Api\ApiController@contact');
    Route::get('blogs', 'Api\ApiController@blog');
    Route::get('blogdetail/{blog_id}', 'Api\ApiController@blogDetail');
    Route::post('review/{post_id}', 'Api\ApiController@reviewPost');
    Route::post('/support', 'Api\ApiController@support');
    Route::get('/gallery', 'Api\ApiController@gallery');

    Route::get('/mediacategorylist', 'Api\ApiController@media');
    Route::get('/media/category/trending', 'Api\ApiController@trendingmedia');
    Route::get('/media/category/featured', 'Api\UserController@featuredmedia');
    Route::get('/media/category/popular', 'Api\UserController@popularmedia');
    Route::get('/media/category/{id}', 'Api\ApiController@mediaCategory');
    Route::get('/media/sub_category/{id}', 'Api\ApiController@mediaSubcat');
    Route::get('/media/child_category/{id}', 'Api\ApiController@childMedialist');
    Route::get('/media/videodetail/{video_id}', 'Api\ApiController@videoDetail');

    Route::get('/news/history', 'Api\ApiController@watchNewsHistory');
    Route::post('/news/history_filter', 'Api\ApiController@newsHistoryFilter');
    Route::get('/media/history', 'Api\ApiController@watchMediaHistory');
    Route::post('/media/history_filter', 'Api\ApiController@mediaHistoryFilter');

    Route::get('/quiz', 'Api\QuizController@getquestion');
    Route::post('/quiz-answer', 'Api\QuizController@quizAnswer');
    
    Route::get('/polling', 'Api\PollController@polling');
    Route::post('/vote', 'Api\PollController@vote');
    
    Route::get('/clear', 'Api\VotingController@resultempty');
    Route::get('/votes', 'Api\VotingController@votes');
    Route::get('/voting/{id}', 'Api\VotingController@voting');
    Route::post('/voted', 'Api\VotingController@voted');

    Route::get('program-lists','Api\ParticipantController@programList');
    Route::post('program-participant','Api\ParticipantController@participantSave');
    

});
