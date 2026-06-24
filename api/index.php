<?php

use Illuminate\Http\Request;

ini_set('display_errors', 1);
error_reporting(E_ALL);
$_ENV['APP_DEBUG'] = 'true';

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

try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    echo "<h1>Fatal Vercel Error</h1>";
    echo "<pre>" . (string) $e . "</pre>";
}
