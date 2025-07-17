<div class="container mt-5">
    <h3 class="text-warning mb-4">Modifier un arrêt</h3>
    <form method="POST" action="index.php?action=updateArret">
        <input type="hidden" name="id" value="<?= $arret['id'] ?>">
        <div class="mb-3">
            <label>Numéro</label>
            <input type="text" name="numero" class="form-control" value="<?= $arret['numero'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= $arret['nom'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Ligne</label>
            <select name="ligne_id" class="form-control" required>
                <?php foreach ($lignes as $ligne): ?>
                    <option value="<?= $ligne['id'] ?>" <?= $ligne['id'] == $arret['ligne_id'] ? 'selected' : '' ?>>
                        Ligne <?= $ligne['numero'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Zone</label>
            <input type="text" name="zone" class="form-control" value="<?= $arret['zone'] ?>">
        </div>
        <button class="btn btn-primary">Modifier</button>
    </form>
</div>
