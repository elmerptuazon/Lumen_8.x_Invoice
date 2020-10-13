<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
// $router->post('user/register', 'UserController@register');
$router->group(['prefix' => 'api'], function ($router) {
    $router->post('register', 'UserController@register');
    $router->post('login', 'UserController@login');
    $router->post('logout', 'UserController@logout');

    $router->group(['prefix' => 'invoice'], function ($router) {
        $router->get('index', 'InvoiceController@index');
        $router->post('store', 'InvoiceController@store');
        $router->get('show/{id}', 'InvoiceController@show');
        $router->post('update', 'InvoiceController@update');
        $router->get('destroy/{id}', 'InvoiceController@destroy');
    });
    
});


