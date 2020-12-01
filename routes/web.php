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

$router->get('/authors', 'AuthorController@showAllAuthors');
$router->get('/authors/{author_id}', 'AuthorController@showOneAuthor');
$router->post('/authors', 'AuthorController@createAuthor');
$router->put('/authors/{author_id}', 'AuthorController@updateAuthor');
$router->delete('/authors/{author_id}', 'AuthorController@deleteAuthor');

$router->post('/authors/{author_id}/books', 'AuthorController@createBook');