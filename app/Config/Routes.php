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

$routes->get('registro', 'Inicio::registro');
$routes->post('guardar-registro', 'Inicio::guardar_registro');

$routes->get('editar-tarea/(:num)', 'Inicio::editar_tarea/$1');
$routes->post('actualizar-tarea/(:num)', 'Inicio::actualizar_tarea/$1');


$routes->get('perfil', 'Inicio::perfil');
$routes->post('cambiar-contrasena', 'Inicio::cambiar_contrasena');