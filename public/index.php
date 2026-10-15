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

$app = \Config\Services::codeigniter();
$app->run();