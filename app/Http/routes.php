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

$app->get('/', [function () use ($app) {
    //$environment = app()->environment();
    return view('index', ['name' => 'James', "base_url" => url("/")]);
}]);

$app->post("/api/auth/login", [
    'as' => 'login',
    'uses' => 'AuthApiController@login'
]);

$app->get("/api/user/me", [
    'as' => 'me',
    'uses' => 'UserApiController@me',
    'middleware' => 'auth.api'
]);