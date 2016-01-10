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

$app->get('/', function () use ($app) {
    return response()
        ->json([
            'name' => 'PetFindrs API',
            'version' => '1.0',
            'statusCode' => 200
        ])
        ->header('Content-Type', 'application/json');
});


// API Version 1
$app->group(['namespace' => 'App\Http\Controllers\V1\Locations', 'prefix' => 'v1/locations'], function() use($app) {
    $app->get('countries', 'CountryController@index');
    $app->get('countries/active', 'CountryController@active');
    $app->get('countries/{id}', 'CountryController@find');
    $app->get('countries/code/{code}','CountryController@findByCode');
    $app->get('countries/name/{name}','CountryController@findByName');
    $app->get('countries/lat/{lat}/lon/{lon}','CountryController@findByLocation');
});

