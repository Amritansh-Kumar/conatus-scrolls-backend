<?php

use Dingo\Api\Routing\Router;

$api = app('Dingo\Api\Routing\Router');
$baseControllersPath = 'App\Api\v1\Controllers\\';

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

$api->version('v1', function ($api) use ($baseControllersPath) {

    $api->get('test', $baseControllersPath. 'UserController@test');

    $api->post('leader', $baseControllersPath . 'UserController@storeLeader');

    $api->get('domains', $baseControllersPath . 'DomainController@fetchDomains');

    $api->post('member', $baseControllersPath . 'UserController@storeMember');

    $api->patch('user/update', $baseControllersPath . 'UserController@update');

});

