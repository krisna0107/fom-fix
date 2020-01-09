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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'kontens'], function(){
    Route::get('/{limit}/limit', 'KontenController@index');
    Route::get('/{id}/konten', 'KontenController@getKonten');
});

Route::group(['prefix' => 'mejas'], function(){
    Route::get('/{id}/meja', 'KontenController@index');
});

Route::group(['prefix' => 'akuns'], function(){
    Route::post('/{email}/email', 'AkunController@getAkun');
    Route::get('/{limit}/limit', 'AkunController@index');
});

Route::group(['prefix' => 'pesans'], function(){
    Route::get('/kode', 'PesanController@getKodeBook');
    Route::get('/{userid}/user/{stat}/status/{limit}/limit', 'PesanController@getPesanByKdBookAndStatus');
    Route::post('/{userid}/user/{meja}/meja', 'PesanController@tambah');
    Route::post('/{kdbook}/booking/{userid}/user/{total}/set/{bank}/bank/{va}/va/{status}', 'PesanController@setTotal');
});

Route::group(['prefix' => 'carts'], function(){
    Route::get('/{kdbook}/kode', 'CartController@getCart');
    Route::get('/{kdbook}/booking/{userid}/user/total', 'CartController@getTotal');
    Route::get('/{kdbook}/booking/{userid}/user/{limit}/limit', 'CartController@getCartKontenByUserKdBook');
    Route::get('/{kdbook}/booking/{userid}/user/{kontenid}/konten', 'CartController@cekCart');
    Route::post('/{kdbook}/booking/{userid}/user/{kontenid}/konten/{jumlah}/jumlah/{total}/total', 'CartController@tambah');
    Route::delete('/{kdbook}/booking/{userid}/user/{kontenid}/konten', 'CartController@hapus');
});

Route::group(['prefix' => 'ovos'], function(){
    Route::get('/{nomor}/nomor', 'OVOIDController@index');
});

Route::group(['prefix' => 'mids'], function(){
    Route::post('', 'PaymentGateWay@seting');
    Route::get('/{end}', 'PaymentGateWay@base64yaa');
    Route::get('/{kdbook}/book/status', 'PaymentGateWay@getStatus');
    Route::post('/{amount}/harga/{kdbok}/book/{userid}/user/{bank}/bank', 'PaymentGateWay@getVa');
});