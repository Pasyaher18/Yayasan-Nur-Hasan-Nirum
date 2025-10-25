<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek mode maintenance
if (file_exists($maintenance = __DIR__.'/../yayasan/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Load autoloader Composer
require __DIR__.'/../yayasan/vendor/autoload.php';

// Bootstrap Laravel
/** @var Application $app */
$app = require_once __DIR__.'/../yayasan/bootstrap/app.php';

$app->handleRequest(Request::capture());
