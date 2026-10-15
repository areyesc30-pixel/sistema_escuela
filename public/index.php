<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

$systemPath = FCPATH . '../system/';

if (!is_dir($systemPath)) {
    echo "No encuentro la carpeta system en: " . $systemPath;
    exit;
}

require_once $systemPath . 'Boot.php';