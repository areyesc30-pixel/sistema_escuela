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

$routes->post('guardar-tarea', 'Inicio::guardar');
$routes->get('completar/(:num)', 'Inicio::completar/$1');
$routes->get('eliminar/(:num)', 'Inicio::eliminar/$1');

$routes->get('recuperar-clave', 'Inicio::recuperar_clave');
$routes->post('enviar-recuperacion', 'Inicio::enviar_recuperacion');