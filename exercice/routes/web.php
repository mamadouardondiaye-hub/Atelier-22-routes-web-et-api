<?php
declare(strict_types=1);

use App\Controllers\PageController;

// TODO 1a — Ajouter la route web GET /books → PageController@books
$router->get('/', [PageController::class, 'home']);
$router->get('/books', [PageController::class, 'books']);
