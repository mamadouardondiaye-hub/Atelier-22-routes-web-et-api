<?php
declare(strict_types=1);

// Le vrai front-controller est dans public/ (comme dans Laravel) : cette page
// à la racine sert juste à rediriger si jamais on ouvre le mauvais dossier.
header('Location: public/');
exit;
