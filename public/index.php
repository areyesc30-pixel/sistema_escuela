<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

$systemPath = FCPATH . '../system/';
$appPath = FCPATH . '../app/';
$writablePath = FCPATH . '../writable/';

require_once $systemPath . 'Boot.php';