<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - TransitFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .login-title {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background-color: var(--secondary-color);
        }
        
        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }
        
        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .input-group-text {
            background-color: transparent;
            border-right: none;
        }
        
        .input-with-icon {
            border-left: none;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <div class="login-icon">
            <i class="fas fa-bus"></i>
        </div>
        <h2 class="login-title">TRANSITFLOW</h2>
        <p class="text-muted">Connectez-vous pour gérer votre flotte</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=login" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="login" class="form-label">Identifiant</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control input-with-icon" id="login" name="login" placeholder="Entrez votre identifiant" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control input-with-icon" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="profile_image" class="form-label">Photo de profil (optionnel)</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-camera"></i></span>
                <input type="file" class="form-control input-with-icon" id="profile_image" name="profile_image" accept="image/*">
            </div>
            <div class="form-text">Formats acceptés: JPG, PNG, GIF</div>
        </div>
        
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
            </button>
        </div>
    </form>

    <div class="form-footer mt-4">
        <p>Problème de connexion ? <a href="#">Contactez l'administrateur</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('.input-group-text').style.color = '#3498db';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.querySelector('.input-group-text').style.color = '#6c757d';
        });
    });
</script>

</body>
</html>