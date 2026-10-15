<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');

$routes->get('/', 'Inicio::index');
$routes->post('ingresar', 'Inicio::ingresar');
$routes->get('tareas', 'Inicio::tareas');
$routes->get('salir', 'Inicio::salir');