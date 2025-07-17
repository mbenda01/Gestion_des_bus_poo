<div class="user-form-container">
    <div class="form-header">
        <i class="fas fa-user-edit"></i>
        <h2>Modifier Utilisateur</h2>
    </div>

    <form id="editUserForm" class="elegant-form" method="POST" action="index.php?action=updateUser" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="form-grid">
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                <div class="error-message">Veuillez saisir un prénom</div>
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                <div class="error-message">Veuillez saisir un nom</div>
            </div>

            <div class="form-group">
                <label for="login">Identifiant</label>
                <input type="text" id="login" name="login" value="<?= htmlspecialchars($user['login']) ?>" required>
                <div class="error-message">Veuillez saisir un identifiant</div>
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($user['telephone']) ?>">
            </div>

            <div class="form-group">
                <label for="role">Rôle</label>
                <select id="role" name="role" required>
                    <option value="" disabled hidden>Sélectionner un rôle...</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= ($user['role'] == $role['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['libelle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="error-message">Veuillez sélectionner un rôle</div>
            </div>

            <div class="form-group full-width">
                <label for="profile_image">Photo de profil (optionnel)</label>
                <div class="file-upload-box">
                    <label for="profile_image" class="upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Glissez-déposez ou cliquez pour choisir</span>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*">
                    </label>
                    <div class="file-info"><?= $user['profile_image'] && $user['profile_image'] != 'default.png' ? $user['profile_image'] : 'Aucun fichier sélectionné' ?></div>
                    <div class="file-requirements">Formats acceptés: JPG, PNG, GIF (Max 2MB)</div>

                    <?php if (!empty($user['profile_image']) && $user['profile_image'] !== 'default.png'): ?>
                        <div class="mt-3 text-center">
                            <img src="uploads/profiles/<?= htmlspecialchars($user['profile_image']) ?>" alt="Photo actuelle" style="max-height: 100px; border-radius: 8px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="index.php?action=users" class="cancel-btn">
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
document.getElementById('profile_image').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
    document.querySelector('.file-info').textContent = fileName;
});
</script>
