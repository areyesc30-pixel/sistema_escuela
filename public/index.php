<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Cargar la configuración de rutas
require_once FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

// Cargar y ejecutar el arranque
require_once $paths->systemDirectory . '/Boot.php';

CodeIgniter\Boot::bootWeb($paths);