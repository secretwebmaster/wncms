<?php

// Start output buffering
ob_start();

// Check if the script is accessed directly and not via a valid request
if (!defined('LARAVEL_START')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Direct access to this file is forbidden.');
}

// Check if exec function exists
if (!function_exists('exec')) {
    header('HTTP/1.0 500 Internal Server Error');
    include __DIR__ . '/error.php';
    die;
}

// Output the HTML message
include __DIR__ . '/preparation_message.html';

// Ensure the output is sent to the browser before continuing
ob_flush();
flush();


$coreFile = __DIR__ . '/../../composer.json';
$customFile = __DIR__ . '/../../composer.custom.json';
$pluginFile = __DIR__ . '/../../composer.plugin.json';

if (file_exists($customFile)) {
    $core = json_decode(file_get_contents($coreFile), true);
    $custom = json_decode(file_get_contents($customFile), true);

    if (isset($custom['require'])) {
        $core['require'] = array_merge($core['require'] ?? [], $custom['require']);
    }

    file_put_contents($coreFile, json_encode($core, JSON_PRETTY_PRINT));
}

if (file_exists($pluginFile)) {
    $core = json_decode(file_get_contents($coreFile), true);
    $plugin = json_decode(file_get_contents($pluginFile), true);

    if (isset($plugin['require'])) {
        $core['require'] = array_merge($core['require'] ?? [], $plugin['require']);
    }

    file_put_contents($coreFile, json_encode($core, JSON_PRETTY_PRINT));
}

// Run composer install to update dependencies
exec('cd .. && composer install 2>&1', $output, $returnVar);

if ($returnVar !== 0) {
    header('HTTP/1.0 500 Internal Server Error');
    echo "<div class='error-message'><pre>";
    print_r($output);
    print_r($returnVar);
    echo "</pre></div>";
    exit('Composer install failed. Please check the server logs for details.');
}