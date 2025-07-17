<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --info-color: #36b9cc;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color), #224abe);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            text-align: center;
        }

        .dashboard-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 2.5rem;
            opacity: 0.2;
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
        }

        .btn-dashboard {
            border-radius: 10px;
            padding: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-info {
            border-left: 5px solid var(--info-color);
        }

        .card-success {
            border-left: 5px solid var(--success-color);
        }

        .card-warning {
            border-left: 5px solid var(--warning-color);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="dashboard-header position-relative">
        <h1 class="fw-bold"><i class="fas fa-user me-2"></i>Tableau de bord - Client</h1>
        <p class="lead">Bienvenue dans votre espace de réservation</p>

        <div class="position-absolute top-0 end-0 p-3">
            <a href="index.php?action=logout" class="btn btn-outline-light btn-sm">
                <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card card card-info">
                <div class="card-body">
                    <i class="fas fa-ticket-alt card-icon text-info"></i>
                    <h5 class="card-title fw-bold text-info">Réserver un ticket</h5>
                    <p class="card-text">Réservez un ticket pour votre prochain trajet</p>
                    <a href="index.php?action=reserver" class="btn btn-info btn-dashboard">
                        <i class="fas fa-plus-circle"></i> Réserver
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card card card-success">
                <div class="card-body">
                    <i class="fas fa-history card-icon text-success"></i>
                    <h5 class="card-title fw-bold text-success">Historique</h5>
                    <p class="card-text">Consultez vos réservations précédentes</p>
                    <a href="index.php?action=historiqueReservations" class="btn btn-success btn-dashboard">
                        <i class="fas fa-list"></i> Historique
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card card card-warning">
                <div class="card-body">
                    <i class="fas fa-bell card-icon text-warning"></i>
                    <h5 class="card-title fw-bold text-warning">Notifications</h5>
                    <p class="card-text">Restez informé de l’actualité</p>
                    <a href="index.php?action=notifications" class="btn btn-warning btn-dashboard">
                        <i class="fas fa-envelope-open-text"></i> Voir les notifications
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
