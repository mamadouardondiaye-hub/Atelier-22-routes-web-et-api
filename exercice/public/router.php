<?php
declare(strict_types=1);

// Ce fichier sert de routeur pour : php -S localhost:8081 router.php
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$file = __DIR__ . $path;

if ($path !== '/' && is_file($file)) {
    return false; // fichier réel (js, ...) -> on laisse le serveur PHP le servir tel quel
}

require __DIR__ . '/index.php';
