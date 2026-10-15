<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../app/Config/Paths.php';

$paths = new Config\Paths();

require_once __DIR__ . '/../system/Boot.php';

CodeIgniter\Boot::bootWeb($paths);