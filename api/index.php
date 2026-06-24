<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
$app = require_once __DIR__.'/../bootstrap/app.php';

// Set storage path to /tmp for Vercel serverless environment
$storagePath = '/tmp/storage';
$dirs = [
    'framework/views',
    'framework/cache/data',
    'framework/sessions',
    'logs',
    'app/public',
    'bootstrap/cache'
];

foreach ($dirs as $dir) {
    if (!is_dir($storagePath . '/' . $dir)) {
        mkdir($storagePath . '/' . $dir, 0777, true);
    }
}

$app->useStoragePath($storagePath);

$app->handleRequest(Request::capture());
