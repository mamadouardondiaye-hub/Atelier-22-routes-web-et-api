<?php
declare(strict_types=1);

namespace Core;

// Petite classe pour uniformiser les réponses JSON de l'API :
// succès -> {"data": ...}, erreur -> {"error": "...", "code": 4xx}
class Response
{
    public function __construct(
        private readonly int $status,
        private readonly array $payload = [],
    ) {}

    public static function json(mixed $data, int $status = 200): self
    {
        return new self($status, ['data' => $data]);
    }

    public static function error(string $message, int $status = 400): self
    {
        return new self($status, ['error' => $message, 'code' => $status]);
    }

    public function send(): void
    {
        http_response_code($this->status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
