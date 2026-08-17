<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;

/**
 * Contrôleur WEB : renvoie du HTML (pages).
 * La page livres est un « coquille » vide : le contenu est chargé ensuite via l'API + JS.
 */
class PageController
{
    public function home(): string
    {
        return View::render('home', [
            'titre' => 'Routes web + API',
        ]);
    }

    public function books(): string
    {
        return View::render('books', [
            'titre' => 'Catalogue des livres',
        ]);
    }
}
