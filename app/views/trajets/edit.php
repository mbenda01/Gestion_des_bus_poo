<div class="user-form-container">
    <div class="form-header">
        <i class="fas fa-route"></i>
        <h2>Modifier Trajet</h2>
    </div>

    <form id="editTrajetForm" class="elegant-form" method="POST" action="index.php?action=updateTrajet">
        <input type="hidden" name="id" value="<?= $trajet['id'] ?>">

        <div class="form-grid">
            <div class="form-group">
                <label for="date">Date du trajet</label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($trajet['date']) ?>" required>
                <div class="error-message">Veuillez indiquer une date</div>
            </div>

            <div class="form-group">
                <label for="tarif">Tarif (F CFA)</label>
                <input type="number" id="tarif" name="tarif" value="<?= htmlspecialchars($trajet['tarif']) ?>" required>
                <div class="error-message">Veuillez indiquer un tarif</div>
            </div>

            <div class="form-group">
                <label for="nbre_tickets_dispo">Nombre de tickets</label>
                <input type="number" id="nbre_tickets_dispo" name="nbre_tickets_dispo" value="<?= htmlspecialchars($trajet['nbre_tickets_dispo']) ?>" required>
                <div class="error-message">Veuillez indiquer le nombre de tickets</div>
            </div>

            <div class="form-group">
                <label for="ligne_id">Ligne</label>
                <select id="ligne_id" name="ligne_id" required>
                    <option disabled hidden value="">Choisir une ligne</option>
                    <?php foreach ($lignes as $ligne): ?>
                        <option value="<?= $ligne['id'] ?>" <?= $ligne['id'] == $trajet['ligne_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($ligne['numero']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="error-message">Veuillez choisir une ligne</div>
            </div>

            <div class="form-group">
                <label for="bus_id">Bus</label>
                <select id="bus_id" name="bus_id" required>
                    <option disabled hidden value="">Choisir un bus</option>
                    <?php foreach ($buses as $bus): ?>
                        <option value="<?= $bus['id'] ?>" <?= $bus['id'] == $trajet['bus_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($bus['immatriculation']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="error-message">Veuillez choisir un bus</div>
            </div>

            <div class="form-group">
                <label for="conducteur_id">Conducteur</label>
                <select id="conducteur_id" name="conducteur_id" required>
                    <option disabled hidden value="">Choisir un conducteur</option>
                    <?php foreach ($conducteurs as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= $c['id'] == $trajet['conducteur_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['prenom'] . ' ' . $c['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="error-message">Veuillez choisir un conducteur</div>
            </div>
        </div>

        <div class="form-actions">
            <a href="index.php?action=trajets" class="cancel-btn">
                <i class="fas fa-times"></i> Annuler
            </a>
            <button type="submit" class="submit-btn">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
        </div>
    </form>
</div>

<style>
.user-form-container {
    max-width: 800px;
    margin: 2rem auto;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

.form-header {
    background: linear-gradient(135deg, #4361ee, #3a0ca3);
    color: white;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 12px;
}

.form-header i {
    font-size: 1.8rem;
}

.form-header h2 {
    margin: 0;
    font-weight: 600;
    font-size: 1.5rem;
}

.elegant-form {
    padding: 2rem;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #333;
    font-size: 0.9rem;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.2s;
    background-color: #f9fafb;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #4361ee;
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    background-color: white;
}

.error-message {
    color: #e63946;
    font-size: 0.8rem;
    margin-top: 0.3rem;
    display: none;
}

.password-group {
    position: relative;
}

.password-wrapper {
    position: relative;
    display: flex;
}

.password-wrapper input {
    padding-right: 40px;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
}

.password-hint {
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #4a5568;
    display: flex;
    align-items: center;
    gap: 5px;
}

.password-hint i {
    color: #4361ee;
}

.full-width {
    grid-column: span 2;
}

.file-upload-box {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.2s;
}

.file-upload-box:hover {
    border-color: #4361ee;
    background-color: #f8faff;
}

.upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    color: #4a5568;
}

.upload-label i {
    font-size: 2rem;
    color: #4361ee;
}

.file-info {
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #666;
}

.file-requirements {
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: #718096;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.cancel-btn, .submit-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
    cursor: pointer;
}

.cancel-btn {
    background: white;
    border: 1px solid #ddd;
    color: #4a5568;
}

.cancel-btn:hover {
    background: #f5f5f5;
    border-color: #ccc;
}

.submit-btn {
    background: linear-gradient(135deg, #4361ee, #3a0ca3);
    color: white;
    border: none;
}

.submit-btn:hover {
    background: linear-gradient(135deg, #3a56d8, #2e0a8a);
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
}

/* Responsive */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .full-width {
        grid-column: span 1;
    }
}
</style>

<script>
document.getElementById('editTrajetForm').addEventListener('submit', function(e) {
    let isValid = true;

    this.querySelectorAll('[required]').forEach(input => {
        const error = input.nextElementSibling;
        if (!input.value.trim()) {
            input.style.borderColor = '#e63946';
            if (error) error.style.display = 'block';
            isValid = false;
        } else {
            input.style.borderColor = '#ddd';
            if (error) error.style.display = 'none';
        }
    });

    if (!isValid) e.preventDefault();
});
</script>
