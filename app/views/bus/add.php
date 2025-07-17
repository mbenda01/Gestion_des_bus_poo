<div class="user-form-container">
    <div class="form-header">
        <i class="fas fa-bus"></i>
        <h2>Ajouter un Bus</h2>
    </div>

    <form id="addBusForm" class="elegant-form" method="POST" action="index.php?action=storeBus">
        <div class="form-grid">
            <div class="form-group">
                <label for="immatriculation">Immatriculation</label>
                <input type="text" id="immatriculation" name="immatriculation" placeholder="Ex : DK-1234-AB" required>
                <div class="error-message">Ce champ est requis</div>
            </div>

            <div class="form-group">
                <label for="type">Type de bus</label>
                <select id="type" name="type" required>
                    <option value="" disabled selected hidden>Choisir un type...</option>
                    <option value="Tata">Tata</option>
                    <option value="Car Rapide">Car Rapide</option>
                    <option value="DDK">DDK</option>
                </select>
                <div class="error-message">Veuillez sélectionner un type</div>
            </div>

            <div class="form-group">
                <label for="kilometrage">Kilométrage</label>
                <input type="number" id="kilometrage" name="kilometrage" required>
                <div class="error-message">Champ requis</div>
            </div>

            <div class="form-group">
                <label for="nbre_places">Nombre de places</label>
                <input type="number" id="nbre_places" name="nbre_places" required>
                <div class="error-message">Champ requis</div>
            </div>

            <div class="form-group">
                <label for="etat">État</label>
                <select id="etat" name="etat" required>
                    <option value="" disabled selected hidden>Choisir un état...</option>
                    <option value="En circulation">En circulation</option>
                    <option value="En panne">En panne</option>
                    <option value="Hors circulation">Hors circulation</option>
                </select>
                <div class="error-message">Champ requis</div>
            </div>

            <div class="form-group">
                <label for="localisation">Localisation</label>
                <input type="text" id="localisation" name="localisation" required>
                <div class="error-message">Champ requis</div>
            </div>

            <div class="form-group">
                <label for="ligne_id">Ligne</label>
                <select id="ligne_id" name="ligne_id" required>
                    <option value="" disabled selected hidden>Choisir une ligne...</option>
                    <?php foreach ($lignes as $ligne): ?>
                        <option value="<?= $ligne['id'] ?>">Ligne <?= htmlspecialchars($ligne['numero']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="error-message">Veuillez choisir une ligne</div>
            </div>

            <div class="form-group">
                <label for="zone">Zone</label>
                <input type="text" id="zone" name="zone" placeholder="Ex : Nord, Sud, etc.">
            </div>
        </div>

        <div class="form-actions">
            <a href="index.php?action=bus" class="cancel-btn">
                <i class="fas fa-times"></i> Annuler
            </a>
            <button type="submit" class="submit-btn">
                <i class="fas fa-check"></i> Enregistrer
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
document.getElementById('addBusForm').addEventListener('submit', function (e) {
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
