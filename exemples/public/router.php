<?php
declare(strict_types=1);

// Routeur pour : php -S localhost:8080 -t public public/router.php
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$file = __DIR__ . $path;

if ($path !== '/' && is_file($file)) {
    return false; // laisser le serveur servir le fichier statique (js, …)
}

require __DIR__ . '/index.php';
