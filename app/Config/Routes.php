<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Inicio::index');
$routes->post('verificar', 'Inicio::verificar');
$routes->get('panel', 'Inicio::panel');
$routes->get('cerrar', 'Inicio::cerrar');