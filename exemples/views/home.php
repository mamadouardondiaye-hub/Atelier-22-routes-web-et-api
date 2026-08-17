<?php
ob_start();
?>
<div class="bg-white rounded-2xl shadow p-8 space-y-4">
    <h2 class="text-xl font-bold text-slate-800">Deux types de routes, un même serveur</h2>
    <p class="text-slate-600">
        Les <strong>routes web</strong> renvoient du HTML (cette page).
        Les <strong>routes API</strong> renvoient du JSON pour que JavaScript charge et manipule les données
        <em>sans recharger toute la page</em>.
    </p>
    <ul class="list-disc list-inside text-slate-600 space-y-1 text-sm">
        <li><code class="bg-slate-100 px-1.5 py-0.5 rounded">GET /</code> → page HTML (web)</li>
        <li><code class="bg-slate-100 px-1.5 py-0.5 rounded">GET /books</code> → coquille HTML (web)</li>
        <li><code class="bg-slate-100 px-1.5 py-0.5 rounded">GET /api/books</code> → liste JSON (api)</li>
        <li><code class="bg-slate-100 px-1.5 py-0.5 rounded">POST /api/books</code> → créer un livre (api)</li>
        <li><code class="bg-slate-100 px-1.5 py-0.5 rounded">DELETE /api/books/{id}</code> → supprimer (api)</li>
    </ul>
    <a href="<?= htmlspecialchars(($base ?? '') . '/books') ?>"
       class="inline-block mt-2 bg-indigo-600 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-indigo-700">
        Ouvrir le catalogue interactif
    </a>
</div>
<?php
$contenu = ob_get_clean();
include __DIR__ . '/layout.php';
