<div class="container mt-5">
    <h3 class="text-primary mb-4">Ajouter un arrêt</h3>
    <form method="POST" action="index.php?action=storeArret">
        <div class="mb-3">
            <label>Numéro</label>
            <input type="text" name="numero" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nom de l'arrêt</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ligne</label>
            <select name="ligne_id" class="form-control" required>
                <?php foreach ($lignes as $ligne): ?>
                    <option value="<?= $ligne['id'] ?>">Ligne <?= $ligne['numero'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Zone</label>
            <input type="text" name="zone" class="form-control">
        </div>
        <button class="btn btn-success">Ajouter</button>
    </form>
</div>
