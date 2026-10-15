<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

$systemPath = realpath(FCPATH . '../system') . DIRECTORY_SEPARATOR;
$appPath = realpath(FCPATH . '../app') . DIRECTORY_SEPARATOR;
$writablePath = realpath(FCPATH . '../writable') . DIRECTORY_SEPARATOR;

require_once $systemPath . 'Boot.php';