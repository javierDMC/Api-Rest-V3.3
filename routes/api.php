<?php 

use App\response\HTTPResponse;
$router = new \Bramus\Router\Router();
 
 
$router->setNamespace('\App');
 
/**
 * Definimos nuestras rutas
 */
$router->get('/', 
    function() {
        HTTPResponse::json(200, 'Bienvenido a la API de peliculas');
    }
);
$router->get('/peliculas', 'controllers\MoviesController@all');
$router->get('/peliculas/(\d+)', 'controllers\MoviesController@find');
$router->post('/peliculas', 'controllers\MoviesController@insert');
$router->delete('/peliculas/(\d+)', 'controllers\MoviesController@delete');
$router->put('/peliculas/(\d+)', 'controllers\MoviesController@update');
$router->set404(function() { HTTPResponse::json(404,'Página no encontrada');});

$router->run();

?>