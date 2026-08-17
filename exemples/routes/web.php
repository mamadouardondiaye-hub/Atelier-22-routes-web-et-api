<?php
declare(strict_types=1);

use App\Controllers\PageController;

// Routes WEB → pages HTML servies par PHP
$router->get('/', [PageController::class, 'home']);
$router->get('/books', [PageController::class, 'books']);
