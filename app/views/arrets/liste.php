<div class="container mt-5">
    <h3 class="text-center text-primary">🛑 Liste des Arrêts</h3>

    <a href="index.php?action=addArret" class="btn btn-success my-3">+ Ajouter un arrêt</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Nom</th>
                <th>Ligne</th>
                <th>Zone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arrets as $a): ?>
                <tr>
                    <td><?= $a['id'] ?></td>
                    <td><?= $a['numero'] ?></td>
                    <td><?= $a['nom'] ?></td>
                    <td>Ligne <?= $a['ligne_numero'] ?? 'N/A' ?></td>
                    <td><?= $a['zone'] ?></td>
                    <td>
                        <a href="index.php?action=editArret&id=<?= $a['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                        <a href="index.php?action=deleteArret&id=<?= $a['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet arrêt ?')">🗑️</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
