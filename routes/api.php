<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'cors', 'as' => 'api.'], function() {

    Route::post('/access_token', 'Api\AuthController@accessToken')->name('access_token');
    Route::post('/refresh_token', 'Api\AuthController@refreshToken')->name('refresh_token');

    Route::group(['middleware' => 'auth:api'], function() {

        Route::post('/logout', 'Api\AuthController@logout')->name('logout');

        Route::get('/user', function () {
            return Auth::guard('api')->user();
        })->name('user');

        Route::resource('bank-accounts', 'Api\BankAccountsController', ['except' => ['create', 'edit']]);

        Route::resource('banks', 'Api\BanksController', ['only' => 'index']);

        Route::get('bills-pay/status', 'Api\BillsPayController@status')->name('bills-pay.status');
        Route::get('bills-pay/total', 'Api\BillsPayController@total')->name('bills-pay.total');
        Route::resource('bills-pay', 'Api\BillsPayController', ['except' => ['create', 'edit']]);

        Route::get('bills-receive/status', 'Api\BillsReceivedController@status')->name('bills-receive.status');
        Route::get('bills-receive/total', 'Api\BillsReceivedController@total')->name('bills-receive.total');
        Route::resource('bills-receive', 'Api\BillsReceivedController', ['except' => ['create', 'edit']]);

    });

});