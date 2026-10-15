<?php
error_reporting(-1);
ini_set('display_errors', '1');

echo "Paso 1 cargado\n";

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

echo "Paso 2 cargado\n";

require_once __DIR__ . '/../system/Boot.php';

echo "Paso 3 cargado\n";

$app = \Config\Services::codeigniter();
$app->run();

echo "Paso 4 cargado\n";