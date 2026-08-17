<?php
declare(strict_types=1);

use App\Controllers\BookApiController;

// Routes API → JSON pour JavaScript (fetch)
$router->get('/api/books', [BookApiController::class, 'index']);
$router->get('/api/books/{id}', [BookApiController::class, 'show']);
$router->post('/api/books', [BookApiController::class, 'store']);
$router->delete('/api/books/{id}', [BookApiController::class, 'destroy']);
