<?php

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'PageController@home')->name('pages.home');
    Route::get('home', 'PageController@home')->name('pages.home');
    Route::get('frequently-asked-questions', 'PageController@faq')->name('pages.faq');
});

// campaigns
Route::group([
    'prefix' => 'campaigns',
    'middleware' => ['auth'],
], function () {

    // /campaigns - campaigns list
    Route::get('/', [
        'as' => 'campaigns.list',
        'uses' => 'CampaignController@index'
    ]);

    // campaigns/{campaign_id}/details - campaign details
    Route::get('{campaign_id}/details', [
        'as' => 'campaigns.details',
        'uses' => 'CampaignController@show'
    ]);

    // campaigns/{campaign_id}/download - campaign download
    Route::get('{campaign_id}/download', [
        'as' => 'campaigns.download',
        'uses' => 'CampaignController@download'
    ]);

    // campaigns/{campaign_id}/store - campaign store
    Route::post('store', [
        'as' => 'campaigns.store',
        'uses' => 'CampaignController@store'
    ]);

});


// coupons
Route::group([
    'prefix' => 'coupons',
], function () {

    // /coupons - coupons list
    Route::get('/', [
        'as' => 'coupons.list',
        'uses' => 'CouponController@index'
    ]);

    // coupons/{coupon_id}/details - coupon details
    Route::get('{coupon_id}/details', [
        'as' => 'coupons.details',
        'uses' => 'CouponController@show'
    ]);

    // coupons/{coupon_id}/redeem
    Route::get('{coupon_id}/redeem', [
        'as' => 'coupons.redeem',
        'uses' => 'CouponController@redeem'
    ]);

    // coupons/{coupon_id}/redeem
    Route::post('{coupon_id}/store', [
        'as' => 'coupons.redemption',
        'uses' => 'CouponController@store'
    ]);
});

// receipts
Route::group([
    'prefix' => 'receipts',
], function () {

    // /receipts - receipts list
    Route::get('/', [
        'as' => 'receipts.list',
        'uses' => 'ReceiptController@index'
    ]);

    // /receipts/create - receipts create form
    Route::get('/create', [
        'as' => 'receipts.create',
        'uses' => 'ReceiptController@create'
    ]);

    // /receipts/store - receipts store
    Route::post('/store', [
        'as' => 'receipts.store',
        'uses' => 'ReceiptController@store'
    ]);

});

// account
Route::group([
    'prefix' => 'account'
], function () {
    Route::get('me', [
        'as' => 'account.profile',
        'uses' => 'AccountController@me'
    ]);

    //account/update
    Route::post('update',[
        'as' => 'account.profile.update',
        'uses' => 'AccountController@update'
    ]);
});

// auth - login, registration, password reset etc
Route::group([
    'prefix' => 'auth'
], function () {
    // auth/login - Login view
    Route::get('login', [
        'middleware' => ['guest'],
        'as' => 'auth.login-form',
        'uses' => 'Auth\LoginController@showLoginForm'
    ]);

    Route::post('login', [
        'middleware' => ['guest'],
        'as' => 'auth.post-login',
        'uses' => 'Auth\LoginController@login'
    ]);

    //auth/logout
    Route::get('logout', [
        'middleware' => ['auth'],
        'as' => 'auth.logout',
        'uses' => 'Auth\LoginController@logout'
    ]);

    // Registration view
    Route::get('registration', [
        'middleware' => ['guest'],
        'as' => 'auth.registration-form',
        'uses' => 'Auth\RegisterController@showRegistrationForm'
    ]);

    Route::post('registration', [
        'middleware' => [],
        'as' => 'auth.post-registration',
        'uses' => 'Auth\RegisterController@register'
    ]);

    Route::get('registration/acknowledge', [
        'middleware' => ['guest'],
        'as' => 'auth.registration-acknowledge',
        'uses' => 'Auth\RegisterController@showRegistrationAcknowledge'
    ]);


    // Password Reset Routes...
    // auth/password/reset/{token}
    // Forgot password, Password reset
    Route::get('password/email', [
        'middleware' => ['guest'],
        'as' => 'auth.password.forgot.email',
        'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
    ]);

    Route::get('password/reset/{token?}', [
        'middleware' => [],
        'as' => 'auth.password.forgot',
        'uses' => 'Auth\ResetPasswordController@showResetForm'
    ]);

    // auth/password/email
    Route::post('password/email', [
        'middleware' => ['guest'],
        'as' => 'auth.password.reset.email',
        'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
    ]);

    // auth/password/reset/
    Route::post('password/reset', [
        'middleware' => ['guest'],
        'as' => 'auth.password.reset',
        'uses' => 'Auth\ResetPasswordController@reset'
    ]);
});