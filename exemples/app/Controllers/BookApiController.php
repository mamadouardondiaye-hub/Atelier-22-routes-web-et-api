<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\BookRepository;
use Core\Response;

/**
 * Contrôleur API : renvoie du JSON pour que JavaScript manipule la page.
 */
class BookApiController
{
    public function __construct(private BookRepository $books) {}

    public function index(): Response
    {
        return Response::json($this->books->all());
    }

    public function show(string $id): Response
    {
        $livre = $this->books->find((int) $id);
        if ($livre === null) {
            return Response::error('Livre introuvable', 404);
        }

        return Response::json($livre);
    }

    public function store(): Response
    {
        $payload = $this->jsonBody();
        $titre = trim((string) ($payload['titre'] ?? ''));
        $auteur = trim((string) ($payload['auteur'] ?? ''));

        if ($titre === '' || $auteur === '') {
            return Response::error('Titre et auteur sont obligatoires', 422);
        }

        $livre = $this->books->create([
            'titre'  => $titre,
            'auteur' => $auteur,
        ]);

        return Response::json($livre, 201);
    }

    public function destroy(string $id): Response
    {
        if (!$this->books->delete((int) $id)) {
            return Response::error('Livre introuvable', 404);
        }

        return Response::json(['supprime' => true]);
    }

    /** @return array<string, mixed> */
    private function jsonBody(): array
    {
        $raw = file_get_contents('php://input');
        $data = json_decode((string) $raw, true);

        return is_array($data) ? $data : [];
    }
}
