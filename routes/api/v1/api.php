<?php

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

Route::group(['namespace' => 'Api\V1', 'middleware'=>['localization']], function () {
    
    Route::group(['prefix' => 'inquiries'], function () {
        Route::post('store', 'InquiryController@store');
    });
    
    Route::group(['prefix' => 'blogs'], function () {
        Route::get('list', 'BlogController@get_blogs');
        Route::get('list/{id}', 'BlogController@get_blog_details');
    });
    
    Route::group(['prefix' => 'projects'], function () {
        Route::get('list', 'ProjectController@get_projects');
    });

    Route::group(['prefix' => 'resumedetails'], function () {
        Route::get('list', 'ResumeDetailController@get_resumedetails');
    });
    
    Route::group(['prefix' => 'services'], function () {
        Route::get('list', 'ServiceController@get_services');
    });
    
    Route::group(['prefix' => 'skills'], function () {
        Route::get('list', 'SkillController@get_skills');
    });
    
    Route::group(['prefix' => 'socialmedia'], function () {
        Route::get('list', 'SocialMediaController@get_socialmedias');
    });
    
    Route::group(['prefix' => 'testimonials'], function () {
        Route::get('list', 'TestimonialController@get_testimonials');
    });

});