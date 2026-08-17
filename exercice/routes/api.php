<?php
declare(strict_types=1);

use App\Controllers\BookApiController;

$router->get('/api/books', [BookApiController::class, 'index']);
$router->post('/api/books', [BookApiController::class, 'store']);

// TODO 1b — Route API : POST /api/books/{id}/toggle → BookApiController@toggle
$router->post('/api/books/{id}/toggle', [BookApiController::class, 'toggle']);
// TODO 1c — Route API : DELETE /api/books/{id} → BookApiController@destroy
$router->delete('/api/books/{id}', [BookApiController::class, 'destroy']);
