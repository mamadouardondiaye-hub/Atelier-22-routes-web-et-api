<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\View;

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
