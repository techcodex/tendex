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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Sms Routes
Route::get('/verify_sms','SmsVerificationController@showVerificationForm')->name('verify_form');
Route::post('verify_sms','SmsVerificationController@verify')->name('verify_sms');
Route::get('/resend_sms','SmsVerificationController@resend')->name('resend');

Route::middleware(['auth'])->group(function() {
    // User Sms Verification Routes
    Route::get('/user/verify/contact_form','UserSmsVerificationController@showContactNoForm')->name('user.contact_form');
    Route::post('/user/send_verification_sms','UserSmsVerificationController@sendVerificationSms')->name('user.sendVerficationSms');
    Route::post('/user/verify_sms','UserSmsVerificationController@verify')->name('user.verify');
    Route::get('/user/verify_sms','UserSmsVerificationController@showVerificationForm')->name('user.verifyForm');
});



// linkedin Login Routes
Route::get('/redirect', 'SocialAuthLinkedinController@redirect');
Route::get('/callback', 'SocialAuthLinkedinController@callback');
