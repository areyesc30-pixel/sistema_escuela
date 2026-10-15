<?php

use CodeIgniter\Router\RouteCollection;

/**  
 * @var RouterCollection $routes
 
*/
$router->get('/', 'inicio::index');
$routes->post('verificar', 'Inicio::verificar');
$routes->get('panel', 'Inicio::panel');
$routes->get('cerrar', 'Inicio::cerrar');


