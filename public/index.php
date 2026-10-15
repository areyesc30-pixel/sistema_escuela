<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ✅ FCPATH PRIMERO — antes de cualquier cosa
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// ✅ Luego cargamos Paths
require_once FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

// ✅ Luego Boot
require_once $paths->systemDirectory . '/Boot.php';

// ✅ Arrancamos
CodeIgniter\Boot::bootWeb($paths);