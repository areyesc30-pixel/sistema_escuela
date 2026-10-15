<?php
echo "Paso 1\n";

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

$paths = [
    'systemPath'   => FCPATH . '../system/',
    'appPath'      => FCPATH . '../app/',
    'writablePath' => FCPATH . '../writable/',
    'rootPath'     => FCPATH . '../',
];

echo "Paso 2\n";

require_once $paths['systemPath'] . 'Boot.php';

echo "Paso 3\n";