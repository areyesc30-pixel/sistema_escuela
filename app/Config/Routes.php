<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Inicio::index');
$routes->get('cambiar-idioma/(:any)', 'Inicio::cambiar_idioma/$1');
$routes->get('ingresar', 'Inicio::ingresar');
$routes->post('entrar', 'Inicio::entrar');
$routes->get('registro', 'Inicio::registro');
$routes->post('registrar', 'Inicio::registrar');
$routes->get('recuperar-clave', 'Inicio::recuperar_clave');
$routes->post('enviar-recuperacion', 'Inicio::enviar_recuperacion');
$routes->get('tareas', 'Inicio::tareas');
$routes->post('guardar-tarea', 'Inicio::guardar_tarea');
$routes->get('editar-tarea/(:num)', 'Inicio::editar_tarea/$1');
$routes->post('actualizar-tarea/(:num)', 'Inicio::actualizar_tarea/$1');
$routes->get('completar-tarea/(:num)', 'Inicio::completar_tarea/$1');
$routes->get('eliminar-tarea/(:num)', 'Inicio::eliminar_tarea/$1');
$routes->get('perfil', 'Inicio::perfil');
$routes->get('editar-usuario', 'Inicio::editar_usuario');
$routes->post('actualizar-usuario', 'Inicio::actualizar_usuario');
$routes->post('subir-foto', 'Inicio::subir_foto');
$routes->post('eliminar-foto', 'Inicio::eliminar_foto');
$routes->post('cambiar-contrasena', 'Inicio::cambiar_contrasena');
$routes->get('salir', 'Inicio::salir');

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}