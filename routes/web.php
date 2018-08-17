<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

//vouchers routes
    $router->get('vouchers', ['uses' => 'VoucherPoolController@showAllVouchers']);

    $router->get('vouchers/{id}', ['uses' => 'VoucherPoolController@showOneVoucher']);

    $router->post('vouchers', ['uses' => 'VoucherPoolController@create']);

    $router->delete('vouchers/{id}', ['uses' => 'VoucherPoolController@delete']);

    $router->put('vouchers/{id}', ['uses' => 'VoucherPoolController@update']);

    $router->get('vouchers/recipients', ['uses' => 'VoucherPoolController@showAllByEmail']);

    $router->put('vouchers/validate', ['uses' => 'VoucherPoolController@validateCode']);

//offers routes
    $router->get('offers', ['uses' => 'SpecialOfferController@showAllOffers']);

    $router->get('offers/{id}', ['uses' => 'SpecialOfferController@showOneSpecialOffer']);

    $router->post('offers', ['uses' => 'SpecialOfferController@create']);

    $router->delete('offers/{id}', ['uses' => 'SpecialOfferController@delete']);

    $router->put('offers/{id}', ['uses' => 'SpecialOfferController@update']);

//recipients routes
    $router->get('recipients', ['uses' => 'RecipientController@showAllRecipients']);

    $router->get('recipients/{id}', ['uses' => 'RecipientController@showOneRecipient']);

    $router->post('recipients', ['uses' => 'RecipientController@create']);

    $router->delete('recipients/{id}', ['uses' => 'RecipientController@delete']);

    $router->put('recipients/{id}', ['uses' => 'RecipientController@update']);
});