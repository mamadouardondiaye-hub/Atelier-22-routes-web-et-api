# Atelier 22 — Routes web + API — Mamadou Ardo Ndiaye (ESP 221)

Reproduction fidèle de l'atelier du prof (base :
[bbabadara/ateliers-pratiques-php](https://github.com/bbabadara/ateliers-pratiques-php)/atelier-22-routes-web-et-api)
+ exercice guidé complété (tous les TODO).

Pas de base de données ici : le stockage est un simple fichier `data/books.json` — aucune
adaptation PostgreSQL n'était nécessaire pour cet atelier.

## `exemples/` — reproduction fidèle

Mini-application complète : un même `Router` sert des **routes web** (HTML, `PageController`) et
des **routes API** (JSON, `BookApiController`), avec une page catalogue dont la liste est chargée
en JavaScript (`fetch`) sans rechargement de page.

```bash
cd exemples/public
php -S localhost:8080 router.php
# http://localhost:8080/        → accueil
# http://localhost:8080/books   → catalogue interactif (JS + API)
```

## `exercice/` — TODO complétés

| TODO | Fichier | Contenu |
|---|---|---|
| 1a | `routes/web.php` | Route `GET /books` → `PageController@books` |
| 1b | `routes/api.php` | Route `POST /api/books/{id}/toggle` → `toggle` |
| 1c | `routes/api.php` | Route `DELETE /api/books/{id}` → `destroy` |
| 2 | `BookApiController::toggle()` | Bascule disponible/emprunté, 404 si introuvable |
| 3 | `BookApiController::destroy()` | Supprime, 404 si introuvable |
| 4 | `books.js::chargerLivres()` | `fetch GET /api/books` puis `rendu(json.data)` |
| 5 | `books.js::creerLivre()` | `fetch POST /api/books` avec JSON `{titre, auteur}` |
| 6 | `books.js::toggleLivre()` | `fetch POST /api/books/{id}/toggle` puis rechargement |
| Bonus | `books.js::supprimerLivre()` | `fetch DELETE /api/books/{id}` |

```bash
cd exercice/public
php -S localhost:8081 router.php
# http://localhost:8081/books
```

## Testé en réel (curl, pas juste relu)

- `GET /` et `GET /books` → 200
- `POST /api/books/3/toggle` → bascule `disponible` correctement
- `POST /api/books/999/toggle` (ID inconnu) → `404 {"error":"Livre introuvable"}`
- `POST /api/books` (création) → `201` avec le nouvel ID
- `DELETE /api/books/{id}` → suppression confirmée, liste revérifiée après
- `php -l` sur tous les fichiers PHP modifiés + `node -c` sur `books.js` : aucune erreur de syntaxe

`exemples/` a été testé de la même façon avant d'être considéré comme référence de correction.
