<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

$paths = [
    'systemPath'   => FCPATH . '../system/',
    'appPath'      => FCPATH . '../app/',
    'writablePath' => FCPATH . '../writable/',
    'rootPath'     => FCPATH . '../',
];

require_once $paths['systemPath'] . 'Boot.php';

$routes = \Config\Services::routes();
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');
$routes->get('/', 'Inicio::index');

$app = \Config\Services::codeigniter();
$app->setRoutes($routes);
$app->run();