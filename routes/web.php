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

Route::get('/', 'LandingController@home')->name('home');
Route::get('/about', 'LandingController@about')->name('about');
Route::get('/blogs', 'LandingController@blog')->name('blog');
Route::get('/blog/{slug}', 'LandingController@blog_detail')->name('blog.detail');
Route::get('/contact', 'LandingController@contact')->name('contact');
Route::post('/contact', 'LandingController@inquiry_store')->name('inquiry.store');
Route::get('maintenance-mode', 'HomeController@maintenanceMode')->name('maintenance_mode');

//login
Route::get('login/{tab}', 'LoginController@login')->name('login');
Route::post('login_submit', 'LoginController@submit')->name('login_post')->middleware('actch');
Route::get('logout', 'LoginController@logout')->name('logout');
Route::get('/reload-captcha', 'LoginController@reloadCaptcha')->name('reload-captcha');
Route::post('/reset-password', 'LoginController@user_reset_password_request')->name('reset-password');
Route::get('/password-reset', 'LoginController@reset_password')->name('change-password');
Route::post('reset-password-submit', 'LoginController@reset_password_submit')->name('reset-password-submit');

Route::get('lang/{locale}', 'HomeController@lang')->name('lang');
Route::get('authentication-failed', function () {
    $errors = [];
    array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthenticated.']);
    return response()->json([
        'errors' => $errors,
    ], 401);
})->name('authentication-failed');

$is_published = 0;
try {
$full_data = include('Modules/Gateways/Addon/info.php');
$is_published = $full_data['is_published'] == 1 ? 1 : 0;
} catch (\Exception $exception) {}

Route::get('/test',function (){
    return view('errors.404');
});

Route::get('authentication-failed', function () {
    $errors = [];
    array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthorized.']);
    return response()->json([
        'errors' => $errors
    ], 401);
})->name('authentication-failed');
