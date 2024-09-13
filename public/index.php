<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (!file_exists(__DIR__.'/../.env')) {
    //merge composer.json
    require __DIR__.'/installer/merge-composer.php';
    //run composer install

    //copy .env
    copy(__DIR__.'/../.env.example', __DIR__.'/../.env');
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
