<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Trajet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --warning-color: #f6c23e;
            --dark-color: #5a5c69;
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
            text-align: center;
            position: relative;
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

        .card-warning {
            border-left: 5px solid var(--warning-color);
        }

        .card-dark {
            border-left: 5px solid var(--dark-color);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="dashboard-header">
            <h1 class="fw-bold"><i class="fas fa-map me-2"></i>Tableau de bord - Trajets</h1>
            <p class="lead">Gestion des trajets et lignes de transport</p>
            <div class="position-absolute top-0 end-0 p-3">
                <a href="index.php?action=logout" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                </a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6 col-md-6">
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

            <div class="col-lg-6 col-md-6">
                <div class="dashboard-card card card-dark">
                    <div class="card-body">
                        <i class="fas fa-subway card-icon text-dark"></i>
                        <h5 class="card-title fw-bold text-dark">Lignes</h5>
                        <p class="card-text">Configuration du réseau de transport</p>
                        <a href="index.php?action=lignes" class="btn btn-dark btn-dashboard">
                            <i class="fas fa-project-diagram"></i> Voir les lignes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-chart-bar me-2"></i>Statistiques</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="h1 text-warning">15</div>
                                <div class="text-muted">Trajets planifiés</div>
                            </div>
                            <div class="col-md-6">
                                <div class="h1 text-dark">7</div>
                                <div class="text-muted">Lignes actives</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-chart-bar me-2"></i>Trajets par jour</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-success"><i class="fas fa-chart-pie me-2"></i>Lignes par zone</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-info"><i class="fas fa-chart-line me-2"></i>Évolution des trajets</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Trajets',
                    data: [5, 8, 4, 6, 7, 3, 2],
                    backgroundColor: '#f6c23e'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });

        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Nord', 'Sud', 'Est', 'Ouest'],
                datasets: [{
                    data: [3, 4, 2, 1],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'],
                datasets: [{
                    label: 'Trajets cumulés',
                    data: [12, 18, 24, 31],
                    fill: true,
                    borderColor: '#36b9cc',
                    backgroundColor: 'rgba(54, 185, 204, 0.2)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    </script>
</body>
</html>
