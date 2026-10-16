<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');

$routes->get('/', 'Inicio::index');

// Autenticación
$routes->get('ingresar', 'Inicio::ingresar');
$routes->post('entrar', 'Inicio::entrar');
$routes->get('salir', 'Inicio::salir');

// Tareas
$routes->get('tareas', 'Inicio::tareas');
$routes->post('guardar-tarea', 'Inicio::guardar_tarea');
$routes->get('completar/(:num)', 'Inicio::completar/$1');
$routes->get('eliminar/(:num)', 'Inicio::eliminar/$1');

// Editar tareas
$routes->get('editar-tarea/(:num)', 'Inicio::editar_tarea/$1');
$routes->post('actualizar-tarea/(:num)', 'Inicio::actualizar_tarea/$1');

// Registro y recuperación
$routes->get('registro', 'Inicio::registro');
$routes->post('guardar-registro', 'Inicio::guardar_registro');
$routes->get('recuperar-clave', 'Inicio::recuperar_clave');
$routes->post('enviar-recuperacion', 'Inicio::enviar_recuperacion');

// Perfil
$routes->get('perfil', 'Inicio::perfil');
$routes->post('cambiar-contrasena', 'Inicio::cambiar_contrasena');