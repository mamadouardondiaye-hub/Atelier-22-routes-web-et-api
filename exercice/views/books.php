<?php
ob_start();
?>
<div class="space-y-6">
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-bold text-slate-800">Ajouter un livre</h2>
        <p class="text-sm text-slate-500 mt-1">Le formulaire envoie un JSON à <code class="bg-slate-100 px-1 rounded">POST /api/books</code>.</p>
        <form id="form-livre" class="mt-4 grid sm:grid-cols-2 gap-3">
            <input type="text" name="titre" placeholder="Titre"
                   class="border border-slate-300 rounded-lg px-3 py-2" required>
            <input type="text" name="auteur" placeholder="Auteur"
                   class="border border-slate-300 rounded-lg px-3 py-2" required>
            <button type="submit"
                    class="sm:col-span-2 bg-indigo-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700">
                Enregistrer via l'API
            </button>
        </form>
        <p id="message" class="mt-3 text-sm hidden"></p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between gap-3">
            <h2 class="text-lg font-bold text-slate-800">Liste (chargée en JS)</h2>
            <button type="button" id="btn-rafraichir"
                    class="text-sm bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg">
                Rafraîchir
            </button>
        </div>
        <p class="text-sm text-slate-500 mt-1">
            Au chargement, <code class="bg-slate-100 px-1 rounded">fetch('<?= htmlspecialchars(($base ?? '') . '/api/books') ?>')</code>
            remplit ce tableau (TODO 4).
        </p>
        <div id="liste-livres" class="mt-4 space-y-2 text-sm text-slate-500">
            Chargement…
        </div>
    </div>
</div>

<script>
    window.APP_BASE = <?= json_encode($base ?? '', JSON_UNESCAPED_SLASHES) ?>;
</script>
<script src="<?= htmlspecialchars(($base ?? '') . '/js/books.js') ?>"></script>
<?php
$contenu = ob_get_clean();
include __DIR__ . '/layout.php';
