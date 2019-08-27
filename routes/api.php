<?php

use Dingo\Api\Routing\Router;

$api                 = app('Dingo\Api\Routing\Router');
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

    $api->get('test', function () {
        return "working fine";
    });

    $api->post('register/leader', $baseControllersPath . 'UserController@storeLeader');

    $api->get('domains', $baseControllersPath . 'DomainController@fetchDomains');

    $api->get('domains/{id}/topics', $baseControllersPath . 'DomainController@indexTopics');

    $api->post('password/forgot', $baseControllersPath . 'AuthController@forgotPassword');

    $api->post('password/reset/code', $baseControllersPath . 'AuthController@resetPasswordByCode');

    $api->post('authenticate', $baseControllersPath . 'AuthController@authenticate');


});

$api->version('v1', ['middleware' => 'jwt.auth'], function (Router $api) use ($baseControllersPath) {

    $api->post('register/member', $baseControllersPath . 'UserController@storeMember');

    $api->patch('user/update', $baseControllersPath . 'UserController@update');

    $api->get('team-details/{id}', $baseControllersPath . 'TeamController@show');

    $api->get('synopsis/{id}/download', $baseControllersPath . 'TeamController@downloadSynopsis');

    $api->group(['middleware' => 'api.auth.leader'], function ($api) use ($baseControllersPath) {
        $api->put('team-details/{id}', $baseControllersPath . 'TeamController@update');
        $api->post('leader/{id}/upload', $baseControllersPath . 'TeamController@uploadSynopsis');
        $api->post('leader/{id}/upload-complete', $baseControllersPath . 'TeamController@completeSynopsisUpload');
//        $api->delete('leader/{id}/synopsis', $baseControllersPath . 'TeamController@deleteSynopsis');
    });
});

