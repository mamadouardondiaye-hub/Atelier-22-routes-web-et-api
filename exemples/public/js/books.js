/**
 * JavaScript côté client : parle aux routes API et met à jour le DOM.
 * La page HTML a été servie par PHP ; les données passent par /api/books.
 */
(function () {
    const base = window.APP_BASE || '';
    const liste = document.getElementById('liste-livres');
    const form = document.getElementById('form-livre');
    const message = document.getElementById('message');
    const btnRafraichir = document.getElementById('btn-rafraichir');

    function afficherMessage(texte, ok) {
        message.textContent = texte;
        message.className = 'mt-3 text-sm ' + (ok ? 'text-emerald-600' : 'text-rose-600');
    }

    function badgeDisponible(disponible) {
        return disponible
            ? '<span class="text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">Disponible</span>'
            : '<span class="text-amber-700 bg-amber-50 px-2 py-0.5 rounded">Emprunté</span>';
    }

    function rendu(livres) {
        if (!Array.isArray(livres) || livres.length === 0) {
            liste.innerHTML = '<p class="text-slate-500">Aucun livre pour le moment.</p>';
            return;
        }

        liste.innerHTML = livres.map(function (livre) {
            return (
                '<article class="flex items-center justify-between gap-3 border border-slate-200 rounded-xl px-4 py-3">' +
                    '<div>' +
                        '<p class="font-semibold text-slate-800">' + escapeHtml(livre.titre) + '</p>' +
                        '<p class="text-slate-500">' + escapeHtml(livre.auteur) + '</p>' +
                    '</div>' +
                    '<div class="flex items-center gap-2">' +
                        badgeDisponible(!!livre.disponible) +
                        '<button type="button" data-id="' + livre.id + '" class="btn-supprimer text-rose-600 hover:underline text-sm">' +
                            'Supprimer' +
                        '</button>' +
                    '</div>' +
                '</article>'
            );
        }).join('');

        liste.querySelectorAll('.btn-supprimer').forEach(function (btn) {
            btn.addEventListener('click', function () {
                supprimerLivre(btn.getAttribute('data-id'));
            });
        });
    }

    function escapeHtml(valeur) {
        return String(valeur)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    async function chargerLivres() {
        liste.textContent = 'Chargement…';
        try {
            const res = await fetch(base + '/api/books');
            const json = await res.json();
            if (!res.ok) {
                throw new Error(json.error || 'Erreur API');
            }
            rendu(json.data);
        } catch (err) {
            liste.innerHTML = '<p class="text-rose-600">' + escapeHtml(err.message) + '</p>';
        }
    }

    async function creerLivre(titre, auteur) {
        const res = await fetch(base + '/api/books', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ titre: titre, auteur: auteur }),
        });
        const json = await res.json();
        if (!res.ok) {
            throw new Error(json.error || 'Création impossible');
        }
        return json.data;
    }

    async function supprimerLivre(id) {
        if (!confirm('Supprimer ce livre ?')) {
            return;
        }
        try {
            const res = await fetch(base + '/api/books/' + id, { method: 'DELETE' });
            const json = await res.json();
            if (!res.ok) {
                throw new Error(json.error || 'Suppression impossible');
            }
            afficherMessage('Livre #' + id + ' supprimé.', true);
            await chargerLivres();
        } catch (err) {
            afficherMessage(err.message, false);
        }
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const data = new FormData(form);
        try {
            await creerLivre(data.get('titre'), data.get('auteur'));
            form.reset();
            afficherMessage('Livre ajouté via l\'API.', true);
            await chargerLivres();
        } catch (err) {
            afficherMessage(err.message, false);
        }
    });

    btnRafraichir.addEventListener('click', chargerLivres);
    chargerLivres();
})();
