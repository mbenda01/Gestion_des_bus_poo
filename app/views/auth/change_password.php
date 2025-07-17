<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe - TransitFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --warning-color: #ffc107;
            --warning-dark: #e0a800;
            --danger-color: #dc3545;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .password-card {
            width: 100%;
            max-width: 500px;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-top: 5px solid var(--warning-color);
        }
        
        .password-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .password-icon {
            font-size: 2.5rem;
            color: var(--warning-color);
            margin-bottom: 1rem;
        }
        
        .password-title {
            color: var(--warning-dark);
            font-weight: 600;
        }
        
        .password-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--warning-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }
        
        .btn-warning {
            background-color: var(--warning-color);
            border: none;
            padding: 12px;
            font-weight: 500;
            color: #212529;
            transition: all 0.3s;
        }
        
        .btn-warning:hover {
            background-color: var(--warning-dark);
            color: #212529;
        }
        
        .password-strength {
            height: 5px;
            background: #e9ecef;
            margin-top: 5px;
            border-radius: 5px;
            overflow: hidden;
        }
        
        .strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s;
        }
        
        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 10px;
        }
        
        .requirement {
            margin-bottom: 5px;
        }
        
        .requirement.valid {
            color: #28a745;
        }
        
        .requirement.invalid {
            color: var(--danger-color);
        }
    </style>
</head>
<body>

<div class="password-card">
    <div class="password-header">
        <div class="password-icon">
            <i class="fas fa-key"></i>
        </div>
        <h2 class="password-title">Changement de mot de passe requis</h2>
        <p class="password-subtitle">Pour des raisons de sécurité, veuillez définir un nouveau mot de passe</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=changePassword" id="passwordForm">
        <div class="mb-3">
            <label for="new_password" class="form-label">Nouveau mot de passe</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="new_password" name="new_password" 
                       placeholder="Entrez votre nouveau mot de passe" required>
                <button class="btn btn-outline-secondary toggle-password" type="button">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="password-strength">
                <div class="strength-bar" id="strengthBar"></div>
            </div>
            <div class="password-requirements">
                <p class="requirement invalid" id="lengthReq">• 8 caractères minimum</p>
                <p class="requirement invalid" id="uppercaseReq">• Au moins une majuscule</p>
                <p class="requirement invalid" id="numberReq">• Au moins un chiffre</p>
                <p class="requirement invalid" id="specialReq">• Au moins un caractère spécial</p>
            </div>
        </div>
        
        <div class="mb-4">
            <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                       placeholder="Confirmez votre nouveau mot de passe" required>
                <button class="btn btn-outline-secondary toggle-password" type="button">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="invalid-feedback" id="confirmError"></div>
        </div>
        
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-warning" id="submitBtn" disabled>
                <i class="fas fa-save me-2"></i>Enregistrer le nouveau mot de passe
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });

    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('confirm_password');
    const submitBtn = document.getElementById('submitBtn');
    const strengthBar = document.getElementById('strengthBar');
    
    newPassword.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        const hasLength = password.length >= 8;
        const hasUppercase = /[A-Z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        document.getElementById('lengthReq').className = hasLength ? 'requirement valid' : 'requirement invalid';
        document.getElementById('uppercaseReq').className = hasUppercase ? 'requirement valid' : 'requirement invalid';
        document.getElementById('numberReq').className = hasNumber ? 'requirement valid' : 'requirement invalid';
        document.getElementById('specialReq').className = hasSpecial ? 'requirement valid' : 'requirement invalid';
        
        if (hasLength) strength += 25;
        if (hasUppercase) strength += 25;
        if (hasNumber) strength += 25;
        if (hasSpecial) strength += 25;
        
        strengthBar.style.width = strength + '%';
        
        if (strength < 50) {
            strengthBar.style.backgroundColor = '#dc3545'; // Rouge
        } else if (strength < 75) {
            strengthBar.style.backgroundColor = '#fd7e14'; // Orange
        } else {
            strengthBar.style.backgroundColor = '#28a745'; // Vert
        }
        
        validateForm();
    });
    
    confirmPassword.addEventListener('input', validateForm);
    
    function validateForm() {
        const password = newPassword.value;
        const confirm = confirmPassword.value;
        const confirmError = document.getElementById('confirmError');
        
        if (confirm && password !== confirm) {
            confirmPassword.classList.add('is-invalid');
            confirmError.textContent = 'Les mots de passe ne correspondent pas';
            submitBtn.disabled = true;
        } else {
            confirmPassword.classList.remove('is-invalid');
            confirmError.textContent = '';
            
            const isValid = password.length >= 8 && 
                           /[A-Z]/.test(password) && 
                           /[0-9]/.test(password) && 
                           /[!@#$%^&*(),.?":{}|<>]/.test(password) && 
                           password === confirm;
            
            submitBtn.disabled = !isValid;
        }
    }
</script>

</body>
</html>