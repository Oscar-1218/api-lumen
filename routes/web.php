<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
*/

$router->get('/', function () use ($router) { 
    return $router->app->version();
});
use Illuminate\Http\Request;

//creado para creacion de usuario
// $router->post('/usuarios', ['uses' =>'Users\StoreUserController@store', 'as' => 'users.store']);
$router->post('/usuarios', 'LibroController@store');


$router->group(['middleware' => 'auth'], function () use($router){
    $router->get('/ruta', function () use ($router) {
        return response()->json('Accediste!!!');

    });
});

$router->get('/libros', 'LibroController@index');  //esto accede a LibroController

$router->post('/libros', 'LibroController@create');
$router->get('/libros/{id}', 'LibroController@read');
$router->post('/libros/{id}', 'LibroController@update'); 
$router->delete('/libros/{id}', 'LibroController@delete'); /*esto en el hosting de alojamiento fue reemplazado por :
$router->post('/librosdelete/{id}', 'LibroController@delete'); debido a que el servicio Free no acepta Delete*/


 
