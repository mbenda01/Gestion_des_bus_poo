<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .dashboard-header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .dashboard-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .card-icon {
            font-size: 2.5rem;
            opacity: 0.3;
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
        }
        
        .card-primary {
            border-left: 5px solid var(--primary-color);
        }
        
        .card-secondary {
            border-left: 5px solid var(--secondary-color);
        }
        
        .card-success {
            border-left: 5px solid var(--success-color);
        }
        
        .card-info {
            border-left: 5px solid var(--info-color);
        }
        
        .card-warning {
            border-left: 5px solid var(--warning-color);
        }
        
        .card-danger {
            border-left: 5px solid var(--danger-color);
        }
        
        .card-dark {
            border-left: 5px solid var(--dark-color);
        }
        
        .btn-dashboard {
            border-radius: 10px;
            padding: 1rem;
            font-weight: 600;
            transition: all 0.3s;
            text-align: left;
            display: flex;
            align-items: center;
        }
        
        .btn-dashboard i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="dashboard-header text-center mb-5">
            <h1 class="display-4 fw-bold"><i class="fas fa-crown me-3"></i>Tableau de bord Administrateur</h1>
            <p class="lead mb-0">Gestion complète du système TransitFlow</p>
            <div class="position-absolute top-0 end-0 p-3">
                <a href="index.php?action=logout" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                </a>
            </div>

        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card card-primary">
                    <div class="card-body">
                        <i class="fas fa-users card-icon text-primary"></i>
                        <h5 class="card-title fw-bold text-primary">Utilisateurs</h5>
                        <p class="card-text">Gestion des comptes utilisateurs</p>
                        <a href="index.php?action=users" class="btn btn-primary btn-dashboard">
                            <i class="fas fa-user-cog"></i> Gérer les utilisateurs
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card card-secondary">
                    <div class="card-body">
                        <i class="fas fa-user-shield card-icon text-secondary"></i>
                        <h5 class="card-title fw-bold text-secondary">Rôles</h5>
                        <p class="card-text">Configuration des rôles et permissions</p>
                        <a href="index.php?action=roles" class="btn btn-secondary btn-dashboard">
                            <i class="fas fa-key"></i> Gérer les rôles
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card card-success">
                    <div class="card-body">
                        <i class="fas fa-user-tie card-icon text-success"></i>
                        <h5 class="card-title fw-bold text-success">Conducteurs</h5>
                        <p class="card-text">Gestion des conducteurs et affectations</p>
                        <a href="index.php?action=conducteurs" class="btn btn-success btn-dashboard">
                            <i class="fas fa-id-card"></i> Voir les conducteurs
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card card-warning">
                    <div class="card-body">
                        <i class="fas fa-route card-icon text-warning"></i>
                        <h5 class="card-title fw-bold text-warning">Trajets</h5>
                        <p class="card-text">Planification et suivi des trajets</p>
                        <a href="index.php?action=trajets" class="btn btn-warning btn-dashboard">
                            <i class="fas fa-map-marked-alt"></i> Voir les trajets
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card card-danger">
                    <div class="card-body">
                        <i class="fas fa-bus card-icon text-danger"></i>
                        <h5 class="card-title fw-bold text-danger">Bus</h5>
                        <p class="card-text">Inventaire et maintenance des véhicules</p>
                        <a href="index.php?action=bus" class="btn btn-danger btn-dashboard">
                            <i class="fas fa-tachometer-alt"></i> Voir les bus
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card card-dark">
                    <div class="card-body">
                        <i class="fas fa-project-diagram card-icon text-dark"></i>
                        <h5 class="card-title fw-bold text-dark">Lignes</h5>
                        <p class="card-text">Configuration du réseau de transport</p>
                        <a href="index.php?action=lignes" class="btn btn-dark btn-dashboard">
                            <i class="fas fa-subway"></i> Voir les lignes
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-chart-line me-2"></i>Statistiques rapides</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="h1 text-primary">42</div>
                                <div class="text-muted">Utilisateurs actifs</div>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="h1 text-success">28</div>
                                <div class="text-muted">Conducteurs</div>
                            </div>
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="h1 text-warning">15</div>
                                <div class="text-muted">Trajets aujourd'hui</div>
                            </div>
                            <div class="col-md-3">
                                <div class="h1 text-danger">24</div>
                                <div class="text-muted">Bus en service</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>