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

$router->group(['middleware' => 'client.credentials'], function() use ($router){

    /**
     * Routes for Authors
     */
    $router->get('/authors','AuthorController@index');
    $router->post('/authors','AuthorController@store');
    $router->get('/authors/{author}','AuthorController@show');
    $router->put('/authors/{author}','AuthorController@update');
    $router->patch('/authors/{author}','AuthorController@update');
    $router->delete('/authors/{author}','AuthorController@destroy');

    /**
     * Routes for Books
     */
    $router->get('/books','BookController@index');
    $router->post('/books','BookController@store');
    $router->get('/books/{book}','BookController@show');
    $router->put('/books/{book}','BookController@update');
    $router->patch('/books/{book}','BookController@update');
    $router->delete('/books/{book}','BookController@destroy');
});

/**
 * User credentials protected routes
 */
$router->group(['middleware' => 'auth:api'], function() use ($router){
    $router->get('/users/me','UserController@me');

    /**
     * Routes for Users
     */
    $router->get('/user','UserController@index');
    $router->post('/user','UserController@store');
    $router->get('/user/{user}',[
                                    'middleware' => 'permission:Edit Author',
                                    'use' => 'UserController@show'
                                ]);
    $router->put('/user/{user}','UserController@update');
    $router->patch('/user/{user}','UserController@update');
    $router->delete('/user/{user}','UserController@destroy');

    /**
     * Routes for Roles
     */
    $router->get('/roles','RoleController@index');
    $router->post('/roles','RoleController@store');
    $router->get('/roles/{id:[0-9]+}','RoleController@show');
    $router->put('/roles/{id:[0-9]+}','RoleController@update');
    $router->delete('/roles/{id:[0-9]+}','RoleController@destroy');

    /**
     * Routes for Permissions
     */
    $router->get('/permissions','PermissionController@index');
    $router->post('/permissions','PermissionController@store');
    $router->get('/permissions/{id:[0-9]+}','PermissionController@show');
    $router->put('/permissions/{id:[0-9]+}','PermissionController@update');
    $router->delete('/permissions/{id:[0-9]+}','PermissionController@destroy');
});



///  localhost:8002/oauth/token  route for access token
///  grant_type  client_credentials
///  client_id 2
///  client_secret  5iYOT135iPkvYO2GB1R0A2i7yFUnhHVJkrIIigQN