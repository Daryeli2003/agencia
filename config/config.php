<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];

$script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

$base_path = rtrim($script_dir, '/') . '/';

define('BASE_URL', $protocol . $host . $base_path);

define('ASSETS_URL', BASE_URL . 'views/');

define('ROOT_PATH', dirname(__DIR__));
?>